<?php

namespace App\Http\Controllers\Resident;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;

use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;
use Carbon\Carbon;

class ResidentCalendarController extends Controller
{
    public function events()
    {
        $reservations = Reservation::with('facility')
            ->where('status', '!=', 'Archived')
            ->get();

        return $reservations->map(fn ($r) => [
            'title' => $r->facility->name,
            'start' => $r->start_date_time->toIso8601String(),
            'end'   => $r->end_date_time->toIso8601String(),
        ]);
    }


    public function export(Reservation $reservation)
    {
        // Policy check — only the owner (or Staff/Admin) can export this
        $this->authorize('view', $reservation);

        $start = Carbon::parse($reservation->date->format('Y-m-d') . ' ' . $reservation->start_time->format('H:i:s'));
        $end   = Carbon::parse($reservation->date->format('Y-m-d') . ' ' . $reservation->end_time->format('H:i:s'));


        $calendar = Calendar::create($reservation->facility->name)
            ->event(
                Event::create($reservation->facility->name)
                    ->startsAt($start)
                    ->endsAt($end)
                    ->description(collect([
                        "Event: {$reservation->event_type}",
                        "Guests: {$reservation->guest_count}",
                        $reservation->notes ? "Notes: {$reservation->notes}" : null,
                    ])->filter()->implode("\n"))
            );

        return response($calendar->get(), 200, [
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="reservation.ics"',
        ]);
    }
}
