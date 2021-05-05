<?php

namespace App\Http\Middleware;

use App\Models\PlanUser;
use Closure;
use Illuminate\Http\Request;

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
        if(request()->input('plan_user_id') == 2 || request()->input('plan_user_id') == 3 )
        {
            $plan = request()->input('plan_user_id');
            return redirect()->route('users.payed',compact('plan'));
        }else{

            return $next($request);
        }
    }
}
