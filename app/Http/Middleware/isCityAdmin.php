<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isCityAdmin
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
        if(!$request->user()->hasRole('city_admin'))
        {
            abort(404);
        }
        return $next($request);
    }
}
