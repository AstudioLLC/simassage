<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param null $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle(Request $request, Closure $next, $type = null)
    {
        if ($request->user() && $request->user()->isAdmin($request->user()->role ?? null)) {
            $admin_language = Language::where('admin', 1)->select('iso')->first();
            if ($admin_language) {
                app()->setLocale($admin_language->iso);
            }

            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
