<?php

namespace App\Http\Controllers\Resident;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use App\Models\Facility;
use App\Models\Reservation;


class ResidentPortalController extends Controller
{
    public function dashboard()
    {
        $resident = Auth::user();
        $reservations = Auth::user()->reservations;
        $facilities = Facility::where('facility_status', '=', 'Open')->get();
        // dd($facilities);
        return view('resident-facing.dashboard', compact('resident', 'reservations', 'facilities'));
    }

    public function facility()
    {
        $facilities = Facility::all();
        return view('resident-facing.facility', compact('facilities'));
    }

    public function reservations()
    {
        $reservations = Auth::user()->reservations;
        // dump(Auth::user()->id);
        // dump($reservations);
        return view('resident-facing.reservations', compact('reservations'));
    }

    public function create_reservation(Request $request)
    {
        if ($request->query('new')) {
            session()->forget('reservation.step1');
        }

        $facilities = Facility::all();
        $step1 = session('reservation.step1');
        return view('resident-facing.reservation', compact('facilities', 'step1'));
    }

    // POST resident/billing — validates step 1, stores in session, redirects to GET billing
    public function functionA(Request $request)
    {
        $facility = Facility::findOrFail($request->facility_id);

        $validated = $request->validate([
            'facility_id'  => 'required|exists:facilities,id',
            'event_type'   => 'required|string',
            'date'         => 'required|date|after_or_equal:today',
            'guest_count'  => 'required|integer|min:1',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'notes'        => 'nullable|string',
        ]);

        $opening = Carbon::parse($facility->starting_hours);
        $closing = Carbon::parse($facility->closing_hours);
        $start   = Carbon::parse($request->start_time);
        $end     = Carbon::parse($request->end_time);
        $durationMinutes = $start->diffInMinutes($end);

        if ($start->lt($opening) || $end->gt($closing)) {
            return back()->withErrors([
                'start_time' => 'Reservation must be within facility operating hours.'
            ])->withInput();
        }

        if ($durationMinutes > ($facility->max_reservation_duration * 60)) {
            return back()->withErrors([
                'end_time' => "Maximum reservation duration is {$facility->max_reservation_duration} hour(s)."
            ])->withInput();
        }

        if ($request->guest_count > $facility->max_capacity) {
            return back()->withErrors([
                'guest_count' => "Maximum capacity is {$facility->max_capacity} guests."
            ])->withInput();
        }

        $conflict = Reservation::where('facility_id', $facility->id)
            ->where('date', $request->date)
            ->where(function ($q) use ($request) {
                $q->where('start_time', '<', $request->end_time)
                  ->where('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors([
                'start_time' => 'This facility is already reserved during the selected time.'
            ])->withInput();
        }

        session(['reservation.step1' => $validated]);

        return redirect()->route('resident.billing');
    }

    // GET resident/billing — shows review/billing page using step 1 session data
    public function showBilling()
    {
        $step1 = session('reservation.step1');

        if (!$step1) {
            return redirect()->route('resident.create-reservation')
                ->with('error', 'Please complete step 1 first.');
        }

        $facility = Facility::findOrFail($step1['facility_id']);

        $start = Carbon::parse($step1['start_time']);
        $end   = Carbon::parse($step1['end_time']);
        $durationHours = $start->diffInMinutes($end) / 60;

        $totalFee = $facility->base_fee * $durationHours;

        return view('resident-facing.billing', compact('step1', 'facility', 'totalFee'));
    }

    // POST resident/reservation/store — final submission
    public function store(Request $request)
    {
        $step1 = session('reservation.step1');

        if (!$step1) {
            return redirect()->route('resident.create-reservation')
                ->with('error', 'Please complete step 1 first.');
        }

        $facility = Facility::findOrFail($step1['facility_id']);

        $start = Carbon::parse($step1['start_time']);
        $end   = Carbon::parse($step1['end_time']);
        $durationHours = $start->diffInMinutes($end) / 60;
        $totalFee = $facility->base_fee * $durationHours;

        // TODO: add addon fees to $totalFee once addons are implemented

        Reservation::create([
            'facility_id'    => $step1['facility_id'],
            'event_type'     => $step1['event_type'],
            'date'           => $step1['date'],
            'guest_count'    => $step1['guest_count'],
            'start_time'     => $step1['start_time'],
            'end_time'       => $step1['end_time'],
            'notes'          => $step1['notes'] ?? null,
            'total_fee'      => $totalFee,
            'status'         => 'Pending',
            'reserved_by'    => Auth::id(),
            'facilitated_by' => null,
        ]);

        session()->forget('reservation.step1');

        return redirect()->route('resident.my-reservations')
            ->with('success', 'Reservation submitted successfully.');
    }

    public function show(Request $request, Reservation $reservation)
    {
        $reservations = Reservation::where('reserved_by', '=', $request->user()->id)->get();

        $this->authorize('view', $reservation);

        return view('resident-facing.show', compact('reservations', 'reservation'));
    }
}
