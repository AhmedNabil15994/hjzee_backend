<?php

namespace App\Http\Requests\Admin\meetingrooms;

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
            'name'                  => 'required|max:191',
            'place_id'              => 'required|exists:places,id',
            'category_id'           => 'required|exists:categories,id',
            'options'               => 'nullable|array',
            'allow_notes'           => 'nullable',
            'need_confirm'          => 'nullable',
            'num_reservations'    => 'nullable',
            'sort'                 => 'nullable',
        ];
    }
}
