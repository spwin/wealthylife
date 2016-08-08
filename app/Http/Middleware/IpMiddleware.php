<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
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
        $allow_ip = [
            '127.0.0.1',
            '95.148.189.71'
        ];

        if(!in_array(request()->ip(), $allow_ip)){
            return redirect('soon');
        }

        return $next($request);
    }
}
