<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class ActivateRequest extends BaseApiRequest {
  public function __construct(Request $request) {
    // $request['phone']        = fixPhone($request['phone']);
    // $request['country_code'] = fixPhone($request['country_code']);
  }

  public function rules() {
    return [
      'code'         => 'required|max:10',
      // 'country_code' => 'required|exists:users,country_code',
      // 'phone'        => 'required|exists:users,phone',
      'email'        => 'required|exists:users,email',
      'device_id'    => 'nullable|max:250',
      'device_type'  => 'nullable|in:ios,android,web',
    ];
  }
}
