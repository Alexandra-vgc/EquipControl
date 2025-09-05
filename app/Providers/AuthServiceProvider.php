<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gates para AdminLTE - verifican roles de Spatie
        Gate::define('admin', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('editor', function ($user) {
            return $user->hasRole('editor');
        });

        Gate::define('lector', function ($user) {
            return $user->hasRole('lector');
        });
    }
}