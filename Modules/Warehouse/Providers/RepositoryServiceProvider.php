<?php

namespace Modules\Warehouse\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Warehouse\Interfaces\WarehouseInterface;
use Modules\Warehouse\Repositories\WarehouseRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WarehouseInterface::class, WarehouseRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
