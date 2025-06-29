<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ApiHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // add Accept: application/json header
        $request->headers->set('Accept', 'application/json');

        if ($request->hasHeader('Authorization')) {
            $bearerToken = $request->header('Authorization');
            $token = PersonalAccessToken::findToken(str_replace('Bearer ', '', $bearerToken));

            if ($token) {
                Auth::setUser($token->tokenable);
            }
        }
        return $next($request);
    }
}
