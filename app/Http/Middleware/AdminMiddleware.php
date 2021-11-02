<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if(!Auth::check()) {
            return response(['Messages' => 'You are not logged in'], 401);
        }else{
            return Auth::user()->role_id == '1' ? $next($request) : response(['Messages' => 'Access Denied!'], 403);
        }
    }
}
