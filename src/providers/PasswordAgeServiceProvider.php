<?php

namespace AshAllenDesign\PasswordAge\Providers;

use AshAllenDesign\PasswordAge\Commands\CheckForExpiredPasswords;
use Illuminate\Support\ServiceProvider;

class PasswordAgeServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the packages event service provider.
        $this->app->register(PasswordAgeEventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->initPackageConfig();
        $this->initCommands();
        $this->initMigrations();
    }

    private function initPackageConfig()
    {
        $this->publishes([__DIR__ . '/config/password-age.php' => config_path('password-age.php')]);
        $this->mergeConfigFrom(__DIR__ . '/config/password-age.php', 'password-age');
    }

    private function initCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CheckForExpiredPasswords::class
            ]);
        }
    }

    private function initMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
