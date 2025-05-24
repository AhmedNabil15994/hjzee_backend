<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Notifications\OrderNotification;
use App\Models\Order;
use App\Http\Requests\Api\Reservation\CreatePlaceReservationRequest;
use App\Http\Requests\Api\Reservation\CreateServiceReservationRequest;
use App\Http\Requests\Api\Reservation\PayReservationRequest;
use App\Models\Service;
use App\Models\MeetingRoom;
use App\Models\MeetingRoomTime;
use App\Http\Resources\Api\Order\OrdersCollection;
use App\Http\Resources\Api\Order\OrderDetailsResource;
use Illuminate\Http\Request;
use App\Services\CouponService;
use App\Services\SettingService;
use App\Services\TransactionService;
use DB;
use App\Enums\OrderPayType;
use App\Models\Admin;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyAdmin;

class OrderController extends Controller
{
    use ResponseTrait;

    public function createPlaceReservation(CreatePlaceReservationRequest $request){
		$meetingRoom = MeetingRoom::findOrFail($request->meeting_room_id);

        $dates = json_decode($request->dates);
        $new_dates = [];
        $price = 0;
        if ($dates) {
            foreach ($dates as $dateArr) {
                $new_dates[] = ['date' => $dateArr->date , 'time' => $dateArr->time];
                if($meeting_room_time = MeetingRoomTime::where(['meeting_room_id' => $meetingRoom->id,'day' => date('l',strtotime($dateArr->date)) ,'time' => date('H:i:s',strtotime($dateArr->time)) ])->first()){
                    $price += $meeting_room_time->price;
                 }
            }
        }
        $is_confirmed = ($meetingRoom->need_confirm)? 0 : 1;
        $order = auth()->user()->orders()->create($request->validated()+(['date'=>$dates[0]->date??null,'time'=>$dates[0]->time??null,'provider_id' =>$meetingRoom->place->provider_id??null,'price' => $price,'final_total' => $price,'type'=> 1 ,'is_confirmed' => $is_confirmed]));
        $order->dates()->createMany($new_dates);
        //send notification to admin to confirm order
        // if(!$order->is_confirmed){
            $superAdmin = Admin::find(1);
            $notifyData    = [
                'sender'      => auth()->id(),
                'sender_model'=> 'User',
                'order_id'    => $order->id,
                'type'        => 'new_place_order' ,
                'name'        => auth()->user()->name,
                'title_ar'    => 'حجز مكان جديد',
                'title_en'    => 'New Place Reservation',
                'body_ar'     => 'حجز مكان جديد من قبل '.auth()->user()->name,
                'body_en'     => 'New Place reservation by '.auth()->user()->name
            ];
            Notification::send( $superAdmin , new NotifyAdmin($notifyData));
        // }
        return $this->successData( new OrderDetailsResource($order->refresh()));
    }

    public function createServiceReservation(CreateServiceReservationRequest $request){
		$service = Service::findOrFail($request->service_id);
        if($service->num_reservations >= $service->num_seats){
            return $this->response('fail', __('apis.no_available_seats'));
        }elseif($request->quantity > ($service->num_seats - $service->num_reservations) ){
            return $this->response('fail', __('apis.available_seats',['num_seats'=>$service->num_seats - $service->num_reservations]));
        }
        $is_confirmed = ($service->need_confirm)? 0 : 1;
        $total_price = $service->offer_price * $request->quantity;
        $order = auth()->user()->orders()->create($request->validated()+(['date'=>date('Y-m-d',strtotime($service->start_date)),'time' => date('H:i:s',strtotime($service->start_date)),'price' => $total_price,'final_total'=>$total_price,'provider_id' => $service->provider_id,'type' => 0,'is_confirmed' => $is_confirmed]));
        if ($request->users_names) {
            $names = [];
            foreach ($request->users_names as $value) {
                $names[]['name'] = $value;
            }
            $order->names()->createMany($names);
        }
        
        //send notification to admin to confirm order
        // if(!$order->is_confirmed){
            $superAdmin = Admin::find(1);
            $notifyData    = [
                'sender'      => auth()->id(),
                'sender_model'=> 'User',
                'order_id'    => $order->id,
                'type'        => 'new_service_order' ,
                'name'        => auth()->user()->name,
                'title_ar'    => 'حجز خدمة جديد',
                'title_en'    => 'New Service Reservation',
                'body_ar'     => 'حجز خدمة جديد من قبل '.auth()->user()->name,
                'body_en'     => 'New service reservation by '.auth()->user()->name
            ];
            Notification::send( $superAdmin , new NotifyAdmin($notifyData));
        // }


        return $this->successData( new OrderDetailsResource($order->refresh()));
    }

    public function calculateCoupon($coupon_num,$price){
        $coupon_amount = 0;
        if ($coupon_num) {
          $coupon_service  = (new CouponService())->checkCoupon($coupon_num,$price);
          if(isset($coupon_service['data']['disc_amount'])){
            $coupon_amount = (float) $coupon_service['data']['disc_amount'] ;
            $price         =  (float) $price - $coupon_amount;
          }
        } 
        return ['price' => $price , 'coupon_amount' => $coupon_amount];
      }

    public function calculatePayWithWallet($order,$priceAfterCoupon){
            DB::beginTransaction();
        try {
            //check if client balance enough or no 
            if((float) auth()->user()->wallet_balance >= (float)$priceAfterCoupon){
                (new TransactionService)->adminCutFromUserWallet(auth()->user(),$priceAfterCoupon,'PayBalance',$order); 
            }else{
                return __('order.not_enough_balance');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function payReservation(PayReservationRequest $request,Order $order){
        if($order->pay_status == 2){
            return $this->response('fail', __('apis.already_paid'));
        }
        // check coupon
        $coupon_data      = $this->calculateCoupon($request->coupon_num,$order->price);
        $priceAfterCoupon = $coupon_data['price'];
        $coupon_amount    = $coupon_data['coupon_amount'];
        if($request->pay_type == OrderPayType::WALLET){
            $msg  = $this->calculatePayWithWallet($order,$priceAfterCoupon);
            if( $msg ){
                return $this->failMsg($msg); 
            }
            //increase num_reservations وخد بالك دا بيآثر علي عدد المقاعد المتاحة ف الخدمات ومش هيتم اضافتة ف الكاش من هنا ولكن بيتم يدوي من اللوحة 
            if($order->type == 1){
               $order->meetingRoom->increment('num_reservations');
            }else{
               $order->service->increment('num_reservations', $order->quantity);
            }
            $order->update(['coupon_num' => $request->coupon_num,'coupon_amount' => $coupon_amount,'final_total' => $priceAfterCoupon,'pay_status' => 2,'pay_type'=>$request->pay_type]);
            return $this->response('success', __('apis.pay_success'));
        }elseif($request->pay_type == OrderPayType::ONLINE){
            $order->update(['coupon_num' => $request->coupon_num,'coupon_amount' => $coupon_amount,'final_total' => $priceAfterCoupon,'pay_type'=>$request->pay_type]);
            $server_output = $this->payOnline($order,$priceAfterCoupon);
            return $this->successData(['paymentURL' => $server_output->data->link??'']);

        }elseif($request->pay_type == OrderPayType::CASH){
            if($order->type == 1){
                $order->meetingRoom->increment('num_reservations');
             }else{
                $order->service->increment('num_reservations', $order->quantity);
             }
            $order->update(['coupon_num' => $request->coupon_num,'coupon_amount' => $coupon_amount,'final_total' => $priceAfterCoupon,'pay_status' => 2,'pay_type'=>$request->pay_type]);
            return $this->response('success', __('apis.pay_success'));
        }
        return $this->response('fail', __('apis.not_available_payment_method'));
    }

    public function payOnline($order,$priceAfterCoupon){
        $client = new \GuzzleHttp\Client();
        $url = config('services.upayments.live_url');
        if(config('services.upayments.test_mode')){
            $url = config('services.upayments.test_url');
        }
        $body = json_encode([
            'order' => [
                'id' => (string)$order->id,
                'reference' => (string)$order->id,
                'description' => 'Pay order #'.$order->id,
                'currency' => config('services.upayments.CurrencyCode'),
                'amount' => $priceAfterCoupon
            ],
            'language' => lang(),
            // 'paymentGateway' => [
            //     'src' => 'knet'
            // ],
            'reference' => [
                'id' => (string)$order->id
            ],
            'customer' => [
                'uniqueId' => (string) auth()->id(),
                'name' => auth()->user()->name ?? "test",
                'email' => auth()->user()->email ?? "test@email.com",
                'mobile' => auth()->user()->full_phone,
            ],
            'returnUrl' => route('pay-order-success'),
            'cancelUrl' => route('pay-order-fail'),
            'notificationUrl' => route('pay-order-fail'),
            'customerExtraData' => $priceAfterCoupon
        ]);
        $response = $client->request('POST', $url, [
          'body' =>  $body,
          'headers' => [
            'Authorization' => "Authorization: Bearer ".config('services.upayments.api_key'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
          ],
        ]);
        $server_output  = json_decode( $response->getBody());
        return $server_output;        
    }

    public function PayOrderSuccess(Request $request){
            //increase num_reservations وخد بالك دا بيآثر علي عدد المقاعد المتاحة ف الخدمات ومش هيتم اضافتة ف الكاش من هنا ولكن بيتم يدوي من اللوحة 
        DB::beginTransaction();
        try {
            $order = Order::findorFail($request->requested_order_id);
            if($order->type == 1){
                $order->meetingRoom->increment('num_reservations');
            }else{
                $order->service->increment('num_reservations', $order->quantity);
            }
            $order->update(['pay_status' => 2,'pay_type'=> OrderPayType::ONLINE]);
            (new TransactionService)->onlineOrderPaySuccess($order,$request->all()); 
            DB::commit();
            return $this->response('success', __('apis.pay_success'));
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response('failed', __('apis.failed'));
        }
    }

    public function PayOrderFail(Request $request){
        return $this->response('failed', __('apis.payment_failed'));
    }


    public function reservations(Request $request){
        $reservations = Order::where('user_id',auth()->id())
                                ->when($request->type , function ($q)use($request){
                                    if($request->type == 'service'){
                                        $type = 0;
                                    }else{
                                        $type = 1;
                                    }
                                    return $q->where('type', $type);
                                })
                                ->when($request->status == 'upcoming' , function ($q)use($request){
                                    return $q->where('date' ,'>',date('Y-m-d'))
                                                ->orwhere('date',date('Y-m-d'))->where('time','>',date('H:i:s'));
                                })
                                ->when($request->status == 'previous' , function ($q)use($request){
                                    return $q->where('date' ,'<',date('Y-m-d'))
                                                ->orwhere('date',date('Y-m-d'))->where('time','<',date('H:i:s'));
                                })
                                ->orderBy('date','ASC')
                                ->orderBy('time','ASC')
                                ->paginate($this->paginateNum());
        return $this->successData( new OrdersCollection($reservations));
    }

    public function reseravtionDetails(Order $order){
        return $this->successData(new OrderDetailsResource($order)); 
    }

    public function cancelReseravtion(Order $order){
        $order->delete();
        return $this->response('success', __('apis.deleted'));
    }


    // public function finishOrder(Request $request)
    // {
    //     $order = Order::findorfail($request['order_id']);
    //     //TODO: finish order setting..

    //     $order->user->notify(new OrderNotification($order, $order->user));

    //     return $this->response('success', __('apis.closeOrder'));
    // }


}
