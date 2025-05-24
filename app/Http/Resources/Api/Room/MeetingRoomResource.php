<?php

namespace App\Http\Resources\Api\Room;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Room\MeetingRoomImagesResource;
use App\Http\Resources\Api\Place\PlaceResource;

class MeetingRoomResource extends JsonResource
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
            'id'     => $this->id,
            'name'   => $this->name,
            'place'         => new PlaceResource($this->place),
            'price'         => $this->price,
            'offer_price'   => $this->offer_price,
            'rate'          => $this->rate,
            'num_rating'    => $this->num_rating,
            'num_seats'     => $this->num_seats,
            
            'allow_notes'         => $this->allow_notes,
            'need_confirm'        => $this->need_confirm,
            'is_fav'        => (auth()->check())? (auth()->user()->favoriteMeetingRooms()->wherePivot('meeting_room_id', $this->id)->exists()? true : false) : false,
            'images'        => MeetingRoomImagesResource::collection($this->images),
        ];
    }
}
