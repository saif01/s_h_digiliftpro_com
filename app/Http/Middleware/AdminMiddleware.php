<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Allow administrator role (seeded as "administrator")
        if (method_exists($user, 'hasRole') && $user->hasRole(['administrator', 'admin'])) {
            return $next($request);
        }

        return response()->json(['message' => 'Forbidden'], 403);
    }
}


