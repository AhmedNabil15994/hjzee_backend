<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\providerratings\Store;
use App\Http\Requests\Admin\providerratings\Update;
use App\Models\ProviderRating ;
use App\Traits\Report;
use App\Models\Provider;


class RatingProviderController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $ratings = ProviderRating::search(request()->searchArray)->paginate(30);
            $html = view('admin.provider_ratings.table' ,compact('ratings'))->render() ;
            return response()->json(['html' => $html]);
        }
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        return view('admin.provider_ratings.index',get_defined_vars());
    }

    public function create()
    {
        return view('admin.provider_ratings.create');
    }


    public function store(Store $request)
    {
        ProviderRating::create($request->validated());
        Report::addToLog('  اضافه تقييم لمقدم الخدمة') ;
        return response()->json(['url' => route('admin.provider-ratings.index')]);
    }
    public function edit($id)
    {
        $rating = ProviderRating::findOrFail($id);
        return view('admin.provider_ratings.edit' , ['rating' => $rating]);
    }

    public function update(Update $request, $id)
    {
        $rating = ProviderRating::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل تقييم مقدم الخدمة') ;
        return response()->json(['url' => route('admin.provider-ratings.index')]);
    }

    public function show($id)
    {
        $rating = ProviderRating::findOrFail($id);
        return view('admin.provider_ratings.show' , ['rating' => $rating]);
    }
    public function destroy($id)
    {
        $rating = ProviderRating::findOrFail($id)->delete();
        Report::addToLog('  حذف تقييم مقدم الخدمة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ProviderRating::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من تقييمات مقدمي الخدمات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
