<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ProductRepositoryContract::class, \App\Repositories\Eloquent\ProductRepository::class);
        $this->app->bind(\App\Repositories\OrderRepositoryContract::class, \App\Repositories\Eloquent\OrderRepository::class);
        $this->app->bind(\App\Repositories\PlacetoPayRepositoryContract::class, \App\Repositories\Eloquent\PlacetoPayRepository::class);
    }
}
