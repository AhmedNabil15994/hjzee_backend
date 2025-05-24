<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class UpdateDeviceDataRequest extends BaseApiRequest {

  public function rules() {
    return [
      'device_id'   => 'nullable|max:250',
      'device_type' => 'nullable|in:ios,android,web',
    ];
  }



}
