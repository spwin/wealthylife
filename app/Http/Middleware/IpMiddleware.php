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
            '95.148.189.54',
	        '5.81.190.114',
            '86.150.64.122',
            '78.56.165.176',
            '78.56.180.116',
            '188.69.215.193',
            '86.146.148.90'
        ];

        if(!in_array(request()->ip(), $allow_ip)){
            return redirect('soon');
        }

        return $next($request);
    }
}
