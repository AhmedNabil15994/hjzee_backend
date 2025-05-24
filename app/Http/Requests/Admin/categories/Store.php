<?php

namespace App\Http\Requests\Admin\categories;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.*'                  => 'required|max:191|unique:categories,name',
            'parent_id'               => 'nullable|exists:categories,id',
            'type'                    => 'required|in:service,place',
            'image'                   => ['nullable','image'],
            'sort'                    => 'nullable',
        ];
    }
}
