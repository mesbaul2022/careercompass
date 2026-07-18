<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
        public function handle(Request $request, Closure $next): Response
        {
            // Allow BOTH admins and organizations into the protected routes
            if (! $request->user() || !in_array($request->user()->role, ['admin', 'organization'])) {
                abort(403, 'Unauthorized — Access Restricted.');
            }
            return $next($request);
        }
}
