<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTokenExists
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('token')) {
            return redirect('/')->with('error', 'Please log in first.');
        }

        return $next($request);
    }
}
