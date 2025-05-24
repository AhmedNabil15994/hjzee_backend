<?php

namespace App\Http\Resources\Api\Place;

use App\Http\Resources\Api\Place\PlaceResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlaceCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => PlaceResource::collection($this->collection),
        ];

    }
}
