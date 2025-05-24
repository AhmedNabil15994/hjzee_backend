<?php

namespace App\Http\Requests\Api\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateServiceReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

      public function rules() {
        return [
          'service_id'     => 'nullable|exists:services,id',
          'quantity'       => 'nullable',
          'users_names'    => 'required|array',
          'notes'          => 'nullable'
        ];
      }
}
