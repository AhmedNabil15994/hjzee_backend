<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\City ;
use App\Models\Country ;
use App\Models\SiteSetting;
use App\Models\Provider;
use Illuminate\Support\Facades\Hash;
use App\Models\Services;
use App\Traits\SmsTrait;
use App\Traits\GeneralTrait;
use App\Traits\ResponseTrait;
use App\Http\Requests\Provider\Auth\LoginRequest;
use App\Http\Requests\Provider\Auth\RegisterRequest;

class AuthController extends Controller
{
    use ResponseTrait, SmsTrait, GeneralTrait;
    public function index(){
        return view('provider.chooselang');
    }

    public function updateLang(Request $request){
        app()->setLocale($request->lang);
        session(['lang' => $request->lang]);
        return redirect()->route('provider.loginForm');
    }

    public function loginForm(){
        return view('provider.auth.login');
    }

    public function providerLogin(LoginRequest $request){
        if (auth()->guard('provider')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if (!auth('provider')->user()->is_approved) {
            //     return $this->response('fail',__('auth.not_approved'));
            // }

            // if (auth('provider')->user()->is_blocked) {
            //     return $this->response('fail', __('auth.block'));
            // }

            // if (!auth('provider')->user()->active) {
            //     auth('provider')->user()->sendVerificationCode();
            //     return $this->response('success', __('auth.not_active'), ['url' => url('provider/activate/'.auth('playground')->user()->phone.'/'.auth('playground')->user()->country_code)]);
            // }

            return $this->response('success', __('apis.signed'), ['url' => route('provider.index')]);
        } else {
            return $this->response('fail', __('auth.incorrect_pass_or_phone'));
        }
    }

    public function showRegistrationForm(){
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $cities = City::whereIn('country_id',$supported_countries)->orderBy('name','ASC')->get();
        return view('provider.auth.register', get_defined_vars());
    }

    public function providerRegister(RegisterRequest $request){
        $provider = Provider::create($request->validated());
        // $provider->sendVerificationCode();
        return $this->response('success', __('apis.registered'), ['url' => route('provider.login')]);
    }

    public function activationPage(){
        return view('provider.auth.activationPage',$this->data);
    }

    public function activateAccount(Request $request){
        $this->validate($request, [
            'code'        => 'required'
        ]);

        if(auth()->user()->code != $request->code){
            $msg        =  __('auth.invalid_code');
            return back()->with('error',$msg);
        }
        auth()->user()->markAsActive();

            $user  = auth()->user();
            if($user->type == 'hospital'){
                if($user->complete_work_info == 'false'){
                    return redirect()->route('hospital.completeHospitalInfoPage');
                }
                if($user->complete_time_info == 'false'){
                    return redirect()->route('hospital.completeHospitalTimeInfoPage');
                }
            }elseif($user->type == 'hospital_employee'){
                $hospital = $user->hospital;
                if($hospital->complete_work_info == 'false'){
                    return redirect()->route('hospital.completeHospitalInfoPage');
                }
                if($hospital->complete_time_info == 'false'){
                    return redirect()->route('hospital.completeHospitalTimeInfoPage');
                }
            }else{
                Auth::logout();
                return back()->with('error',__('auth.not_hospital'));
            }
            return redirect()->route('hospital.index');
    }


    public function logoutProvider(){
        auth('provider')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('provider.loginForm');
    }
}
