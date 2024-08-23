<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function registerPolicies(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-only', function ($user) {
            return $user->is_admin; // Assuming 'is_admin' is a boolean column in your users table
        });
    }
}
