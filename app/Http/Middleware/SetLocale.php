<?php

namespace App\Http\Middleware;

use App;
use Session;
use Closure;

class SetLocale
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
        if (Session::has('locale'))
            $locale = session('locale', config('app.locale'));
        else
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        if ( ! in_array($locale, ['en', 'es']) )
            $locale = 'en';

        App::setLocale($locale);

        return $next($request);
    }
}
