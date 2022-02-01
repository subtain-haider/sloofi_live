<?php

namespace Modules\Shopify\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Shopify\Interfaces\ShopifyInterface;
use Modules\Shopify\Repositories\ShopifyRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ShopifyInterface::class,ShopifyRepository::class);
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
