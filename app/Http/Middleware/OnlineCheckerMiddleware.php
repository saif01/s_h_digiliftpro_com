<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlineCheckerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Minimal pass-through. Add maintenance/online checks here if needed.
        return $next($request);
    }
}


