<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestAPI
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
        $appKey= $request->header("Authorization");
      
        if(! $appKey==csrf_token())
            return response(['message'=>"Unauthorized User"],Response::HTTP_UNAUTHORIZED);
        

        return $next($request);
        
    }
}
