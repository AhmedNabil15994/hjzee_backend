<?php

namespace App\Http\Requests\Api\Service;

use App\Http\Requests\Api\BaseApiRequest;

class AddToFavouritesRequest extends BaseApiRequest
{
    public function rules() {
        return [
            'service_id'    => 'required|exists:services,id',
        ];
    }
}
