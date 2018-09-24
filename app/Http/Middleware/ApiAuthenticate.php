<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthenticate
{
    /**
     * Saves the current URL for later. We'll be going multiple requests before
     * we're actually logged in so `previous()` won't have the last URL in flash
     * data any more
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!auth()->guard($guard)->check()) {
            return abort(401);
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        return route('login');
    }
}
