<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\places\Store;
use App\Http\Requests\Admin\places\Update;
use App\Models\Place ;
use App\Traits\Report;
use App\Models\City ;
use App\Models\Country ;
use App\Models\SiteSetting;
use App\Models\Provider ;
use App\Models\PlaceImages ;
use App\Models\Category;

class PlaceController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $places = Place::search(request()->searchArray)->paginate(30);
            $html = view('admin.places.table' ,compact('places'))->render() ;
            return response()->json(['html' => $html]);
        }
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $cities = City::whereIn('country_id',$supported_countries)->orderBy('name','ASC')->get();
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $categories = Category::where('type','place')->get();
        return view('admin.places.index',get_defined_vars());
    }

    public function create()
    {
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $cities = City::whereIn('country_id',$supported_countries)->orderBy('name','ASC')->get();
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $categories = Category::where('type','place')->where('parent_id',null)->get();
        return view('admin.places.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        $place = Place::create($request->validated());
        if ($request->hasFile('images')) {
            $this->storeFiles($place, $request->file('images'));
        }
        Report::addToLog('  اضافه المكان') ;
        return response()->json(['url' => route('admin.places.index')]);
    }

    private function storeFiles($place, $files)
    {    
        foreach ($files as $file) {
            $place->images()->create(['image' => $file]);
        }
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $cities = City::whereIn('country_id',$supported_countries)->orderBy('name','ASC')->get();
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $categories = Category::where('type','place')->where('parent_id',null)->get();
        return view('admin.places.edit',get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $place = Place::findOrFail($id);
        $place->update($request->validated());
        if ($request->hasFile('images')) {
            $this->storeFiles($place, $request->file('images'));
        }
        Report::addToLog('  تعديل المكان') ;
        return response()->json(['url' => route('admin.places.index')]);
    }

    public function show($id)
    {
        $place = Place::findOrFail($id);
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $cities = City::whereIn('country_id',$supported_countries)->orderBy('name','ASC')->get();
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $categories = Category::where('type','place')->where('parent_id',null)->get();
        return view('admin.places.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $place = Place::findOrFail($id)->delete();
        Report::addToLog('  حذف المكان') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Place::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الأماكن') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function deleteImage(Request $request)
    {
        $image = PlaceImages::find($request->image_id);
        $image->delete();
        return response()->json(['msg' => 'success']);
    }
}
