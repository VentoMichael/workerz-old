<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnnouncementRoute
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
        if($request->route('announcement') && $request->route('announcement')->is_payed == 0 && $request->route('announcement')->is_draft == 0 && $request->route('announcement')->banned == 0  ) {
            Session::flash('not-permitted',
                'Oops ! L\'annonce que vous recherchez n\'est pas disponible');
            return Redirect(route('announcements'));
        }
        return $next($request);
    }
}
