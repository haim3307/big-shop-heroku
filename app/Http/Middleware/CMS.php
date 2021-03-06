<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CMS
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
        return (!$user = Auth::user() or !$user->allowedCMS()) ? redirect('/') : $next($request);
    }
}
