<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NoPlansUser
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
        $planUser = Session::get('plan');
        if ($planUser != 1 && $planUser != 2 && $planUser != 3) {
            Session::flash('errors',
                'Oops, il y a eu un souci, veuillez réessayer dans quelques instants.');
            return redirect(route('users.plans').'#plans');

        }
        return $next($request);
    }
}
