<?php

namespace App\Http\Resources\Api\Room;

use App\Http\Resources\Api\Room\MeetingRoomResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MeetingRoomCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => MeetingRoomResource::collection($this->collection),
        ];

    }
}
