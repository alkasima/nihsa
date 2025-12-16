<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = auth()->user();

        // Super admins bypass all permission checks
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Handle multiple permissions (separated by |)
        $permissions = explode('|', $permission);

        // Check if user has any of the required permissions
        foreach ($permissions as $perm) {
            if ($user->hasPermission(trim($perm))) {
                return $next($request);
            }
        }

        // User doesn't have permission
        abort(403, 'You do not have permission to access this page.');
    }
}
