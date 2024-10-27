<?php

namespace Baldcat\PlatformPerPage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Baldcat\PlatformPerPage\Http\Middleware\PlatformPerPageMiddleware;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class PlatformPerPageServiceProvider extends ServiceProvider
{

    public function boot(Kernel $kernel)
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'platform-pp');

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'platform-pp');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('platform-pp.php'),
            ], 'config');

        }

        $kernel->pushMiddleware(PlatformPerPageMiddleware::class);
        $kernel->appendMiddlewareToGroup('web', PlatformPerPageMiddleware::class);

        Builder::macro('ppp', function ($perPage = null): LengthAwarePaginator {
            $perPage = $perPage ?? request('pp_page', config('platform-pp.options')[0]);
            return $this->paginate($perPage);
        });

    }

}
