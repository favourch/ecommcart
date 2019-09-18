<?php

namespace App\Http\Middleware;

use Closure;

class VerifyUserIsSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return \Illuminate\Http\Response
     */
    // public function handle($request, Closure $next, $subscription = 'default', $plan = null)
    public function handle($request, Closure $next)
    {
        // Temporarily for dev
        // return $next($request);

        if($request->user()->isFromPlatform() || $request->user()->isSubscribed())
            return $next($request);

        return $request->ajax() || $request->wantsJson()
                                ? response('Subscription required to access this page.', 402)
                                : redirect()->route('admin.account.billing');
    }
}
