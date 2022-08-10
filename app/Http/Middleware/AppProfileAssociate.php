<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AppProfileAssociate
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
        // VERIFY PROFILES LIST
        if(!session()->has('profiles'))
            return redirect(route('home'));

        $profiles = session()->get('profiles');

        // SE PROFILE UNICO
        if(session()->get('profile'))
        {
            // PERFIL SESSION
            $profile = session()->get('profile');

            // SALVA NA SESSAO
            session()->put('side-menu', $profiles[$profile]['side-menu']);
        }
        else
        {
            $profile = false;
        }

        // GET PREFIX
        if(!$profile && !$request->route()->getPrefix())
            return redirect(route('home'))->withStatus('Perfil indefinido!');

        if($request->route()->getPrefix())
        {
            // NORMALIZA PRFIX
            $profile = str_replace("/", "", $request->route()->getPrefix());

            // GET PREFIX
            if(!isset($profiles[$profile]))
                return redirect(route('home'))->withStatusError("No authorization to access this {$profile} profile");

            // PUT SESSION
            session()->put('profile', $profile);
            session()->put('side-menu', $profiles[$profile]['side-menu']);
        }

        // TODO:CUSTOMER-FINANCIAL
        // TODO:CUSTOMER-MANAGER

        return $next($request);
    }
}
