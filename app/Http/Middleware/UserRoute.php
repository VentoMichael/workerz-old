<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        if($request->route('workerz') && ! $request->route('workerz')->independent() )
        {
            return redirect()->route('home.index');
        }
        return $next($request);
    }
}
