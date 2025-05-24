<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Models\MeetingRoom;
use App\Models\Service;
use App\Models\Provider;
use App\Http\Resources\Api\Room\MeetingRoomResource;
use App\Http\Resources\Api\Service\ServiceResource;
use App\Http\Resources\Api\Provider\ProviderResource;

use App\Http\Resources\Api\Service\ServiceCollection;

class UserController extends Controller {
  use ResponseTrait;

  public function searchAll(Request $request) {
    $rooms = MeetingRoom::Active()->when($request->name , function ($q)use($request){
                            return $q->whereFuzzy('name', $request->name);
                          })
                          ->orderBy('pin','DESC')
                          ->orderBy('sort','ASC')
                          ->latest()->paginate($this->paginateNum());
    $services = Service::Active()->when($request->name , function ($q)use($request){
                            return $q->whereFuzzy('name', $request->name);
                        })
                        ->orderBy('pin','DESC')
                        ->orderBy('sort','ASC')
                        ->latest()->paginate($this->paginateNum());
    $providers = Provider::Active()->when($request->name , function ($q)use($request){
                          return $q->whereFuzzy('name', $request->name);
                      })
                      ->orderBy('name','ASC')
                      ->latest()->paginate($this->paginateNum());

    return $this->successData( ['rooms' => MeetingRoomResource::collection($rooms),
                                'services' => ServiceResource::collection($services),
                                'providers' => ProviderResource::collection($providers),
                               ]);
  }

}
