<?php

namespace AshAllenDesign\PasswordAge\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use AshAllenDesign\PasswordAge\Listeners\UpdatePasswordLastChangedAt;
use Illuminate\Auth\Events\PasswordReset;

class PasswordAgeEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the package.
     *
     * @var array
     */
    protected $listen = [
        PasswordReset::class => [
            UpdatePasswordLastChangedAt::class,
        ],
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
