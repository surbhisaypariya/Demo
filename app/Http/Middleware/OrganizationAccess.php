<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class OrganizationAccess
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
            if(Auth::user()->role == 'super_admin')
            {
                return $next($request);
            }
        }
        return Redirect()->back()->with('error', 'Access Denied');
        return $next($request);
    }
}
