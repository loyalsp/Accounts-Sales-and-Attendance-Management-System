<?php

namespace App\Http\Middleware;

use Closure,
    Illuminate\Support\Facades\Auth;

class User
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
        if(Auth::check() && !Auth::user()->isAdmin())
            return $next($request);
        else
            Auth::logout();
            return response('Not Authroized',401);
    }
}
