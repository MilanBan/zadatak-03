<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruiterMiddleware
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
        // return $next($request);

        if(!Auth::check()) {
            return response(['Messages' => 'You are not logged in'], 401);
        }else{
            return in_array(Auth::user()->role_id, array('2','1')) ? $next($request) : response(['Messages' => 'Access Denied!'], 403);
        }
    }
}
