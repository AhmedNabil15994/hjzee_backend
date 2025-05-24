<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseTrait;
use App\Http\Requests\Provider\Place\CreatePlaceRequest;
use App\Http\Requests\Provider\Place\UpdatePlaceRequest;
use App\Models\Place;
use App\Models\PlaceImages;
use App\Models\City ;
use App\Models\Country ;
use App\Models\SiteSetting;
use App\Models\Category;
class PlaceController extends Controller
{
    use ResponseTrait;

    public function places(){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $places = Place::where('provider_id',$provider_id)->get();
        return view('provider.places.index',get_defined_vars());
    }
    public function addPlace(){
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $cities = City::whereIn('country_id',$supported_countries)->orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->get();
        return view('provider.places.create',get_defined_vars());
    }

    public function createPlace(CreatePlaceRequest $request){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $place = Place::create($request->validated()+(['provider_id' => $provider_id,'is_active' => 0]));
        if ($request->hasFile('images')) {
            $this->storeFiles($place, $request->file('images'));
        }
        return $this->response('success', __('apis.added'),['url' => route('provider.places')]);
    }

    private function storeFiles($place, $files)
    {    
        foreach ($files as $file) {
            $place->images()->create(['image' => $file]);
        }
    }

    public function editPlace(Place $place){
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $cities = City::whereIn('country_id',$supported_countries)->orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->get();
        return view('provider.places.edit',get_defined_vars());
    }

    public function updatePlace(UpdatePlaceRequest $request,Place $place){
        $place->update($request->validated());
        if ($request->hasFile('images')) {
            $this->storeFiles($place, $request->file('images'));
        }
        return $this->response('success', __('apis.updated'),['url' => route('provider.places')]);
    }

    public function placeDetails(Place $place){
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $cities = City::whereIn('country_id',$supported_countries)->orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->get();
        return view('provider.places.show',get_defined_vars());
    }

    public function deletePlace(Request $request,Place $place){
        $place->delete();
        return $this->response('success', __('apis.deleted'),['url' => route('provider.places')]);
    }

    public function deleteImage(Request $request)
    {
        $image = PlaceImages::find($request->image_id);
        $image->delete();
        return response()->json(['msg' => 'success']);
    }

}
