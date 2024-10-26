<?php

namespace Baldcat\PlatformPerPage\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PlatformPerPageMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $queryPerPage = $request->query('pp_page');

        if ($request->route() && $route = $request->route()->getName()) {
            $key = 'pp_page.' . $route;

            if ($queryPerPage) {
                Cache::set($key, $queryPerPage);
            } else {
                $cachePerPage = Cache::get($key);
                if ($cachePerPage) {
                    $request->merge(['pp_page' => $cachePerPage]);
                }
            }

        }

        return $next($request);
    }

}
