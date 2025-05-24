<?php

namespace App\Http\Requests\Provider\Reservation;

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
          // 'user_id'        => 'required|exists:users,id',
          'name'           => 'required|max:191',
          'country_code'   => 'required',
          'phone'          => 'required|min:8',
          'email'          => 'required|email|max:191',
          
          'service_id'         => 'nullable|exists:services,id',
          'quantity'       => 'nullable',
          // 'final_total'    => 'nullable',
         
          'pay_type'            => 'nullable',
          'pay_status'          => 'nullable',
          'notes'     => 'nullable',
        ];
      }
}
