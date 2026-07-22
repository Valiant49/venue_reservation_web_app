<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Facility;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

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
        $validated = $request->validate([
            'facility_id'   => 'required|exists:facility,id',
            'reserved_by'   => 'required|exists:users,id',

            'date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'start_time'       => 'required|date_format:H:i',
            'end_time'         => [
                'required',
                'date_format:H:i',
                'after:start_time',

                function ($attribute, $value, $fail) use ($request) {
                    $requestedStart = $request->start_time;
                    $requestedEnd = $value;

                    $conflictExists = Reservation::where('facility_id', $request->facility_id)
                        ->where('date', $request->date)
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
                        $fail("The selected faciality is already booked for this time block.");
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
                    if ($facility && $value > $facility->capacity) {
                        $fail("The selected facility only accomodates up to {$facility->capacity} guests.");
                    }
                }
            ],
            'status'        => ['required', Rule::in(['Pending','Confirmed','Cancelled'])],
            'event_type'    => 'required|string',
            'notes'         => 'nullable|string'
        ]);

        Reservation::create($validated);

        return redirect('/reservation')->with('success', 'Reservation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $reservations = Reservation::all();
        return view('reservation.delete', compact('reservations', 'reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $staffs = User::all();
        $residents = Resident::all();
        $facilities = Facility::all();
        return view('reservation.edit', compact('reservation', 'facilities', 'staffs', 'residents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        // if ($request->has('start_time')) {
        //     $request->merge([
        //         'start_time'    => date('H:i', strtotime($request->start_time)),
        //         'end_time'      => date('H:i', strtotime($request->end_time)),
        //     ]);
        // }

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
            'facility_id'   => 'required|exists:facility,id',
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

                    $conflictExists = Reservation::where('facility_id', $request->facility_id)
                        ->where('date', $request->date)
                        ->where('id', '!=', $reservation->id)
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
                    if ($facility && $value > $facility->capacity) {
                        $fail("The selected facility only accomodates up to {$facility->capacity} guests.");
                    }
                }
            ],
            'status'        => ['required', Rule::in(['Pending','Confirmed','Cancelled'])],
            'event_type'    => 'required|string',
            'notes'         => 'nullable|string'
        ]);

        $reservation->update($validated);

        return redirect('/reservation')->with('success', 'Reservation updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect('/reservation')->with('success', 'Reservation removed.');
    }
}
