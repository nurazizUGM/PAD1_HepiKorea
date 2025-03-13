<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiQueryLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (env('APP_ENV') !== 'production') {
            // Enable query logging
            DB::enableQueryLog();
        }

        return $next($request);
    }

    public function terminate(Request $request, Response $response)
    {
        if (env('APP_ENV') !== 'production') {
            // Get the queries executed
            $queries = DB::getQueryLog();
            $count = count($queries);
            $total_time = collect($queries)->sum('time');

            // Log the queries
            logger()->info("Executed $count queries in $total_time ms");
        }
    }
}
