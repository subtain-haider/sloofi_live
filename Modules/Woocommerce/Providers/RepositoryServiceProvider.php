<?php

namespace Modules\Woocommerce\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Woocommerce\Repositories\WoocommerceRepository;
use Modules\Woocommerce\Interfaces\WoocommerceInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WoocommerceInterface::class,WoocommerceRepository::class);
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
