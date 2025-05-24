<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProviderAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('provider')->check()) {
            return $next($request);
        } else {
            return redirect('/provider/login');
        }
    }
}
