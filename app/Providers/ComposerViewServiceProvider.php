<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Genre;

class ComposerViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.menu', function ($view) {
            $genres =  Genre::pluck('name', 'id');
            $view->with('genres', $genres);
        });
    }
}
