<?php

namespace App\Http\Controllers\Resident;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ResidentCalendarController extends Controller
{
    public function events()
    {
        $reservations = Reservation::with('facility')
            ->where('status', '!=', 'Archived')
            ->get();

        return $reservations->map(fn ($r) => [
            'title' => $r->facility->name,
            'start' => $r->date . 'T' . $r->start_time,
            'end'   => $r->date . 'T' . $r->end_time,
        ]);
    }
}
