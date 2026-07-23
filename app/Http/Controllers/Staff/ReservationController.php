<?php

namespace App\Http\Controllers\Staff;

use App\Models\Resident;
use App\Models\Facility;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function dashboardData()
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SATURDAY)->format('Y-m-d');

        $reservations = Reservation::with(['facility', 'resident'])
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
        $facilities = Facility::all();

        $reservationsToday = Reservation::whereDate('date', Carbon::today())->get();

        $totalReservationsThisWeek = $reservations->count();
        $activeFacilitiesCount = Facility::count();
        $activeResidentsCount = Resident::count();
        $pendingReservations = Reservation::where('status', 'Pending')->count();

        // dump($reservations);
        return view('employee-facing.dashboard', compact(
            'reservations',
            'totalReservationsThisWeek',
            'activeFacilitiesCount',
            'activeResidentsCount',
            'pendingReservations',
            'facilities',
            'reservationsToday'
        ));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = User::all();
        $residents = Resident::all();
        $reservations = Reservation::with('facility', 'resident')->latest()->get();
        $facilities = Facility::all();
        return view('employee-facing.reservation.index', compact('reservations', 'facilities', 'residents', 'staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->request->remove('updated_at');

        $facility = Facility::findOrFail($request->facility_id);

        $hours = Carbon::parse($request->start_time)
            ->diffInHours(Carbon::parse($request->end_time));

        $opening = Carbon::parse($facility->starting_hours);
        $closing = Carbon::parse($facility->closing_hours);

        $start = Carbon::parse($request->start_time);
        $end = Carbon::parse($request->end_time);
        $durationMinutes = $start->diffInMinutes($end);
        $durationHours = $durationMinutes / 60;

        $totalFee = $facility->base_fee * $durationHours;

        $request->merge([
            'total_fee' => $totalFee
        ]);

        $validated = $request->validate([
            'facility_id'  => 'required|exists:facilities,id',
            'reserved_by'  => 'required|exists:users,id',

            'date'         => 'required|date|after_or_equal:today',

            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',

            'guest_count'  => 'required|integer|min:1',

            'status'       => ['required', Rule::in(['Pending','Confirmed','Cancelled'])],

            'event_type'   => 'required|string',

            'notes'        => 'nullable|string',

            'total_fee'    => 'required|numeric|min:0',
        ]);



        if ($start->lt($opening) || $end->gt($closing)) {
            return back()
                ->withErrors([
                    'start_time' => 'Reservation must be within facility operating hours.'
                ])
                ->withInput();
        }

        if ($durationMinutes > ($facility->max_reservation_duration * 60)) {
            return back()
                ->withErrors([
                    'end_time' => "Maximum reservation duration is {$facility->max_reservation_duration} hour(s)."
                ])
                ->withInput();
        }

        if ($request->guest_count > $facility->max_capacity) {
            return back()
                ->withErrors([
                    'guest_count' => "Maximum capacity is {$facility->max_capacity} guests."
                ])
                ->withInput();
        }

        $conflict = Reservation::where('facility_id', $facility->id)
            ->where('date', $request->date)
            ->where(function ($q) use ($request) {
                $q->where('start_time', '<', $request->end_time)
                ->where('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($conflict) {
            return back()
                ->withErrors([
                    'start_time' => 'This facility is already reserved during the selected time.'
                ])
                ->withInput();
        }

        // dd($request);

        Reservation::create($validated);

        return redirect(route('reservation.index'))->with('success', 'Reservation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $reservations = Reservation::all();
        return view('employee-facing.reservation.delete', compact('reservations', 'reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $staffs = User::whereIn('role', ['admin', 'staff'])->get();
        $residents = Resident::all();
        $facilities = Facility::all();
        return view('employee-facing.reservation.edit', compact('reservation', 'facilities', 'staffs', 'residents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        if ($request->filled('start_time') && $request->filled('end_time')) {
            $start = strtotime($request->start_time);
            $end   = strtotime($request->end_time);

            if ($start !== false && $end !== false) {
                $request->merge([
                    'start_time' => date('H:i', $start),
                    'end_time'   => date('H:i', $end),
                ]);
            }
        }

        $validated = $request->validate([
            'facility_id'   => 'required|exists:facilities,id',
            'reserved_by'   => 'required|exists:users,id',
            'facilitated_by'=> 'required|exists:users,id',

            'date' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) use ($reservation) {
                    if ($value !== $reservation->date) {
                        if ($value < now()->format('Y-m-d')) {
                            $fail('The reservation date cannot be set to a past date.');
                        }
                    }
                }
            ],
            'start_time'       => 'required|date_format:H:i',
            'end_time'         => [
                'required',
                'date_format:H:i',
                'after:start_time',

                function ($attribute, $value, $fail) use ($request, $reservation) {
                    $requestedStart = $request->start_time;
                    $requestedEnd = $value;

                    $conflictExists = Reservation::where('id', $request->id)
                        ->where('date', $request->date)
                        ->where('facility_id', '!=', $reservation->id)
                        ->where(function($query) use ($requestedStart, $requestedEnd){
                            $query->where(function($q) use ($requestedStart, $requestedEnd){
                                //case 1
                                $q->where('start_time', '>=', $requestedStart)
                                ->where('start_time', '<', $requestedEnd);
                            })
                            ->orWhere(function($q) use ($requestedStart, $requestedEnd){
                                //case 2
                                $q->where('end_time', '>', $requestedStart)
                                ->where('end_time', '<=', $requestedEnd);
                            })
                            ->orWhere(function($q) use ($requestedStart, $requestedEnd){
                                //case 3
                                $q->where('start_time', '<=', $requestedStart)
                                ->where('end_time', '>=', $requestedEnd);
                            });
                        })
                    ->exists();

                    if ($conflictExists) {
                        $fail("The selected facility is already booked for this time block.");
                    }
                }
            ],

            'total_fee'        => 'required|numeric|min:0|max:999999.99',
            'guest_count'   => [
                'required',
                'integer',
                'min:1',
                function($attribute, $value, $fail) use ($request) {
                    $facility = Facility::find($request->facility_id);
                    if ($facility && $value > $facility->max_capacity) {
                        $fail("The selected facility only accomodates up to {$facility->max_capacity} guests.");
                    }
                }
            ],
            'status'        => ['required', Rule::in(['Pending','Confirmed','Cancelled'])],
            'event_type'    => 'required|string',
            'notes'         => 'nullable|string'
        ]);

        $reservation->update($validated);

        return redirect(route('reservation.index'))->with('success', 'Reservation updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect(route('reservation.index'))->with('success', 'Reservation removed.');
    }
}
