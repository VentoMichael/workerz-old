<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NoPlansAds
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
        if (request('plan') != 1 && request('plan') != 2 && request('plan') != 3 ) {
            Session::flash('errors',
                'Oops, il y a eu un souci, veuillez réessayer dans quelques instants.');
            return redirect(route('announcements.plans').'#plans');
        }
        return $next($request);
    }
}
