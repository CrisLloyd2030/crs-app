<?php

namespace App\Http\Middleware;

use App\Helpers\UserHelpers;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = UserHelpers::myRoleId();

        // Check if the user has the required role
        if ($user && $user == $role) {
            return $next($request);
        }

        return response()->view('auth.403_error', [], 403);
    }
}
