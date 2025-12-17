<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $permission = '')
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Administrator bypass
        if (method_exists($user, 'hasRole') && $user->hasRole(['administrator', 'admin'])) {
            return $next($request);
        }

        if ($permission !== '' && method_exists($user, 'hasPermission') && $user->hasPermission($permission)) {
            return $next($request);
        }

        return response()->json(['message' => 'Forbidden'], 403);
    }
}


