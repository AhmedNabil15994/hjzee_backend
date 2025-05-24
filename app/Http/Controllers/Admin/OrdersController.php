<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Orders\Store;
use App\Http\Requests\Admin\Orders\Update;
use App\Traits\Report;
use App\Models\Order;
use App\Models\User;
use App\Models\Provider;
use App\Models\Place;
use App\Models\Service;
use App\Models\MeetingRoom;
use App\Http\Resources\MeetingRoomTimesResource;
use App\Jobs\SendEmailJob;
use App\Traits\ResponseTrait;


class OrdersController extends Controller
{
    use ResponseTrait;
    /************ AJAX ****************/
    public function getRoomAvailableTimes(Request $request){
        $models = [];
        if($MeetingRoom = MeetingRoom::find($request->meeting_room_id)){
            $models   = MeetingRoomTimesResource::collection($MeetingRoom->availableTimes());
        }
      return response()->json($models);
    }
    public function getProviderPlaces(Request $request){
        $models   = Place::where(['provider_id'=>$request->provider_id])->orderBy('name','ASC')->get();
        return response()->json($models);
    }

    public function getProviderServices(Request $request){
        $models   = Service::where(['provider_id'=>$request->provider_id])->orderBy('name','ASC')->get();
        return response()->json($models);
    }

    public function getPlaceMeetingRooms(Request $request){
        $models   = MeetingRoom::where(['place_id'=>$request->place_id])->orderBy('name','ASC')->get();
        return response()->json($models);
    }
    
    /************ AJAX ****************/


    public function index()
    {
        if (request()->ajax()) {
            $orders = Order::with('user','meetingRoom')->search(request()->searchArray)->paginate(30);
            $html = view('admin.orders.table' , compact('orders'))->render() ;
            return response()->json(['html' => $html]);
        }
      $users  = User::orderBy('name','ASC')->get();
      $rooms  = MeetingRoom::orderBy('name','ASC')->get();
      $providers  = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
      $places  = Place::orderBy('name','ASC')->get();
      $services  = Service::orderBy('name','ASC')->get();
      return view('admin.orders.index',get_defined_vars());
    }

    public function create()
    {
        $users  = User::orderBy('name','ASC')->get();
        $rooms  = MeetingRoom::orderBy('name','ASC')->get();
        $providers  = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $places  = Place::orderBy('name','ASC')->get();
        $services  = Service::orderBy('name','ASC')->get();
        return view('admin.orders.create',get_defined_vars());
    }

    public function store(Store $request)
    {
        if($request->type == 0){
            $service = Service::findOrFail($request->service_id);
            if($service->num_reservations >= $service->num_seats){
                return $this->response('fail',__('apis.no_available_seats'));
            }elseif($request->quantity > ($service->num_seats - $service->num_reservations) ){
                return $this->response('fail',__('apis.available_seats',['num_seats'=>$service->num_seats - $service->num_reservations]));
            }
        }

        $is_confirmed = ($request->is_confirmed)? 1:0;
		$order = Order::create($request->validated()+(['price' => $request->final_total,'is_confirmed' => $is_confirmed]));
        if($order->meetingRoom){
            $order->meetingRoom->increment('num_reservations');
        }
        if($request->type == 0){
            if ($request->users_names) {
                $names = [];
                foreach ($request->users_names as $value) {
                    $names[]['name'] = $value;
                }
                $order->names()->createMany($names);
            }
            $order->service->increment('num_reservations', $request->quantity);
        }
        Report::addToLog(' اضافه الحجوزات') ;
        return response()->json(['url' => route('admin.orders.index')]);
    }

    public function edit($id)
    {
        $row = Order::findOrFail($id);
        $users     = User::orderBy('name','ASC')->get();
        $rooms     = MeetingRoom::where('place_id',$row->place_id)->orderBy('name','ASC')->get();
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $places    = Place::where('provider_id',$row->provider_id)->orderBy('name','ASC')->get();
        $services  = Service::where('provider_id',$row->provider_id)->orderBy('name','ASC')->get();
        $times = [];
        if($row->meetingRoom){
            request()['day'] = $row->date;
            $times   = MeetingRoomTimesResource::collection(MeetingRoom::find($row->meeting_room_id)->availableTimes());
        }
        return view('admin.orders.edit' , get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $order = Order::findOrFail($id);
        $is_confirmed = ($request->is_confirmed)? 1:0;
        //send email with payment link to user to pay the service,place price
        // if($order->is_confirmed == 0 && $is_confirmed == 1){
            //send email
            // dispatch(new SendEmailJob(auth()->user()->email , ['title' => __('apis.confirm_reservation_title'),'message'=> __('apis.confirm_reservation_body',['room' =>$order->meetingRoom->name??'','date'=>date('Y-m-d',strtotime($order->date)),'time'=>date('h:i',strtotime($order->time)).' '.__('apis.'.date('a',strtotime($order->time))) ]) ]));
        // }
        $order->update($request->validated()+(['price' => $request->final_total,'is_confirmed' => $is_confirmed]));
        if($request->type == 0){
            if ($request->users_names) {
                $order->names()->delete();
                $names = [];
                foreach ($request->users_names as $value) {
                    $names[]['name'] = $value;
                }
                $order->names()->createMany($names);
            }
        }
        Report::addToLog('  تعديل الحجوزات') ;
        return response()->json(['url' => route('admin.orders.index')]);
    }

    public function show($id)
    {
        $row = Order::findOrFail($id);
        $users     = User::orderBy('name','ASC')->get();
        $rooms     = MeetingRoom::where('place_id',$row->place_id)->orderBy('name','ASC')->get();
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $places    = Place::where('provider_id',$row->provider_id)->orderBy('name','ASC')->get();
        $services  = Service::where('provider_id',$row->provider_id)->orderBy('name','ASC')->get();
        $times = [];
        if($row->meetingRoom){
            request()['day'] = $row->date;
            $times   = MeetingRoomTimesResource::collection(MeetingRoom::find($row->meeting_room_id)->availableTimes());
        }
        return view('admin.orders.show' , get_defined_vars());
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id)->delete();
        Report::addToLog('  حذف الحجوزات') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Order::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الحجوزات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
