<?php

namespace App\Providers;

use App\Services\Stat;
use Illuminate\Support\ServiceProvider;

class StatisticServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // enregistrer le service dans un conteneur de service 
        // une instance unique de votre service utilisable dans votre application
        $this->app->singleton( 'App\Services\Stat', function ($app) {
            $precision = $app['config']['statistic']['precision'];

            return new Stat( $precision );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
