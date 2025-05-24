<?php

namespace App\Http\Requests\Provider\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function __construct(Request $request) {
        $request['phone']  = fixPhone($request['phone']);
      }
    
      public function rules() {
        return [
          'phone'          => 'required|numeric',
        ];
      }
}
