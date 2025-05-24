<?php

namespace App\Http\Resources\Api\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentsResource extends JsonResource {


  public function toArray($request) {
    return [
      'id'                  => $this->id,
      'amount'              => $this->amount,
      'message'             => $this->message,
      'date'                => $this->created_at->format('Y-m-d H:i'),
    ];
  }
}
