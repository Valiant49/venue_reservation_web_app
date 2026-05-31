<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('admin-access', function (User $user) {
            return $user->fresh()->role === 'admin';
        });

        Gate::define('staff-access', function (User $user){
            return $user->fresh()->role === 'staff';
        });
    }
}
