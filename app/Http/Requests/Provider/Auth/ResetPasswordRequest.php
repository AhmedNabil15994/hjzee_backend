<?php

namespace App\Http\Requests\Provider\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest {
  public function __construct(Request $request) {
    // $request['phone']        = fixPhone($request['phone']);
    // $request['country_code'] = fixPhone($request['country_code']);
  }

  public function rules() {
    return [
      'code'         => 'required|max:10',
      // 'country_code' => 'required|exists:providers,country_code',
      // 'phone'        => 'required|exists:providers,phone',
      'email'        => 'required|exists:providers,email',
      'password'     => 'required|min:6|max:100',
    ];
  }
}
