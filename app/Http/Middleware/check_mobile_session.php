<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class check_mobile_session
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
        $routes = $request->path();
        if (!Session()->get('mobile') && $routes != "Login") {
          Session()->put('path',$routes);
            return redirect()->route('Login');
        } else {
            return $next($request);
        }
    }
}
