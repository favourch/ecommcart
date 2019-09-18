<?php

namespace App\Http\Middleware;

use Closure;

class VerifyUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->isAdmin())
            return $next($request);

        return $request->ajax() || $request->wantsJson()
                                ? response('Only the admin users can access this page.', 402)
                                : redirect()->route('admin.admin.dashboard');
    }
}
