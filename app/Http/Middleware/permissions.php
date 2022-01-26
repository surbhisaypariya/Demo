<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class permissions
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
        if(Auth::check())
        {
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'customer')
            {
                return $next($request);
            }
        }
        return Redirect()->back()->with('error', 'Access Denied');
    }
}
