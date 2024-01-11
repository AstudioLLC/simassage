<?php

namespace App\Http\Middleware;

use App\Constants\UserRole;
use Closure;

class RedirectIfAuthenticated
{
    /**
     * @param $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (auth($guard)->check()) {
                if (auth($guard)->user()->role < UserRole::SPONSOR) {
                    return redirect()->route(env('CMS_HOMEPAGE_ROUTE'));
                } else {
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
