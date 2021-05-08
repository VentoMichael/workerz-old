<?php

namespace App\Http\Middleware;

use App\Models\PlanUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PayedUser
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
        if ($request->user()->plan_user_id == 2 || $request->user()->plan_user_id == 3) {
            $plan = $request->user()->plan_user_id;
            return redirect()->route('users.payed', compact('plan'));
        }
        return $next($request);
    }
}
