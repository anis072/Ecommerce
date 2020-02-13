<?php

namespace App\Http\Middleware;

use Closure;

class FrontLogin
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
        if(empty($request->session()->has('frontsession'))){
            return redirect('/login-register');
        }
        return $next($request);
    }
}
