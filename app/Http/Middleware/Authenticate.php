<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = "user")
    {
        if (Auth::guard($role)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                switch($role){
                    case 'admin' :
                        return redirect()->action('AdminController@login');
                        break;
                    case 'consultant' :
                        return redirect()->action('ConsultantController@login');
                        break;
                    default :
                        $request->session()->flash('modal', 'need-login');
                        return redirect()->action('FrontendController@index');
                        break;
                }
            }
        } else {
            $current = Auth::guard($role)->user()->type;
            if($current != $role && $current != 'admin' && $current != 'consultant'){
                switch($role){
                    case 'admin' :
                        return redirect()->action('AdminController@login');
                        break;
                    case 'consultant' :
                        return redirect()->action('ConsultantController@login');
                        break;
                    default :
                        return redirect()->action('FrontendController@index');
                        break;
                }
            }
        }

        return $next($request);
    }
}
