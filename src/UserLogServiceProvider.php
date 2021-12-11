<?php

namespace TheBachtiarz\UserLog;

use Illuminate\Support\ServiceProvider;

class UserLogServiceProvider extends ServiceProvider
{
    /**
     * register module userlog
     *
     * @return void
     */
    public function register(): void
    {
        $applicationUserLogService = new ApplicationUserLogService;

        $applicationUserLogService->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands($applicationUserLogService->registerCommands());
        }
    }

    /**
     * boot module userlog
     *
     * @return void
     */
    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/' . UserLogInterface::USERLOG_CONFIG_NAME . '.php' => config_path(UserLogInterface::USERLOG_CONFIG_NAME . '.php'),
            ], 'thebachtiarz-userlog-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'thebachtiarz-userlog-migrations');
        }
    }
}
