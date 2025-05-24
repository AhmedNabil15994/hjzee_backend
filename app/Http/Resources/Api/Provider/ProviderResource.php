<?php

namespace App\Http\Resources\Api\Provider;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
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
            'job'                 => $this->job,
            'image'               => $this->image,
            'is_fav'              => (auth()->check())? (auth()->user()->favoriteProviders()->wherePivot('provider_id', $this->id)->exists()? true : false) : false,
        ];
    }
}
