<?php

namespace App\Http\Resources\Api\Room;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Room\MeetingRoomImagesResource;
use App\Http\Resources\Api\Place\PlaceResource;
use App\Http\Resources\Api\OptionsResource;
use App\Http\Resources\Api\Room\MeetingRoomTimeResource;

class MeetingRoomDetailsResource extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'place'         => new PlaceResource($this->place),
            'price'         => $this->price,
            'offer_price'   => $this->offer_price,
            'num_seats'     => $this->num_seats,
            'rate'          => $this->rate,
            'num_rating'    => $this->num_rating,
            'num_views'     => $this->num_views,
            
            'allow_notes'         => $this->allow_notes,
            'need_confirm'        => $this->need_confirm,

            'options'       => OptionsResource::collection($this->options()),
            'images'        => MeetingRoomImagesResource::collection($this->images),
            'times'         => MeetingRoomTimeResource::collection($this->availableTimes()),
            'is_fav'        => (auth()->check())? (auth()->user()->favoriteMeetingRooms()->wherePivot('meeting_room_id', $this->id)->exists()? true : false) : false,

        ];
    }
}
