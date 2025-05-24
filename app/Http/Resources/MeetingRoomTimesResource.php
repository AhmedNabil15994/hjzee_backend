<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingRoomTimesResource extends JsonResource
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
            'meeting_room_id' => $this->meeting_room_id,
            'day'           => $this->day,
            'time'          => $this->time,
            'time_formated' => date('h:i a',strtotime($this->time)),
        ];
    }
}
