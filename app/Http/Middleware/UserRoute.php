<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserRoute
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
        if ($request->route('worker') && $request->route('worker')->role_id == 3) {
            Session::flash('not-permitted',
                'Oops ! La personne que vous recherchez n\'est pas un indépendant');
            return Redirect(route('workerz'));
        }
        if ($request->route('worker') && $request->route('worker')->banned == 1) {
            Session::flash('not-permitted',
                'Oops ! La personne que vous recherchez n\'est pas disponible pour le moment');
            return Redirect(route('workerz'));
        }
        return $next($request);
    }
}
