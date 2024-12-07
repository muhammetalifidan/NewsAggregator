<?php

namespace App\Providers;

use App\Contracts\AdminUserRepositoryInterface;
use App\Contracts\Api\IncomingLogDataRepositoryInterface;
use App\Contracts\CallbackLogRepositoryInterface;
use App\Contracts\Api\CallbackLogRepositoryInterface as ApiCallbackLogRepositoryInterface;
use App\Contracts\IncomingLogRepositoryInterface;
use App\Contracts\Api\IncomingLogRepositoryInterface as ApiIncomingLogRepositoryInterface;
use App\Repositories\AdminUserRepository;
use App\Repositories\Api\IncomingLogDataRepository;
use App\Repositories\CallbackLogRepository;
use App\Repositories\Api\CallbackLogRepository as ApiCallbackLogRepository;
use App\Repositories\IncomingLogRepository;
use App\Repositories\Api\IncomingLogRepository as ApiIncomingLogRepository;
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

        $this->app->singleton(ApiCallbackLogRepositoryInterface::class, ApiCallbackLogRepository::class);
        $this->app->singleton(ApiIncomingLogRepositoryInterface::class, ApiIncomingLogRepository::class);
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
