<?php

namespace App\Http\Requests\Admin\providers;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'               => 'required|max:191',
            'parent_id'          => 'nullable|exists:providers,id',
            'country_code'       => 'required',
            'phone'              => 'required|min:8||unique:providers,phone,'.$this->id,
            'email'              => 'required|email|max:191|unique:providers,email,'.$this->id,
            'password'           => ['nullable', 'min:6'],

            'type'               => 'nullable',
            'gender'             => 'nullable',
            'job.*'              => 'nullable' ,
            'info.*'             => 'nullable' ,
            'education_info.*'   => 'nullable' ,
            'num_courses'        => 'nullable' ,
            'num_lessons'        => 'nullable' ,
            'image'              => 'nullable|image',
            // 'employee_permissions'     => 'nullable|array',
            'notes'              => 'nullable',
            // 'expire_at'          => 'nullable',
        ];
    }
}
