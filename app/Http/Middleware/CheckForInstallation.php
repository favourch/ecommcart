<?php

namespace App\Http\Middleware;

use Closure;

class CheckForInstallation
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
        if ($request->is('install*') || file_exists(app()->storagePath().'/installed'))
            return $next($request);

        return redirect()->to('/install');
    }
}
