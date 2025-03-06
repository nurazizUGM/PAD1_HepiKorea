<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role != Role::ADMIN) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'You are not authorized to access this page'], 403);
            }
            return redirect('/')->withErrors(['error' => 'You are not authorized to access this page']);
        }
        return $next($request);
    }
}
