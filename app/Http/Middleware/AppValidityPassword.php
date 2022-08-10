<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppValidityPassword
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
        if(!isset(auth()->user()->validity_password) || empty(auth()->user()->validity_password)){
            return response()->view("auth.passwords.mandatoryReset");
        }
        else if(strtotime(auth()->user()->validity_password)<strtotime(date("Y-m-d"))){
            return response()->view("auth.passwords.mandatoryReset");
        }

        return $next($request);
    }
}
