<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class ChargeWalletRequest extends BaseApiRequest
{

    public function rules() {
        return [
            'amount'         => 'required'
        ];
    }
}
