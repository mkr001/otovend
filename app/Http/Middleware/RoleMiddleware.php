<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        // Allow if the user has the required role, OR if the user is an admin
        if ($user->role !== $role && $user->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
