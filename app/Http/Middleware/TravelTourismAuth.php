<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelTourismAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!is_null(auth()->user()) && auth()->user()->hasRole('SHORT TERM RENTAL PROVIDER')){
            return $next($request);
        }
        if(!is_null(auth()->user()) && auth()->user()->hasRole('HOTEL RESORT PROVIDER')){
            return $next($request);
        }
        Auth::logout();
        return redirect('/')->with('error','Please login to continue');
    }
}
