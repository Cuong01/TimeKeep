<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;


class ModuleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $module)
    {
        $module = Module::findOrFail($module)->getName();

        if (auth()->check()) {
            if (auth()->user()->hasAccessModule($module)) {
                return $next($request);
            }
            $listSuper = env('APP_SUPER_ADMIN');
            $listSuper = explode(",", $listSuper);
            if (in_array(auth()->user()->id, $listSuper)) {
                return $next($request);
            }
            // Check access module
            if (auth()->user()->is_admin != true) {
                abort(403, "You are not allowed access to this page!");
            }
        }
        return $next($request);
    }
}
