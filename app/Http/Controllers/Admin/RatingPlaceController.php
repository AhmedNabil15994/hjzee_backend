<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\placeratings\Store;
use App\Http\Requests\Admin\placeratings\Update;
use App\Models\PlaceRating ;
use App\Traits\Report;
use App\Models\MeetingRoom ;


class RatingPlaceController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $ratings = PlaceRating::search(request()->searchArray)->paginate(30);
            $html = view('admin.place_ratings.table' ,compact('ratings'))->render() ;
            return response()->json(['html' => $html]);
        }
        $rooms = MeetingRoom::orderBy('name','ASC')->get();
        return view('admin.place_ratings.index',get_defined_vars());
    }

    public function create()
    {
        return view('admin.place_ratings.create');
    }


    public function store(Store $request)
    {
        PlaceRating::create($request->validated());
        Report::addToLog('  اضافه تقييم لمكان') ;
        return response()->json(['url' => route('admin.place-ratings.index')]);
    }
    public function edit($id)
    {
        $rating = PlaceRating::findOrFail($id);
        return view('admin.place_ratings.edit' , ['rating' => $rating]);
    }

    public function update(Update $request, $id)
    {
        $rating = PlaceRating::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل تقييم مكان') ;
        return response()->json(['url' => route('admin.place-ratings.index')]);
    }

    public function show($id)
    {
        $rating = PlaceRating::findOrFail($id);
        return view('admin.place_ratings.show' , ['rating' => $rating]);
    }
    public function destroy($id)
    {
        $rating = PlaceRating::findOrFail($id)->delete();
        Report::addToLog('  حذف تقييم مكان') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (PlaceRating::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من تقييمات الاماكن') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
