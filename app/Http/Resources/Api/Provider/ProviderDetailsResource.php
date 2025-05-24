<?php

namespace App\Http\Resources\Api\Provider;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderDetailsResource extends JsonResource
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
            // 'type'                => $this->type,
            'gender'              => $this->gender,
            'job'                 => $this->job,
            'info'                => $this->info,
            'education_info'      => $this->education_info,
            'rate'                => $this->rate,
            'num_rating'          => $this->num_rating,
            'num_courses'         => $this->num_courses,
            'num_lessons'         => $this->num_lessons,
            'image'               => $this->image,
            'is_fav'              => (auth()->check())? (auth()->user()->favoriteProviders()->wherePivot('provider_id', $this->id)->exists()? true : false) : false,
        ];
    }
}
