<?php

namespace App\Providers;

use App\Services\AuthenticationService;
use App\Services\Contracts\AuthenticationServiceInterface;
use App\Services\Contracts\IpAddressServiceInterface;
use App\Services\IpAddressService;
use Illuminate\Support\ServiceProvider;

class ServiceClassProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
        $this->app->bind(IpAddressServiceInterface::class, IpAddressService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
