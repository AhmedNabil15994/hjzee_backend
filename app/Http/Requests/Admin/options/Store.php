<?php

namespace App\Http\Requests\Admin\options;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.*'                  => 'required',
        ];
    }
}
