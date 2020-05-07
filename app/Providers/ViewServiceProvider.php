<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Genre;

class ViewServiceProvider extends ServiceProvider
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

        view()->composer('partials.menu', function($view){
            // Genre::pluck => fait une instance de Genre et appel sur l'objet créé la méthode pluck
            // les :: sont un pattern dans Laravel technique pour l'instant ne chercher pas à comprendre ce pattern Facade
            $genres = Genre::pluck('name', 'id'); // [ ['id' => 1], ['id' => 2], ['id' => 3] ]
            $view->with('genres', $genres);
        });
    }
}
