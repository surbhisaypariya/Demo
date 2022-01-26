<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class checkStatus
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
        $response = $next($request);
        if(Auth::check() && Auth::user()->user_status != '1'){
            Auth::logout();
            return redirect('/login')->with('error', 'Sorry! Your user status is not active');
        }
        // return $response;
        return $next($request);
    }
}
