<?php

namespace Modules\Product\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Product\Interfaces\ProductInterface;
use Modules\Product\Repositories\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductInterface::class,ProductRepository::class);
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
