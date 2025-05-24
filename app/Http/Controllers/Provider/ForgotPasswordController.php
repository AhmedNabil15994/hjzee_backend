<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Http\Requests\Provider\Auth\ResendCodeRequest;
use App\Traits\ResponseTrait;

class ForgotPasswordController extends Controller{

    use ResponseTrait;

    public function showLinkRequestForm(){
        return view('provider.auth.forget_password');
    }

    public function sendResetLinkEmail(ResendCodeRequest $request)    {
        if (!$provider = Provider::where('email', $request['email'])
            // ->where('country_code', $request['country_code'])
            ->first()) {
            return $this->response('fail',__('auth.failed'));
        }
        $provider->sendVerificationCode();
        return $this->response('success', __('auth.code_re_send'), ['url' => route('provider.password.reset')]);
    }


}
