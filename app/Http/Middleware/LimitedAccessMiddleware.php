<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use App\Helpers\Helpers;
use Closure;

class LimitedAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $access = Helpers::checkAccess();

        if(!$access){
            Session::flash('flash_notification.suspended.message', 'You cannot access the page you requested until the launch on 9 January 2017');
            Session::flash('flash_notification.suspended.level', 'danger');
            return redirect()->action('FrontendController@index');
        }

        return $next($request);
    }
}
