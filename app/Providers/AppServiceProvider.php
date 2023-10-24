<?php

namespace App\Providers;

use App\Models\Profile;
use App\Observers\ProfileObserver;
use Illuminate\Pagination\Paginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Bootstrap 5 für die Pagination ausgewählt
        Paginator::useBootstrapFive();
        Profile::observe(ProfileObserver::class); // Observer wird für das Model angemeldet

        /*
        // Ohne Observer Klasse
        Profile::updated(function($profil) {
            // Reaktion
        });
        */
    }
}
