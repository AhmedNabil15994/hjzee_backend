<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash;
use App\Models\Provider;
use App\Http\Requests\Provider\Auth\ResetPasswordRequest;
use App\Traits\ResponseTrait;
use App\Traits\GeneralTrait;

class ResetPasswordController extends Controller{
    use ResponseTrait,GeneralTrait;

    public function showResetForm(){
        return view('provider.auth.reset_password');
    }

    public function createReset(ResetPasswordRequest $request){
        if (!$provider = Provider::where('email', $request['email'])
            // ->where('country_code', $request['country_code'])
            ->first()) {
            return $this->response('fail',__('auth.failed'));
        }
        if (!$this->isCodeCorrect($provider, $request->code)) {
            return $this->response('fail',__('auth.code_invalid'));
        }

        $provider->update(['password' => $request->password, 'code' => null, 'code_expire' => null]);
        return $this->response('success',__('auth.password_changed'), ['url' => route('provider.login')]);
    }

}
