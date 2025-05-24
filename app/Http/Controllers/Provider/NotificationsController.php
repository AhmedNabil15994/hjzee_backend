<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class NotificationsController extends Controller
{
    use ResponseTrait;
    public function index(){
	    auth()->guard('provider')->user()->unreadNotifications->markAsRead();
	    $notifications = auth()->guard('provider')->user()->notifications()->paginate($this->paginateNum());
        return view('provider.notifications.index',get_defined_vars());
    }

    public function deleteNotifications(){
    	auth()->guard('provider')->user()->notifications()->delete();
        return $this->response('success', __('apis.deleted'),['url' => route('provider.notifications')]);
    }
        
}
