<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackVisitors
{
    public function handle(Request $request, Closure $next)
    {
        // Minimal no-op middleware. Implement logging into visitor_logs if desired.
        return $next($request);
    }
}


