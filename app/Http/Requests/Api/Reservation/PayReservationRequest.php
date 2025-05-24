<?php

namespace App\Http\Requests\Api\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PayReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

      public function rules() {
        return [
          'coupon_num'       => 'nullable',
          'pay_type'         => 'required',
        ];
      }
}
