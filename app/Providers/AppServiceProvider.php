<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Facility;
use App\Models\Resident;
use App\Models\Reservation;
use App\Models\Staff;
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
        Facility::observe(BaseAuditObserver::class);
        Resident::observe(BaseAuditObserver::class);
        Reservation::observe(BaseAuditObserver::class);
        Staff::observe(BaseAuditObserver::class);
        User::observe(BaseAuditObserver::class);
    }
}
