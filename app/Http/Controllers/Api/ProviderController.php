<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\Provider\ProviderDetailsResource;
use App\Http\Resources\Api\Service\ServiceCollection;
use App\Http\Resources\Api\Provider\ProviderCollection;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Service;
use App\Http\Requests\Api\Provider\AddToFavouritesRequest;
use App\Http\Requests\Api\Provider\RatingRequest;

class ProviderController extends Controller {
  use ResponseTrait;

  public function providerDetails(Provider $provider) {
    if(!$provider->is_active){
      return $this->failMsg(__('apis.provider_not_active_now'));
    }
    return $this->successData( new ProviderDetailsResource($provider));
  }

  public function providerServices(Request $request) {
    $provider = Provider::findOrFail($request->provider_id);
    if(!$provider->is_active){
      return $this->failMsg(__('apis.provider_not_active_now'));
    }
    $services = Service::Active()->where('provider_id',$request->provider_id)->latest()->paginate($this->paginateNum());
    return $this->successData( new ServiceCollection($services));
  }


  public function addProviderToFavorites(AddToFavouritesRequest $request) {
    auth()->user()->favoriteProviders()->toggle($request->validated());
    return $this->successMsg(__('apis.success'));
  }

  public function favoriteProviders(){
      return $this->successData(new ProviderCollection(auth()->user()->favoriteProviders()->paginate($this->paginateNum())));             
  }

  public function ratingProvider(RatingRequest $request){
    $provider = Provider::find($request->provider_id);
    $provider->ratings()->create($request->validated()+(['user_id' => auth()->id()]));
    $provider->update(['num_rating' => $provider->num_rating + 1,'rate' => $provider->ratings->avg('rate')]);
    return $this->successMsg(__('apis.rating_success'));
  }

}
