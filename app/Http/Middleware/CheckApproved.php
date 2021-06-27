<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckApproved
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
        if (!auth()->user()->approved_at) {
            //Auth::logout();
            //return redirect('/login')->withErrors('Your account is waiting for our administrator approval');
            return redirect()->route('approval');
        }

        return $next($request);
    }
}
