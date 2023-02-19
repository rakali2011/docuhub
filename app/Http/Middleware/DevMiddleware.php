<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DevMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (!auth()->user()->hasRole('dev')) {
                abort(404, "Not Found");
            }
        }
        return $next($request);
    }
}
