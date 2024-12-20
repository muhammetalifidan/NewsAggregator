<?php

namespace App\Providers;

use App\Contracts\AdminUserRepositoryInterface;
use App\Contracts\IncomingLogDataRepositoryInterface;
use App\Contracts\CallbackLogRepositoryInterface;
use App\Contracts\IncomingLogRepositoryInterface;
use App\Repositories\AdminUserRepository;
use App\Repositories\IncomingLogDataRepository;
use App\Repositories\CallbackLogRepository;
use App\Repositories\IncomingLogRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AdminUserRepositoryInterface::class, AdminUserRepository::class);
        $this->app->singleton(CallbackLogRepositoryInterface::class, CallbackLogRepository::class);
        $this->app->singleton(IncomingLogRepositoryInterface::class, IncomingLogRepository::class);
        $this->app->singleton(IncomingLogDataRepositoryInterface::class, IncomingLogDataRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
