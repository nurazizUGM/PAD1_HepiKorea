<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('Authorization')) {
            $bearerToken = $request->header('Authorization');
            $token = PersonalAccessToken::findToken(str_replace('Bearer ', '', $bearerToken));

            if ($token) {
                Auth::setUser($token->tokenable);
            } else {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        } else if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {
            return response()->json(['message' => 'Authorization header not found'], 401);
        }

        return $next($request);
    }
}
