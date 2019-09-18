<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'customer':
                if (Auth::guard($guard)->check())
                    return redirect()->route('account', 'dashboard');
                break;
            default:
                if (Auth::guard($guard)->check()){
                    return redirect()->to('admin/dashboard');
                }
                break;
        }

        return $next($request);
    }
}
