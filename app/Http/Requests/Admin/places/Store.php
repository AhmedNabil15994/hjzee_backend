<?php

namespace App\Http\Requests\Admin\places;

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
            'provider_id'         => 'required|exists:providers,id',
            'category_id'         => 'required|exists:categories,id',
            'city_id'             => 'nullable|exists:cities,id',
            'name.*'              => 'required' ,
            'description.*'       => 'required' ,
            'lat'                 => 'nullable',
            'lng'                 => 'nullable',
            'address'             => 'required',
            'num_meeting_rooms'   => 'nullable',
            'sort'                 => 'nullable',
        ];
    }
}
