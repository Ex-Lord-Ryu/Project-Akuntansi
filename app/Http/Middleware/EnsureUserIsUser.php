<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->usertype === 'user') {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect('/')->with('error', 'Access denied.');
    }
}
