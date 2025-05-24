<?php

namespace App\Http\Resources\Api\Room;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingRoomTimeResource extends JsonResource
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
            'name'          => __('admin.'.$this->day),
            'date'          => date('Y-m-d',strtotime($this->day)),
            'day'           => $this->day,
            'time'          => $this->time,
            'time_formated' => date('h:i a',strtotime($this->time)),
            'price'         => $this->price,
        ];
    }
}
