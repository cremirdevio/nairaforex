<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserRegistrationComplete
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
        if (auth()->user()->profileUncompleted()) {
            return redirect()->route('account')->with('info', 'To continue, you have to complete your registration. Fill in your banking details.');
        }
        return $next($request);
    }
}