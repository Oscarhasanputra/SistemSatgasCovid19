<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminRoutingAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,...$guards)
    {
        foreach($guards as $index=>$guard){
            if(Auth::guard($guard)->check()){
                
                return $next($request);
            }
        }
       
        return redirect(env("APP_URL")."/");
    }
}
