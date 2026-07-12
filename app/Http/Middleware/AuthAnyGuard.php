<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Allows access if the user is authenticated with ANY of the 4 guards
 * (web/admin, teacher, student, parent).
 *
 * Use this instead of 'auth' when a route should be accessible to all
 * authenticated users regardless of their role — e.g. notifications,
 * profile pictures, etc.
 */
class AuthAnyGuard
{
    public function handle(Request $request, Closure $next)
    {
        foreach (['web', 'teacher', 'student', 'parent'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }
        }

        if ($request->expectsJson()) {
            abort(401, 'Unauthorized');
        }

        return redirect('/');
    }
}
