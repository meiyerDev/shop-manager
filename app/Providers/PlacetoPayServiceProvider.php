<?php

namespace App\Providers;

use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\ServiceProvider;
use Tests\Mocks\PlacetoPay\RestCarrierMock;

class PlacetoPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PlacetoPay::class,
            /** @param \Illuminate\Contracts\Foundation\Application $app */
            function (\Illuminate\Contracts\Foundation\Application $app) {
                $config = config('placetoPay.auth');
                if ($app->environment() === 'testing') $config['handler'] = RestCarrierMock::instance();
                return new PlacetoPay($config);
            }
        );
    }
}
