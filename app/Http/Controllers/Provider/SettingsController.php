<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    public function index(){
        return view('provider.settings.index');
    }

    public function changeLang(Request $request){
        auth('provider')->user()->update(['lang' => $request->lang]);
        app()->setLocale($request->lang);
        \Carbon\Carbon::setLocale($request->lang);
        session(['lang' => $request->lang]); 
        return redirect()->route('provider.settings');
    }

}
