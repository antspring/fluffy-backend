<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResourceRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $restrictedRoute = ['store', 'update', 'destroy'];
        $currentRoute = $request->route()->getActionMethod();

        if (in_array($currentRoute, $restrictedRoute) && !($request->user()->hasRole('admin') || $request->user()->hasRole('employee'))) {
            abort(403, 'Unauthorized action');
        }


        return $next($request);
    }
}
