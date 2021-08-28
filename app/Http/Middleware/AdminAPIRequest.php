<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminAPIRequest
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
        // return dd($guards);
        foreach($guards as $index=>$guard){
            if(Auth::guard($guard)->check()){
                return $next($request);
            }
        }
        // return $next($request);
        return response(['message'=>"Unauthorzied User Role"],Response::HTTP_UNAUTHORIZED);
      
        
            
    }
}
