<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\meetingrooms\Store;
use App\Http\Requests\Admin\meetingrooms\Update;
use App\Models\MeetingRoom ;
use App\Models\MeetingRoomTime ;
use App\Traits\Report;
use App\Models\Place;
use App\Models\MeetingRoomImages ;
use App\Models\Category;
use App\Models\Options ;

class MeetingRoomController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $meetingrooms = MeetingRoom::search(request()->searchArray)->paginate(30);
            $html = view('admin.meetingrooms.table' ,compact('meetingrooms'))->render() ;
            return response()->json(['html' => $html]);
        }
        $places = Place::orderBy('name','ASC')->get();
        $categories = Category::where('type','place')->get();
        return view('admin.meetingrooms.index',get_defined_vars());
    }

    public function create()
    {
        $places = Place::orderBy('name','ASC')->get();
        $categories = Category::where('type','place')->where('parent_id',null)->get();
        $options = Options::orderBy('name','ASC')->get();
        return view('admin.meetingrooms.create',get_defined_vars());
    }

    private function storeFiles($room, $files)
    {    
        foreach ($files as $file) {
            $room->images()->create(['image' => $file]);
        }
    }

    public function store(Store $request)
    {
        $allow_notes = ($request->allow_notes)? 1:0;
        $need_confirm = ($request->need_confirm)? 1:0;
        $room  = MeetingRoom::create($request->validated()+(['allow_notes' => $allow_notes,'need_confirm' => $need_confirm]));
        if ($request->hasFile('images')) {
            $this->storeFiles($room, $request->file('images'));
        }

        $times = [];
        if(isset($request['times'])){
            foreach ($request['times'] as $key => $time) {
                $times[$key]  = $time;
            }
        }
        $day = 0;
        // dd($times);
        foreach ($times as $key => $value) {
            // dd($value);
            $day_times = [];
                if(isset($value['is_full_day']) && $value['is_full_day'] == '1'){
                    for($i = 0 ; $i <= 23; $i++ ){
                        $day_times[] = ['meeting_room_id' => $room->id ,'day' => $key , 'time'=> $i.':00','price' => $request->day_prices[$day]??0];
                    }
                }else{
                    if(isset($value['from']) && isset($value['to'])){
                        $value['times'] = array_combine($value['from'],$value['to']);
                        // dd($value['times'] ,$value['price']);
                        $j = 0;
                        foreach ($value['times'] as $k => $x) {
                                for($i = $k ; $i <= intval($x); $i++ ){
                                    $day_times[] = ['meeting_room_id' => $room->id ,'day' => $key , 'time'=> $i.':00','price' =>$value['price'][$j]??0];
                                }
                            $j++;
                        }
                    }
                }
            $day_times = array_map("unserialize", array_unique(array_map("serialize", $day_times)));
            (count($day_times))?MeetingRoomTime::insert($day_times) : '';
            $day++;
        }
        Report::addToLog('  اضافه غرفة') ;
        return response()->json(['url' => route('admin.meetingrooms.index')]);
    }
    public function edit($id)
    {
        $meetingroom = MeetingRoom::findOrFail($id);
        $places = Place::orderBy('name','ASC')->get();
        $categories = Category::where('type','place')->where('parent_id',null)->get();
        $options = Options::orderBy('name','ASC')->get();
        return view('admin.meetingrooms.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $meetingroom = MeetingRoom::findOrFail($id);
        $allow_notes = ($request->allow_notes)? 1:0;
        $need_confirm = ($request->need_confirm)? 1:0;
        $meetingroom->update($request->validated()+(['allow_notes' => $allow_notes,'need_confirm' => $need_confirm]));
        if ($request->hasFile('images')) {
            $this->storeFiles($meetingroom, $request->file('images'));
        }

        $meetingroom->times()->delete();
        $times = [];
        if(isset($request['times'])){
            foreach ($request['times'] as $key => $time) {
                $times[$key]  = $time;
            }
        }
        $day = 0;
        foreach ($times as $key => $value) {
        // dd($value);
            $day_times = [];
                if(isset($value['is_full_day']) && $value['is_full_day'] == '1'){
                    for($i = 0 ; $i <= 23; $i++ ){
                        $day_times[] = ['meeting_room_id' => $meetingroom->id ,'day' => $key , 'time'=> $i.':00','price' => $request->day_prices[$day]??0];
                    }
                }else{
                    if(isset($value['from']) && isset($value['to'])){

                        $value['times'] = array_combine($value['from']??[],$value['to']??[]);
                        $j = 0;
                        foreach ($value['times'] as $k => $x) {
                                for($i = $k ; $i <= intval($x); $i++ ){
                                    $day_times[] = ['meeting_room_id' => $meetingroom->id ,'day' => $key , 'time'=> $i.':00','price' =>$value['price'][$j]??0];
                                }
                            $j++;
                        }
                    }
                }
            $day_times = array_map("unserialize", array_unique(array_map("serialize", $day_times)));
            (count($day_times))?MeetingRoomTime::insert($day_times) : '';
            $day++;
        }
        Report::addToLog('  تعديل غرفة') ;
        return response()->json(['url' => route('admin.meetingrooms.index')]);
    }

    public function show($id)
    {
        $meetingroom = MeetingRoom::findOrFail($id);
        $places = Place::orderBy('name','ASC')->get();
        $categories = Category::where('type','place')->where('parent_id',null)->get();
        $options = Options::orderBy('name','ASC')->get();
        return view('admin.meetingrooms.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $meetingroom = MeetingRoom::findOrFail($id)->delete();
        Report::addToLog('  حذف غرفة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (MeetingRoom::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من غرف الاجتماعات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function deleteImage(Request $request)
    {
        $image = MeetingRoomImages::find($request->image_id);
        $image->delete();
        return response()->json(['msg' => 'success']);
    }
}
