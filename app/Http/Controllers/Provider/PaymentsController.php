<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illumminate\Support\Facades\Auth;
use App\Models\Transaction;
class PaymentsController extends Controller
{

    public function index(){
    	$payments = [];//Payment::where('provider_id',$this->data['user']->id)->get();
        return view('provider.payments.index',get_defined_vars());
    }

    
    
}
