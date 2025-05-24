<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Social;
class ContactUsController extends Controller
{

    public function index(){
    	$socials = Social::orderBy('created_at', 'desc')->get();
        return view('provider.contact.index',get_defined_vars());
    }

   
}
