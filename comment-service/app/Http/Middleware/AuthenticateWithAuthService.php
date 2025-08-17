<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthenticateWithAuthService
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Call auth-service to verify token
        $response = Http::withToken($token)
            ->get(env('AUTH_SERVICE_URL') . '/api/user');

        if ($response->failed()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Attach user data from auth-service
        $request->merge(['auth_user' => $response->json()]);

        return $next($request);
    }
}
