<?php

namespace App\Http\Resources\Api\Settings;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Settings\CategoryResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'image'       => $this->image,
            'is_active'   => $this->is_active,
            'type'        => $this->type,
            'parent_id'   => $this->parent_id,
            'childs'      => CategoryResource::collection($this->childes)
        ];
    }
}
