<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PayedAds
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
        if($request->plan == 2 || old('plan') == 2 || $request->plan == 3 || old('plan') == 3){
            $plan = $request->plan;
            return redirect()->route('announcements.payed',compact('plan'));
        }
        return $next($request);
    }
}
