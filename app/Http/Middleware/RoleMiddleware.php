<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Make role check case-insensitive
        if (strtolower(auth()->user()->role) !== strtolower($role)) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}