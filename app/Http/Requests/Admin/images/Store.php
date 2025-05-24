<?php

namespace App\Http\Requests\Admin\images;

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
            'image'                => ['required','image'],
            'name.*'                 => 'required',
            'start_date'           => 'required',
            'end_date'             => 'required',
            'link'                 => 'nullable',
            'type'                 => 'required|in:place,service,link',
            'service_id'           => 'nullable|exists:services,id',
            'place_id'             => 'nullable|exists:places,id',
            'sort'                 => 'nullable',
        ];
    }
}
