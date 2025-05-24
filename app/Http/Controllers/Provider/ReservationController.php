<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Enums\OrderStatus;
use App\Http\Requests\Provider\Reservation\CreateReservationRequest;
use App\Http\Requests\Provider\Reservation\UpdateReservationRequest;
use App\Http\Requests\Provider\Reservation\CreateServiceReservationRequest;
use App\Http\Requests\Provider\Reservation\UpdateServiceReservationRequest;

use App\Http\Requests\Provider\Reservation\SearchRequest;

use App\Models\Provider;
use App\Http\Resources\Api\Provider\ProviderTimesResource;
use App\Enums\OrderType;
use App\Traits\ResponseTrait;
use App\Models\Place;
use App\Models\MeetingRoom;
use App\Models\Service;
use App\Http\Resources\MeetingRoomTimesResource;

use App\Models\Admin;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyAdmin;
use App\Models\Country ;
use App\Models\SiteSetting;
class ReservationController extends Controller
{
    use ResponseTrait;
    /********** AJAX **********/
    public function getProviderAvailableTimes(Request $request){
        $models = [];
        if($MeetingRoom = MeetingRoom::find($request->meeting_room_id)){
            $models   = MeetingRoomTimesResource::collection($MeetingRoom->availableTimes());
        }
      return response()->json($models);
    }
    public function getPlaceMeetingRooms(Request $request){
        $models   = MeetingRoom::where(['place_id'=>$request->place_id])->orderBy('name','ASC')->get();
        return response()->json($models);
    }
    /********** AJAX **********/

    public function addPlaceReservation(){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        // $users = User::orderBy('name','ASC')->get();
        $places  = Place::where('provider_id',$provider_id)->orderBy('name','ASC')->get();
        $places_ids = $places->pluck('id')->toArray();
        $rooms  = MeetingRoom::whereIntegerInRaw('place_id',$places_ids)->orderBy('name','ASC')->get();
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries)->orderBy('id','ASC')->get();
        return view('provider.reservation.addReservation',get_defined_vars());
    }

    public function addServiceReservation(){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $users = User::orderBy('name','ASC')->get();
        $services  = Service::where('provider_id',$provider_id)->orderBy('name','ASC')->get();
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries)->orderBy('id','ASC')->get();
        return view('provider.reservation.addServiceReservation',get_defined_vars());
    }

    public function createReservation(CreateReservationRequest $request){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
		$meetingRoom = MeetingRoom::findOrFail($request->meeting_room_id);
        $user = User::firstOrCreate(
            ['email' => $request->email],//'phone' => fixPhone($request->phone),'country_code' => fixPhone($request->country_code)],
            [   'name'              => $request->name,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'country_code'      => $request->country_code,
                'password'          => '123456'
            ]
        );
        $is_confirmed = ($meetingRoom->need_confirm)? 0 : 1;
        $order = Order::create(['user_id'      => $user->id,
                                'place_id'     => $request->place_id,
                                'meeting_room_id'  => $request->meeting_room_id,
                                'date'         => $request->date,
                                'time'         => $request->time,
                                'final_total'  => $request->final_total??0,
                                'pay_type'     => $request->pay_type,
                                'pay_status'   => $request->pay_status,
                                'price'        => $request->final_total??0,
                                'provider_id'  => $provider_id,
                                'type'         => 1,
                                'is_confirmed' => $is_confirmed
                            ]);
        // $order = Order::create($request->validated()+(['price' => $request->final_total,'provider_id' => $provider_id,'type'=>1,'is_confirmed' => $is_confirmed]));
        $meetingRoom->increment('num_reservations');
        //send notification to admin to confirm order
        // if(!$order->is_confirmed){
            $superAdmin = Admin::find(1);
            $notifyData    = [
                'sender'      => auth('provider')->id(),
                'sender_model'=> 'User',
                'order_id'    => $order->id,
                'type'        => 'new_place_order' ,
                'name'        => auth('provider')->user()->name,
                'title_ar'    => 'حجز مكان جديد',
                'title_en'    => 'New Place Reservation',
                'body_ar'     => 'حجز مكان جديد من قبل '.auth('provider')->user()->name,
                'body_en'     => 'New Place reservation by '.auth('provider')->user()->name
            ];
            Notification::send( $superAdmin , new NotifyAdmin($notifyData));
        // }
        return $this->response('success', __('apis.added'),['url' => route('provider.new')]);
    }

    public function createServiceReservation(CreateServiceReservationRequest $request){
        $service = Service::findOrFail($request->service_id);
        if($service->num_reservations >= $service->num_seats){
            return $this->response('fail', __('apis.no_available_seats'));
        }elseif($request->quantity > ($service->num_seats - $service->num_reservations) ){
            return $this->response('fail', __('apis.available_seats',['num_seats'=>$service->num_seats - $service->num_reservations]));
        }
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $user = User::firstOrCreate(
            ['email' => $request->email],//'phone' => fixPhone($request->phone),'country_code' => fixPhone($request->country_code)],
            [   'name'              => $request->name,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'country_code'      => $request->country_code,
                'password'          => '123456'
            ]
        );

        $is_confirmed = ($service->need_confirm)? 0 : 1;
		// $order = Order::create($request->validated()+(['price' => $request->final_total,'provider_id' => $provider_id,'type'=>0,'is_confirmed' => $is_confirmed]));
        $order = Order::create(['user_id'      => $user->id,
                                'service_id'   => $request->service_id,
                                'quantity'     => $request->quantity,
                                'final_total'  => $request->final_total??0,
                                'pay_type'     => $request->pay_type,
                                'pay_status'   => $request->pay_status,
                                'price'        => $request->final_total??0,
                                'provider_id'  => $provider_id,
                                'type'         => 0,
                                'is_confirmed' => $is_confirmed
                            ]);
        if ($request->users_names) {
            $names = [];
            foreach ($request->users_names as $value) {
                $names[]['name'] = $value;
            }
            $order->names()->createMany($names);
        }
        $service->increment('num_reservations', $request->quantity);
        //send notification to admin to confirm order
        // if(!$order->is_confirmed){
            $superAdmin = Admin::find(1);
            $notifyData    = [
                'sender'      => auth('provider')->id(),
                'sender_model'=> 'User',
                'order_id'    => $order->id,
                'type'        => 'new_service_order' ,
                'name'        => auth('provider')->user()->name,
                'title_ar'    => 'حجز خدمة جديد',
                'title_en'    => 'New Service Reservation',
                'body_ar'     => 'حجز خدمة جديد من قبل '.auth('provider')->user()->name,
                'body_en'     => 'New service reservation by '.auth('provider')->user()->name
            ];
            Notification::send( $superAdmin , new NotifyAdmin($notifyData));
        // }
        return $this->response('success', __('apis.added'),['url' => route('provider.reservations')]);
    }

    public function editPlaceReservation(Order $order){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $users     = User::orderBy('name','ASC')->get();
        $places    = Place::where('provider_id',$provider_id)->orderBy('name','ASC')->get();
        $places_ids = $places->pluck('id')->toArray();
        $rooms  = MeetingRoom::whereIntegerInRaw('place_id',$places_ids)->orderBy('name','ASC')->get();
        $times = [];
        if($order->meetingRoom){
            request()['day'] = $order->date;
            $times   = MeetingRoomTimesResource::collection(MeetingRoom::find($order->meeting_room_id)->availableTimes());
        }
        return view('provider.reservation.editReservation',get_defined_vars());
    }

    public function editServiceReservation(Order $order){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $users     = User::orderBy('name','ASC')->get();
        $services  = Service::where('provider_id',$provider_id)->orderBy('name','ASC')->get();
        return view('provider.reservation.editServiceReservation',get_defined_vars());
    }

    public function updateReservation(UpdateReservationRequest $request,Order $order){
        $order->update($request->validated()+(['price' => $request->final_total??0]));
        return $this->response('success', __('apis.updated'),['url' => route('provider.new')]);
    }

    public function updateServiceReservation(UpdateServiceReservationRequest $request,Order $order){
        $order->update($request->validated()+(['price' => $request->final_total??0]));
        if ($request->users_names) {
            $order->names()->delete();
            $names = [];
            foreach ($request->users_names as $value) {
                $names[]['name'] = $value;
            }
            $order->names()->createMany($names);
        }
        return $this->response('success', __('apis.updated'),['url' => route('provider.reservations')]);
    }

    public function reservations(){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $reservations = Order::where('provider_id',$provider_id)
                                ->latest()
                                ->paginate($this->paginateNum());
        return view('provider.reservation.index',get_defined_vars());
    }

    public function searchReservation(SearchRequest $request){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $reservations  = Order::whereHas('user', function($q)use($request){
                                    $q->where('phone','like','%'.$request->phone.'%');
                                })
                                ->where('provider_id',$provider_id)
                                ->latest()
                                ->get();
        return view('provider.reservation.searchReservation',get_defined_vars());
    } 

    public function new(){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $reservations = Order::where('provider_id',$provider_id)
                                ->where(function($q){
                                  return $q->where('date' ,'>',date('Y-m-d'))
                                           ->orwhere('date',date('Y-m-d'))->where('time','>',date('H:i:s'));
                                })
                                ->orderBy('date','ASC')
                                ->orderBy('time','ASC')
                                ->paginate($this->paginateNum());
        return view('provider.reservation.new',get_defined_vars());
    }

    public function finished(){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $reservations = Order::where('provider_id',$provider_id)
                                ->where(function($q){
                                    return $q->where('date' ,'<',date('Y-m-d'))
                                             ->orwhere('date',date('Y-m-d'))->where('time','<',date('H:i:s'));
                                })
                                ->orderBy('date','DESC')
                                ->orderBy('time','DESC')
                                ->paginate($this->paginateNum());
        return view('provider.reservation.finished',get_defined_vars());
    }


    public function searchNewReservation(SearchRequest $request){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $reservations  = Order::whereHas('user', function($q)use($request){
                                    $q->where('phone','like','%'.$request->phone.'%');
                                })
                                ->where('provider_id',$provider_id)
                                ->where(function($q){
                                    return $q->where('date' ,'>',date('Y-m-d'))
                                            ->orwhere('date',date('Y-m-d'))->where('time','>',date('H:i:s'));
                                })
                                ->orderBy('date','ASC')
                                ->orderBy('time','ASC')
                                ->get();
        return view('provider.reservation.searchNewReservation',get_defined_vars());
    }   

    public function searchFinishedReservation(SearchRequest $request){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $reservations  = Order::whereHas('user', function($q)use($request){
                                    $q->where('phone','like','%'.$request->phone.'%');
                                })
                                ->where('provider_id',$provider_id)
                                ->where(function($q){
                                    return $q->where('date' ,'<',date('Y-m-d'))
                                             ->orwhere('date',date('Y-m-d'))->where('time','<',date('H:i:s'));
                                })
                                ->orderBy('date','DESC')
                                ->orderBy('time','DESC')
                                ->get();
        return view('provider.reservation.searchFinishedResults',get_defined_vars());
    }

    public function reservationPlaceDetails(Order $order){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $users  = User::orderBy('name','ASC')->get();
        $places  = Place::where('provider_id',$provider_id)->orderBy('name','ASC')->get();
        $places_ids = $places->pluck('id')->toArray();
        $rooms  = MeetingRoom::whereIntegerInRaw('place_id',$places_ids)->orderBy('name','ASC')->get();
        $times = [];
        if($order->meetingRoom){
            request()['day'] = $order->date;
            $times   = MeetingRoomTimesResource::collection(MeetingRoom::find($order->meeting_room_id)->availableTimes());
        }
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries)->orderBy('id','ASC')->get();

        return view('provider.reservation.reservationDetails',get_defined_vars());
    }

    public function reservationServiceDetails(Order $order){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $users  = User::orderBy('name','ASC')->get();
        $services  = Service::where('provider_id',$provider_id)->orderBy('name','ASC')->get();

        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries)->orderBy('id','ASC')->get();
        
        return view('provider.reservation.reservationServiceDetails',get_defined_vars());
    }

    public function deleteReservation(Request $request,Order $Order){
        $Order->delete();
        return $this->response('success', __('apis.deleted'),['url' => route('provider.new')]);
    }
}
