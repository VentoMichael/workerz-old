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
        if ($request->plan_announcement_id == 2 || $request->plan_announcement_id == 3) {
            $plan = $request->plan_announcement_id;
            return redirect()->route('announcements.payed', compact('plan'));
        }
        return $next($request);
    }
}
