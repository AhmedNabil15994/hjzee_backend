<?php

namespace App\Http\Resources\Api\Service;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Provider\ProviderResource;
use App\Http\Resources\Api\Service\ServiceImagesResource;
class ServiceResource extends JsonResource
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
              'price'               => $this->price,
              'offer_price'         => $this->offer_price,
              'category_id'         => $this->category_id,
              'provider'            => new ProviderResource($this->provider),
              'start_date'          => date('Y-m-d h:i a',strtotime($this->start_date)),

              'allow_notes'         => $this->allow_notes,
              'is_free'             => $this->is_free,
              'need_confirm'        => $this->need_confirm,

              'num_seats'           => $this->num_seats,
              'num_reservations'    => $this->num_reservations,
              
              'rate'                => $this->rate,
              'num_rating'          => $this->num_rating,
              'is_fav'              => (auth()->check())? (auth()->user()->favoriteServices()->wherePivot('service_id', $this->id)->exists()? true : false) : false,
              'images'              => ServiceImagesResource::collection($this->images),


            ];
        }
}
