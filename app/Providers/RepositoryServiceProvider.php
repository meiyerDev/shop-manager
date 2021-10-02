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
        $this->app->bind(\App\Repositories\EloquentRepositoryContract::class, \App\Repositories\Eloquent\EloquentRepository::class);
        $this->app->bind(\App\Repositories\ProductRepositoryContract::class, \App\Repositories\Eloquent\ProductRepository::class);
    }
}
