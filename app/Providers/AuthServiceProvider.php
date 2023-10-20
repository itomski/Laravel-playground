<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Order;
use App\Models\Profile;
use App\Models\User;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*
        // Wenn dieses Gate ein true lefert, werden alle andern Gates automatisch mit true beantwortet
        Gate::before(function(User $user) {
            return $user->hasRole('SuperAdmin');
        });
        */

        Gate::define('isAdmin', function(User $user) { // User muss angemeldet sein
            return $user->hasRole('Admin');
        });

        Gate::define('isSales', function(User $user) { // User muss angemeldet sein
            return $user->hasRole('Sales');
        });

        Gate::define('isService', function(User $user) { // User muss angemeldet sein
            return $user->hasRole('Service');
        });

        Gate::define('isProfileOwner', function(User $user, Profile $profile) {
            return $profile->user->is($user); // Prüft, ob der User Besitzer ist
        });

        /*
        Gate::define('isAdmin', function(?User $user) { // Für angemeldete und nicht angemeldete verwendbar
            return false;
        });
        */

    }
}
