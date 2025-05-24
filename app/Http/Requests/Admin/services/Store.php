<?php

namespace App\Http\Requests\Admin\services;

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
            'place_id'            => 'nullable|exists:places,id',
            'category_id'         => 'required|exists:categories,id',
            'name.*'              => 'required' ,
            'description.*'       => 'required' ,
            'times.*'             => 'required' ,
            'start_date'          => 'required',
            'price'               => 'nullable' ,
            'offer_price'         => 'nullable' ,
            'num_seats'           => 'required',
            'num_reservations'    => 'nullable',
            'address'             => 'nullable',
            'type'                => 'nullable' ,
            'options'             => 'nullable|array',

            'allow_notes'         => 'nullable',
            'is_free'             => 'nullable',
            'need_confirm'        => 'nullable',
            'sort'                 => 'nullable',

            'target_audience'     => 'nullable|array',
            'from_age'            => 'nullable',
            'to_age'              => 'nullable',
            'expire_at'           => 'nullable',
        ];
    }
}
