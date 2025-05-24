<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\Place\PlaceDetailsResource;
use App\Http\Resources\Api\Room\MeetingRoomDetailsResource;
use App\Http\Resources\Api\Place\PlaceCollection;
use App\Http\Resources\Api\Room\MeetingRoomResource;
use App\Http\Resources\Api\Room\MeetingRoomCollection;
use App\Http\Requests\Api\Place\AddToFavouritesRequest;
use App\Http\Requests\Api\Place\RatingRequest;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Category;
use App\Models\MeetingRoom;
use App\Http\Resources\Api\Room\MeetingRoomTimeResource;
use Carbon\Carbon;

class PlaceController extends Controller {
  use ResponseTrait;

  public function places(Request $request) {
    $places = Place::Active()
                          ->when($request->category_id, function($query)use($request){
                            $category = Category::find($request->category_id);
                            $ids = categoriesTreeIds($category);
                            return $query->whereIntegerInRaw('category_id',$ids);
                          })
                          ->orderBy('pin','DESC')
                          ->orderBy('sort','ASC')
                          ->latest()->paginate($this->paginateNum());

    return $this->successData( new PlaceCollection($places));
  }
  
  public function newestPlaces(Request $request) {
    $places = Place::Active()->latest()->paginate($this->paginateNum());
    return $this->successData( new PlaceCollection($places));
  }

  public function placeDetails(Place $place) {
    return $this->successData( new PlaceDetailsResource($place));
  }

  public function meetingRoomDetails(MeetingRoom $meetingRoom) {
    $meetingRoom->increment('num_views');
    return $this->successData( new MeetingRoomDetailsResource($meetingRoom));
  }

  public function meetingRoomTimes(MeetingRoom $meetingRoom)
  {
      $times = $meetingRoom->times;//()->get();
      $data = MeetingRoomTimeResource::collection($times) ;
     return $this->serviceGetDay($data,$meetingRoom);
  }

  public function serviceGetDay($data,$meetingRoom){
    $collection = collect($data);
    // Define a custom order for days of the week
    // $dayOrder = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    for($i = 0;$i < 7;$i++){
      $dayOrder[]= date('l',strtotime('+'.$i.' days'));
    }
    // Initialize an array with all days, setting available_times to an empty array
    $responseData = array_fill_keys($dayOrder, ['name' => null, 'day' => null,'date' => null, 'available_times' => []]);

    // Group the data by day
    $grouped = $collection->groupBy('day');
    // Iterate through each day and update available_times if data is present
    foreach ($responseData as $day => &$responseItem) {
        if ($grouped->has($day)) {
            $date            = date('Y-m-d',strtotime($day));
            $group = $grouped->get($day);
            // Sort the group based on 'time' value
            $sortedGroup = $group->sortBy('time');
            $availableTimes = $sortedGroup->map(function ($item)use($meetingRoom,$day,$date) {
              if($meetingRoom->orders->where('date',$date)->where('time' , $item['time'])->whereIn('status',[0,1])->count() > 0){
                return null;
              }
              if ($date == date('Y-m-d') && $item['time'] < date('H:i')) {
                return null;
              }

              if ($item['time'] === null) {
                  return null;
              }
                return [
                    'id'            => $item['id'],
                    'time'          => $item['time'],
                    'time_formated' => ($item['time'])? Carbon::parse($item['time'])->format('h:i A'): null,
                ];
            });

            $responseItem = [
                'name'  => $sortedGroup->first()['name']??'',
                'day'   => $day,
                'date'  => $date,
                'available_times' => $availableTimes->filter()->values()->all(), // Remove null values
            ];
        }else{
            $responseItem['name'] = __('admin.'.$day); 
            $responseItem['day'] = $day;
            $responseItem['date'] = date('Y-m-d',strtotime($day));
        }
    }

    return $this->successData(array_values($responseData));
}

  public function otherOffices(MeetingRoom $meetingRoom) {
    $meetingRooms = MeetingRoom::Active()->where('id','!=',$meetingRoom->id)->where('place_id',$meetingRoom->place_id)->latest()->get();
    return $this->successData( MeetingRoomResource::collection($meetingRooms));
  }

  public function meetingRooms(Request $request) {
    $rooms = MeetingRoom::Active()->when($request->name , function ($q)use($request){
                            return $q->whereFuzzy('name', $request->name);
                          })
                          ->when($request->category_id, function($query)use($request){
                            $category = Category::find($request->category_id);
                            $ids = categoriesTreeIds($category);
                            return $query->whereIntegerInRaw('category_id',$ids);
                          })
                          ->when($request->city_id, function($query)use($request){
                            return $query->whereHas('place', function($query)use($request) {
                              $query->where('city_id',$request->city_id);
                            });
                          })
                          ->when($request->start_price, function($query)use($request){
                            return $query->where('offer_price','>=',$request->start_price);
                          })
                          ->when($request->end_price, function($query)use($request){
                            return $query->where('offer_price','<=',$request->end_price);
                          })
                          ->when($request->num_seats, function($query)use($request){
                            return $query->where('num_seats','>=',$request->num_seats);
                          })
                          ->orderBy('pin','DESC')
                          ->orderBy('sort','ASC')
                          ->latest()->paginate($this->paginateNum());

    return $this->successData( new MeetingRoomCollection($rooms));
  }

  public function newestMeetingRooms(Request $request) {
    $rooms = MeetingRoom::Active()->latest()->paginate($this->paginateNum());
    return $this->successData( new MeetingRoomCollection($rooms));
  }

  public function addMeetingRoomToFavorites(AddToFavouritesRequest $request) {
    auth()->user()->favoriteMeetingRooms()->toggle($request->validated());
    return $this->successMsg(__('apis.success'));
  }

  public function favoriteMeetingRooms(){
      return $this->successData(new MeetingRoomCollection(auth()->user()->favoriteMeetingRooms()->paginate($this->paginateNum())));             

  }

  public function ratingMeetingRoom(RatingRequest $request){
    $room = MeetingRoom::find($request->meeting_room_id);
    $room->ratings()->create($request->validated()+(['user_id' => auth()->id()]));
    $room->update(['num_rating' => $room->num_rating + 1,'rate' => $room->ratings->avg('rate')]);
    return $this->successMsg(__('apis.rating_success'));
  }

}
