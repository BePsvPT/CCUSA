<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Log;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthenticateWithBasicAuth extends \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth
{
    use ThrottlesLogins;

    /**
     * The maximum number of login attempts for delaying further attempts.
     *
     * @var int
     */
    protected $maxLoginAttempts = 3;

    /**
     * Get the number of seconds to delay further login attempts.
     *
     * @var int
     */
    protected $lockoutTime = 300;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            Log::notice('tooManyLoginAttempts', ['ip' => $request->ip()]);

            throw new AccessDeniedHttpException;
        }

        if (! $request->getUser() || ! $request->getPassword() || $this->auth->basic('username')) {
            $this->incrementLoginAttempts($request);

            throw new UnauthorizedHttpException('Basic');
        }

        return $next($request);
    }

    /**
     * Get the login username to be used by the middleware.
     *
     * @return string
     */
    protected function loginUsername()
    {
        return '';
    }
}
