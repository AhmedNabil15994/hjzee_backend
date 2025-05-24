<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\serviceratings\Store;
use App\Http\Requests\Admin\serviceratings\Update;
use App\Models\ServiceRating ;
use App\Models\Service;
use App\Traits\Report;


class RatingServiceController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $ratings = ServiceRating::search(request()->searchArray)->paginate(30);
            $html = view('admin.service_ratings.table' ,compact('ratings'))->render() ;
            return response()->json(['html' => $html]);
        }
        $services = Service::orderBy('name','ASC')->get();
        return view('admin.service_ratings.index',get_defined_vars());
    }

    public function create()
    {
        return view('admin.service_ratings.create');
    }


    public function store(Store $request)
    {
        ServiceRating::create($request->validated());
        Report::addToLog('  اضافه تقييم خدمة') ;
        return response()->json(['url' => route('admin.service-ratings.index')]);
    }
    public function edit($id)
    {
        $rating = ServiceRating::findOrFail($id);
        return view('admin.service_ratings.edit' , ['rating' => $rating]);
    }

    public function update(Update $request, $id)
    {
        $rating = ServiceRating::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل تقييم خدمة') ;
        return response()->json(['url' => route('admin.service-ratings.index')]);
    }

    public function show($id)
    {
        $rating = ServiceRating::findOrFail($id);
        return view('admin.service_ratings.show' , ['rating' => $rating]);
    }
    public function destroy($id)
    {
        $rating = ServiceRating::findOrFail($id)->delete();
        Report::addToLog('  حذف تقييم خدمة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ServiceRating::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من تقييمات الخدمات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
