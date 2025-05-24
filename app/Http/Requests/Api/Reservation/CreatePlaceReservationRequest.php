<?php

namespace App\Http\Requests\Api\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreatePlaceReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

      public function rules() {
        return [
          'place_id'       => 'nullable|exists:places,id',
          'meeting_room_id'=> 'required|exists:meeting_rooms,id',
          'dates'          => 'required',
          'notes'          => 'nullable'
        ];
      }
}
