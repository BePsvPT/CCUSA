<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateWithBasicAuth extends \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $this->auth->basic('username') ?: $next($request);
    }
}
