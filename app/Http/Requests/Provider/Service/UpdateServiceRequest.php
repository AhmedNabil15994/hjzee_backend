<?php

namespace App\Http\Requests\Provider\Service;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'place_id'            => 'nullable|exists:places,id',
            'category_id'         => 'required|exists:categories,id',
            'name.*'              => 'required' ,
            'description.*'       => 'required' ,
            'times.*'             => 'required' ,
            'price'               => 'required' ,
            'offer_price'         => 'nullable' ,
            'address'             => 'nullable',
            'target_audience'     => 'nullable|array',
            'from_age'            => 'nullable',
            'to_age'              => 'nullable',

            'start_date'          => 'required',
            'num_seats'           => 'required',
            'num_reservations'    => 'nullable',
            'options'     => 'nullable|array',

            'allow_notes'         => 'nullable',
            'is_free'             => 'nullable',
            'need_confirm'        => 'nullable',
        ];
    }
}
