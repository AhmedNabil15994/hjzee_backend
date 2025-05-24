<?php

namespace App\Http\Resources\Api\Service;

use App\Http\Resources\Api\Service\ServiceResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => ServiceResource::collection($this->collection),
        ];

    }
}
