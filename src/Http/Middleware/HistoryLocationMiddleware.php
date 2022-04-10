<?php

namespace TheBachtiarz\UserLog\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;
use TheBachtiarz\UserLog\Traits\Service\UserHistoryTraitService;

class HistoryLocationMiddleware
{
    use ErrorLogTrait, UserHistoryTraitService;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $_location = null;

        try {
            if ($request->has(tbuserlogconfig('location_param_name'))) {
                throw_if(!is_string($request->get(tbuserlogconfig('location_param_name'))), 'Exception', "Invalid history location format");

                $_location = $request->get(tbuserlogconfig('location_param_name'));
            }
        } catch (\Throwable $th) {
            self::logCatch($th);
        } finally {
            self::setHistoryLocation($_location);

            return $next($request);
        }
    }
}
