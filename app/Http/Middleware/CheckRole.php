<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * P1-1 fix: Simple role-based access control middleware.
 *
 * Usage in routes:
 *   Route::middleware(['auth', 'role:admin'])->group(...)
 *
 * The 'role' column is added to the users table by the migration
 * 2026_07_16_000010_add_role_to_users_table.php.
 *
 * Default role for existing users is 'admin' (set by the migration),
 * so existing deployments are not locked out.
 */
class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect(RouteServiceProvider::HOME);
        }

        // The 'role' column only exists on the users (admin) table.
        // Teacher / Student / Parent guards are already isolated by their
        // own auth guards — this middleware is for fine-grained admin roles.
        if (!in_array($request->user()->role ?? 'admin', $roles, true)) {
            abort(403, 'غير مصرح لك بالوصول إلى هذه الصفحة');
        }

        return $next($request);
    }
}
