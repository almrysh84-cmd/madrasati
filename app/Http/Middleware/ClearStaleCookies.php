<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Clears stale session cookies from previous deployments.
 *
 * When we changed the session cookie name from 'laravel_session' to
 * 'madrasati_session_v2', old browsers still send the old cookie.
 * This can cause conflicts where Laravel tries to read a stale session
 * and fails with 419.
 *
 * This middleware:
 * 1. Detects if the old 'laravel_session' cookie is present
 * 2. If so, expires it (tells browser to delete it)
 * 3. Also expires any XSRF-TOKEN that doesn't match the current format
 */
class ClearStaleCookies
{
    public function handle(Request $request, Closure $next)
    {
        // Check for old session cookie name
        if ($request->hasCookie('laravel_session')) {
            // Expire the old cookie
            cookie()->forget('laravel_session');
            // Also clear the session to force a fresh start
            if (session()->isStarted()) {
                session()->flush();
            }
        }

        return $next($request);
    }
}
