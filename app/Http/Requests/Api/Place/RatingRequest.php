<?php

namespace App\Http\Requests\Api\Place;

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
            'meeting_room_id'    => 'required|exists:meeting_rooms,id',
        ];
            
    }

}
