<?php

namespace App\Http\Resources\Api\Provider;

use App\Http\Resources\Api\Provider\ProviderResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProviderCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => ProviderResource::collection($this->collection),
        ];

    }
}
