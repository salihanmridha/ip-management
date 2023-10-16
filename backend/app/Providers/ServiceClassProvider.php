<?php

namespace App\Providers;

use App\Services\AuthenticationService;
use App\Services\Contracts\AuthenticationServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceClassProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
