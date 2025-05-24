<?php

namespace App\Http\Requests\Api\Service;

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
            'service_id'    => 'required|exists:services,id',
        ];
            
    }

}
