<?php

namespace App\Providers;

use App\Services\Amazon\SPAPIService;
use App\Services\Interfaces\SPAPIServiceInterface;
use Illuminate\Support\ServiceProvider;

class SPAPIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * This method is executed during the service provider registration phase.
     * It binds the SPAPIService class to the SPAPIServiceInterface
     * and registers it in Laravel's service container.
     */
    public function register()
    {
        $this->app->bind(SPAPIServiceInterface::class, SPAPIService::class);
    }

    public function boot(): void
    {

    }
}
