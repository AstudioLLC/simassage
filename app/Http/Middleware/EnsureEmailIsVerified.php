<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed|object
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        }

        return redirect()->route('login');
        /*if (!$request->user() || !$request->user()->hasVerifiedEmail()) {
            return redirect()->route('cabinet.emailVerification.notice')->setStatusCode(301);
        }

        return $next($request);*/
    }
}
