<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param array $roles
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (is_null($user)) {
            if ($request->ajax()) {
                throw new UnauthorizedHttpException('Unauthorized');
            }

            return redirect()->guest(route('auth.sign-in'));
        }

        if (! $user->hasRole($roles)) {
            throw new AccessDeniedHttpException;
        }

        return $next($request);
    }
}
