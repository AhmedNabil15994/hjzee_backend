<?php

namespace App\Http\Requests\Api\Provider;

use App\Http\Requests\Api\BaseApiRequest;

class AddToFavouritesRequest extends BaseApiRequest
{
    public function rules() {
        return [
            'provider_id'    => 'required|exists:providers,id',
        ];
    }
}
