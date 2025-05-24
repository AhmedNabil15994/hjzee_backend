<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ResponseTrait;

class CheckProviderRole
{
  use ResponseTrait;
  /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            $authPermissions = (auth('provider')->check()) ? auth('provider')->user()->employee_permissions : [];
            $currentRequest = \Request::route()->getName();

            // dd($authPermissions, $currentRequest);
            if (in_array($currentRequest, $authPermissions??[])){
                return $next($request);
            }else{
                if ($request->ajax()) {
                  return $this->unauthorizedReturn(['type' => 'notAuth']);
                }
                $msg = trans('auth.not_authorized');
                session()->flash('danger', $msg);
                return redirect()->route('provider.index');
            }
    }
}
