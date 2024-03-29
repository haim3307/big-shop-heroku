<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && env('APP_ENV') === 'production') {
            // for Proxies
            Request::setTrustedProxies([$request->getClientIp()]);

            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
