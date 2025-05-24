<?php

namespace App\Http\Resources\Api\Place;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Provider\ProviderResource;
use App\Http\Resources\Api\Settings\CategoryDetailsResource;
use App\Http\Resources\Api\Settings\CityResource;
use App\Http\Resources\Api\Place\PlaceImagesResource;
use App\Http\Resources\Api\Room\MeetingRoomsResource;

class PlaceDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'description'         => $this->description,

            'provider'            => new ProviderResource($this->provider),
            'category'            => new CategoryDetailsResource($this->category),
            'city'                => new CityResource($this->city),
            
            'lat'                 => $this->lat,
            'lng'                 => $this->lng,
            'address'             => $this->address,
            'images'              => PlaceImagesResource::collection($this->images),
            'rooms'               => MeetingRoomsResource::collection($this->rooms)
        ];
    }
}
