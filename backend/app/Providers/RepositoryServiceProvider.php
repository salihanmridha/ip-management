<?php

namespace App\Providers;

use App\Repositories\AuditLogRepository;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\AuditLogRepositoryInterface;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\IpAddressRepositoryInterface;
use App\Repositories\IpAddressRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(IpAddressRepositoryInterface::class, IpAddressRepository::class);
        $this->app->bind(AuditLogRepositoryInterface::class, AuditLogRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
