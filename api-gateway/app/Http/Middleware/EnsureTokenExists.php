<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EnsureTokenExists
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('token') && !$request->is('/')) {
            Log::info('Token not found in session');
            return redirect('/')->with('error', 'Please log in first.');
        }

        // If token exists and visiting the login page, skip to posts
        if (session('token') && $request->is('/')) {
            Log::info('Token found in session, redirecting to posts');
            return redirect('/posts');
        }

        return $next($request);
    }
}
