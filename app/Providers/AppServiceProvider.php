<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
