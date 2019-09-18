<?php

namespace App\Http\Middleware;

use Closure;

class DashboardSetup
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
        $dash = optional($request->user()->dashboard)->toArray();

        setDashboardConfig($dash);

        return $next($request);
    }
}
