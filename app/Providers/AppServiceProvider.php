<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register( \Modules\Category\Providers\RepositoryServiceProvider::class);
        $this->app->register( \Modules\Warehouse\Providers\RepositoryServiceProvider::class);
        $this->app->register( \Modules\Product\Providers\RepositoryServiceProvider::class);
        $this->app->register( \Modules\Shopify\Providers\RepositoryServiceProvider::class);
        $this->app->register( \Modules\Woocommerce\Providers\RepositoryServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
