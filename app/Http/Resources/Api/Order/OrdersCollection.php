<?php

namespace App\Http\Resources\Api\Order;

use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Api\Order\OrdersResource;

class OrdersCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => OrdersResource::collection($this->collection),
        ];

    }
}
