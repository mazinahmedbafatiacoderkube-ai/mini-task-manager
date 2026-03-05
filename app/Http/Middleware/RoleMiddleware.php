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
            return redirect('/login');
        }

        // Make role check case-insensitive
        if (strtolower(auth()->user()->role) !== strtolower($role)) {
            abort(403, 'Forbidden: You do not have access to this page.');
        }

        return $next($request);
    }
}