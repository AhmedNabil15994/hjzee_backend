<?php

namespace App\Http\Requests\Provider\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ResendCodeRequest extends FormRequest {
  public function __construct(Request $request) {
    // $request['phone']        = fixPhone($request['phone']);
    // $request['country_code'] = fixPhone($request['country_code']);
  }

  public function rules() {
    return [
      // 'country_code' => 'required|exists:providers,country_code',
      'email'        => 'required|exists:providers,email',
    ];
  }
}
