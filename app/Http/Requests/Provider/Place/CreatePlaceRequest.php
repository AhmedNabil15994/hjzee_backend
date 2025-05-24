<?php

namespace App\Http\Requests\Provider\Place;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreatePlaceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'city_id'             => 'nullable|exists:cities,id',
            'category_id'         => 'required|exists:categories,id',
            'name.*'              => 'required' ,
            'description.*'       => 'required' ,
            'lat'                 => 'nullable',
            'lng'                 => 'nullable',
            'address'             => 'required',
            'num_meeting_rooms'   => 'nullable',
        ];
    }
}
