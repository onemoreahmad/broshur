<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || $user->email !== 'contact@ahmad.tech') {
            abort(403, 'Access denied. Only authorized administrators can access this panel.');
        }

        // Set Arabic locale for superadmin panel
        // app()->setLocale('ar');

        return $next($request);
    }
}

