<?php

// app/Http/Middleware/IsUser.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->usertype === 'user') {
            return $next($request);
        }
        return redirect('/home')->with('error', 'You do not have user access');
    }
}