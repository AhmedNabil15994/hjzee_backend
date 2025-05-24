<?php

namespace App\Http\Requests\Provider\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'               => 'required|max:191',
            'phone'              => 'required|min:8|unique:providers,phone',
            'email'              => 'required|email|max:191|unique:providers,email',
            'password'           => ['required', 'min:6'],
            'type'               => 'required|in:service,place',
            'gender'             => 'nullable|in:male,female',
            // 'image'              => 'nullable|image',
        ];
    }
}
