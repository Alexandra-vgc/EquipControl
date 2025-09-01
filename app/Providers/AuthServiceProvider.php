<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate para admin
        Gate::define('admin', function ($user) {
            return $user->hasRole('admin');
        });

        // Opcional: si quieres también para editor
        Gate::define('editor', function ($user) {
            return $user->hasRole('editor');
        });

        // Opcional: para lector
        Gate::define('lector', function ($user) {
            return $user->hasRole('lector');
        });
    }
}
