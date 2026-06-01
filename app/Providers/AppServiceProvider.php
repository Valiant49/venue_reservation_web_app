<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Client;
use App\Models\Facility;
use App\Models\Reservation;
use App\Models\User;
use App\Observers\BaseAuditObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Client::observe(BaseAuditObserver::class);
        Facility::observe(BaseAuditObserver::class);
        Reservation::observe(BaseAuditObserver::class);
        User::observe(BaseAuditObserver::class);
    }
}
