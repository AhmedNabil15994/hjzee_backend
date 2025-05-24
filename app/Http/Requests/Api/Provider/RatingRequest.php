<?php

namespace App\Http\Requests\Api\Provider;

use App\Http\Requests\Api\BaseApiRequest;

class RatingRequest extends BaseApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rate'          => 'required',
            'provider_id'    => 'required|exists:providers,id',
        ];
            
    }

}
