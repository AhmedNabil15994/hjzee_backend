<?php

namespace App\Http\Resources\Api\Service;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Provider\ProviderResource;
use App\Http\Resources\Api\Place\PlaceResource;
use App\Http\Resources\Api\Service\ServiceImagesResource;
use App\Http\Resources\Api\Settings\CategoryDetailsResource;
use App\Http\Resources\Api\OptionsResource;

class ServiceDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
        public function toArray($request) {
            return [
              'id'                  => $this->id,
              'name'                => $this->name,

              'provider'            => new ProviderResource($this->provider),
              'place'               => new PlaceResource($this->place),
              'category'            => new CategoryDetailsResource($this->category),

              'description'         => $this->description,
              'start_date'          => date('Y-m-d h:i a',strtotime($this->start_date)),
              'times'               => $this->times,
              'price'               => $this->price,
              'offer_price'         => $this->offer_price,
              'address'             => $this->address,
              
              'allow_notes'         => $this->allow_notes,
              'is_free'             => $this->is_free,
              'need_confirm'        => $this->need_confirm,

              'options'             => OptionsResource::collection($this->options()),
              
              'target_audience'     => $this->target_audience,
              'from_age'            => $this->from_age,
              'to_age'              => $this->to_age,

              'lat'                 => $this->lat,
              'lng'                 => $this->lng,
              'address'             => $this->address,
              
              'num_seats'           => $this->num_seats,
              'num_reservations'    => $this->num_reservations,
              
              'rate'                => $this->rate,
              'num_rating'          => $this->num_rating,
              'num_views'           => $this->num_views,
              'is_fav'              => (auth()->check())? (auth()->user()->favoriteServices()->wherePivot('service_id', $this->id)->exists()? true : false) : false,
              'images'              => ServiceImagesResource::collection($this->images),

            ];
        }
}
