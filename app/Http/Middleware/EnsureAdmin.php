<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        }
        return redirect('/admin/login');
    }
}

