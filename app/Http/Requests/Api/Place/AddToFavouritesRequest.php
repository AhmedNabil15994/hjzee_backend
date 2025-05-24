<?php

namespace App\Http\Requests\Api\Place;

use App\Http\Requests\Api\BaseApiRequest;

class AddToFavouritesRequest extends BaseApiRequest
{
    public function rules() {
        return [
            'meeting_room_id'    => 'required|exists:meeting_rooms,id',
        ];
    }
}
