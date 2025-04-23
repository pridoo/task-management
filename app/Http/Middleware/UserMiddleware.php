<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
 
        if (Auth::guard('web')->check() && !Auth::guard('admin')->check()) {
            return $next($request); 
        }

        return redirect('/login')->withErrors(['Access denied. Users only.']);
    }
}
