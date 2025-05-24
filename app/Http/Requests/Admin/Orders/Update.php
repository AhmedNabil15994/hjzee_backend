<?php

namespace App\Http\Requests\Admin\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\User;

class Update extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    
      public function rules() {
        return [
          'type'           => 'required',
          'user_id'        => 'required|exists:users,id',
          'provider_id'        => 'required|exists:providers,id',
          'service_id'         => 'nullable|exists:services,id',
          'place_id'           => 'nullable|exists:places,id',
          'meeting_room_id'    => 'nullable|exists:meeting_rooms,id',

          'date'           => 'nullable|date',
          'time'           => 'nullable',
          // 'price'          => 'required',
          // 'plan_discount'  => 'nullable',
          'quantity'       => 'nullable',
          'final_total'    => 'required',
         
          'is_confirmed'   => 'nullable',

          'pay_type'            => 'nullable',
          'pay_status'          => 'nullable',
          'notes'          => 'nullable',
        ];
      }
}
