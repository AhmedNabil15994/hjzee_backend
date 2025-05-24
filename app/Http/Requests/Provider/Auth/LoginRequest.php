<?php

namespace App\Http\Requests\Provider\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function __construct(Request $request) {
        $request['phone']        = fixPhone($request['phone']);
    }

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email'               => 'required|min:8|exists:providers,email',
            'password'            => 'required|min:6',
        ];
    }
}
