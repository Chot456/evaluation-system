<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if (session()->has('LoggedUser') && (url('userLogin') == $request->url() || url('userRegister')) == $request->url() ) {
        //     return back();
        // }
        return $next($request);
    }
}
