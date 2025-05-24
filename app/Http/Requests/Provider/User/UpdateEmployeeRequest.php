<?php

namespace App\Http\Requests\Provider\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function __construct(Request $request) {
        $request['phone']        = fixPhone($request['phone']);
    }

    public function rules()
    {
        return [
            'name'     => 'required|max:191',
            'phone'    => 'required|min:8|unique:providers,phone,'.request()->id,
            'email'    => 'required|email|max:191|unique:providers,email,'.request()->id,
            'password' => ['nullable', 'min:6'],
            'image'                    => ['nullable', 'image'],
            'employee_permissions'     => 'nullable|array',
        ];
    }
}
