<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  \Closure
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->usertype === 'user') {
            return $next($request);
        }

        // If the user is not authenticated or not a user, redirect them or return a response
        return redirect('/')->with('error', 'Access denied.');
    }
}
