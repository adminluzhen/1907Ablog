<?php

namespace App\Http\Middleware;

use Closure;

class CheckCom
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
        $user = $request->session()->get('comuser');
        if(!$user){
            return \redirect('comment/showlogin');
        }
        return $next($request);
    }
}
