<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\Service\ServiceDetailsResource;
use App\Http\Resources\Api\Service\ServiceCollection;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Service\AddToFavouritesRequest;
use App\Http\Requests\Api\Service\RatingRequest;
use App\Models\Category;

class ServiceController extends Controller {
  use ResponseTrait;

  public function services(Request $request) {
    $services = Service::Active()->when($request->name , function ($q)use($request){
                              return $q->whereFuzzy('name', $request->name);
                          })
                          ->when($request->provider_name , function ($q)use($request){
                            return $q->whereHas('provider', function($query)use($request) {
                              return $query->whereFuzzy('name', $request->provider_name);
                            });
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
                          ->orderBy('pin','DESC')
                          ->orderBy('sort','ASC')
                          ->latest()->paginate($this->paginateNum());

    return $this->successData( new ServiceCollection($services));
  }

  public function comingSoonServices(Request $request) {
    $services = Service::Active()->where('start_date','>=',date('Y-m-d H:i:s'))->orderBy('start_date','ASC')->paginate($this->paginateNum());
    return $this->successData( new ServiceCollection($services));
  }

  public function newestServices(Request $request) {
    $services = Service::Active()->latest()->paginate($this->paginateNum());
    return $this->successData( new ServiceCollection($services));
  }

  public function serviceDetails(Service $service) {
    $service->increment('num_views');
    return $this->successData( new ServiceDetailsResource($service));
  }


  public function addServiceToFavorites(AddToFavouritesRequest $request) {
    auth()->user()->favoriteServices()->toggle($request->validated());
    return $this->successMsg(__('apis.success'));
  }

  public function favoriteServices(){
      return $this->successData(new ServiceCollection(auth()->user()->favoriteServices()->paginate($this->paginateNum())));             

  }

  public function ratingService(RatingRequest $request){
    $service = Service::find($request->service_id);
    $service->ratings()->create($request->validated()+(['user_id' => auth()->id()]));
    $service->update(['num_rating' => $service->num_rating + 1,'rate' => $service->ratings->avg('rate')]);
    return $this->successMsg(__('apis.rating_success'));
  }

}
