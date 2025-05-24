<?php

namespace App\Http\Requests\Provider\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest {

    public function authorize()
    {
        return true;
    }
  public function rules() {
    return [
      'old_password'           => 'required|min:6|max:100',
      'password'               => 'required|confirmed|min:6|max:100',
      'password_confirmation'  => 'required|min:6|max:100',
    ];
  }

  public function withValidator($validator) {
    $validator->after(function ($validator) {
      if ($this->has('old_password') && !Hash::check($this->old_password, auth('provider')->user()->password)) {
        $validator->errors()->add('old_password', trans('auth.incorrect_old_pass'));
      }
    });
  }

}
