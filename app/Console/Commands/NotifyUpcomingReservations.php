<?php

namespace App\Console\Commands;

use App\Models\Reservation;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Console\Command;

#[Signature('reservations:notify-upcoming')]
#[Description('Command description')]
class NotifyUpcomingReservations extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetDate = now()->addDays(1)->format('Y-m-d'); // adjust "1 day ahead" to whatever window you want

        $reservations = Reservation::with(['facility', 'resident'])
            ->where('date', $targetDate)
            ->where('status', 'Confirmed')
            ->get();

        foreach ($reservations as $reservation) {
            $reservation->resident->notify(new \App\Notifications\UpcomingReservation($reservation));
        }

        $this->info("Sent {$reservations->count()} reminder(s).");
    }
}
