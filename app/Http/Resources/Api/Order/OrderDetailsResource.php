<?php

namespace App\Http\Resources\Api\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Provider\ProviderResource;
use App\Http\Resources\Api\Service\ServiceDetailsResource;
use App\Http\Resources\Api\Place\PlaceDetailsResource;
use App\Http\Resources\Api\Room\MeetingRoomDetailsResource;

use App\Enums\OrderType;

class OrderDetailsResource extends JsonResource
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
            'id'              => (int) $this->id ,
            'order_num'       => (int) $this->order_num ,
            'provider'        => new ProviderResource($this->provider),
            'service'         => new ServiceDetailsResource($this->service),
            'place'           => new PlaceDetailsResource($this->place) ,
            'meetingRoom'     => new MeetingRoomDetailsResource($this->meetingRoom) ,
            'date'            => ($this->date)? date('Y-m-d',strtotime($this->date)) : null,
            'time'            => ($this->time)? date('h:i a',strtotime($this->time)) : null,
            'quantity'        => $this->quantity ,
            'price'           => $this->price ,
            'coupon_amount'   => $this->coupon_amount ,
            'final_total'     => $this->final_total ,

            'type_text'       => (string) $this->type_text ,
            'type'            => (string) OrderType::slug($this->type),

            'status_text'     => (string) $this->status_text ,
            
            'pay_type_text'   => (string) $this->pay_type_text ,
            'pay_status_text' => (string) $this->pay_status_text ,

            'created_at'      => $this->created_at->diffForHumans() ,
        ];
    }
}
