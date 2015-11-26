<?php

namespace App\Http\Middleware;

use Closure;

class AppendAdditionalHeaders
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
        $headers = [
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'sameorigin',
            'X-XSS-Protection' => '1; mode=block',
        ];

        // 如果為 debug 模式或未設置 CSP，則略過
        if (! config('app.debug') && ! empty($csp = env('CSP'))) {
            $headers['Content-Security-Policy'] = $headers['X-Content-Security-Policy'] = $csp;
        }

        // 如已是加密連線或設置為強至加密連線，則設置 HSTS 與 HPKP
        if ($request->secure() || env('WEBSITE_HTTPS', false)) {
            $headers['Strict-Transport-Security'] = 'max-age=15552000; preload;';

            // 確認已設置 HPKP
            if (! empty($pins = env('PUBLIC_KEY_PINS'))) {
                $publicKeyPins = '';

                foreach (explode(',', $pins) as $pin) {
                    $publicKeyPins .= " pin-sha256=\"{$pin}\";";
                }

                $headers['Public-Key-Pins'] = "{$publicKeyPins} max-age=600;";
            }

            // 檢查是否需加上 includeSubDomains
            if (! empty(env('HTTPS_INCLUDE_SUB_DOMAINS'))) {
                $headers['Strict-Transport-Security'] .= ' includeSubDomains;';

                if (isset($headers['Public-Key-Pins'])) {
                    $headers['Public-Key-Pins'] .= ' includeSubdomains;';
                }
            }

            if (! $request->secure()) {
                return redirect()->secure($request->getRequestUri(), 302, $headers);
            }
        }

        /** @var $response \Illuminate\Http\Response */

        $response = $next($request);

        $response->headers->add($headers);

        return $response;
    }
}
