<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authCheck
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
         
        if(!session()->has('LoggedUser')) {
            // return view('auth.user-login');
            return redirect('userLogin');
        }

        dd('wala');
        return $next($request);
    }
}
