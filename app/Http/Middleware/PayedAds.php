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
        if ($request->plan == 2 || $request->plan == 3) {
            $title = $request->title;
            $location = $request->location;
            $job = $request->job;
            $categoryjob = $request->category_job;
            $price_max = $request->price_max;
            $disponibility = $request->disponibility;
            $description = $request->description;
            $plan = $request->plan;
            return redirect()->route('announcements.payed', compact('title','location','job','categoryjob','price_max','disponibility','description','plan'));
        }
        return $next($request);
    }
}
