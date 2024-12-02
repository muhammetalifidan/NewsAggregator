<?php

namespace App\Providers;

use App\Contracts\AdminUserRepositoryInterface;
use App\Repositories\AdminUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AdminUserRepositoryInterface::class, AdminUserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
