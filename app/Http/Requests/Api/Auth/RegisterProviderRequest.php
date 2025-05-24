<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class RegisterProviderRequest extends BaseApiRequest {
  
  public function __construct(Request $request) {
    $request['phone']        = fixPhone($request['phone']);
    $request['country_code'] = fixPhone($request['country_code']);
  }

  public function rules() {
    return [
      'name'         => 'required|max:50',
      'country_code' => 'nullable|numeric|digits_between:2,5',
      'phone'        => 'nullable|numeric|digits_between:8,10|unique:providers,phone',
      'email'        => 'required|email|unique:providers,email|max:50',
      'password'     => 'required|min:6|max:100',
      'gender'       => 'nullable|in:male,female',
      'birth_date'   => 'nullable',
      'type'         => 'required|in:service,place',
      'image'        => 'nullable',
    ];
  }

}
