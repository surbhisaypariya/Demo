<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Attatchment;

class attatchmentPermission
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
        $attatchment =  new Attatchment;
        if(Auth::check())
        {
            if(Auth::user()->role == 'super_admin' ||  $attatchment->user_id == Auth::user()->id)
            {
                return $next($request);
            }
        }
        return Redirect()->back()->with('error', 'Access Denied');
    }
}
