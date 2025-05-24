<?php

namespace App\Http\Resources\Api\Place;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Place\PlaceImagesResource;

class PlaceResource extends JsonResource
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
            'lat'                 => $this->lat,
            'lng'                 => $this->lng,
            'address'             => $this->address,
            'images'              => PlaceImagesResource::collection($this->images),
        ];
    }
}
