<?php

namespace App\Http\Controllers\Staff;

use App\Models\Resident;
use App\Models\Facility;
use App\Models\Reservation;
use App\Models\User;
use App\Models\AddOn;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function dashboardData()
    {
        $reservationsTodayCount = Reservation::whereDate('date', Carbon::today())->count();

        $totalReservationsThisMonth = Reservation::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();
        $activeResidentsCount = Resident::count();
        $pendingReservationsCount = Reservation::where('status', 'Pending')->count();
        $pendingReservations = Reservation::where('status', 'Pending')
        ->take(2)
        ->get();

        $reservationsToday = Reservation::with(['facility', 'resident'])
        ->whereDate('date', Carbon::today())
        ->orderBy('start_time')
        ->take(2)
        ->get();

        $logs = Log::latest()->get();

        // dump($reservationsToday);

        return view('employee-facing.dashboard', compact(
            'activeResidentsCount',
            'pendingReservationsCount',
            'pendingReservations',
            'reservationsToday',
            'reservationsTodayCount',
            'totalReservationsThisMonth',
            'logs'
        ));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = User::all();
        $residents = Resident::all();
        $addOns = AddOn::where('is_active', '=', 'Active')->get();
        $reservations = Reservation::with('facility', 'resident')->where('status', '!=', 'Archived')->latest()->get();
        $facilities = Facility::with('addOns')->get();

        $tableData = $reservations->map(function ($r) {
            return [
                'id' => $r->id,
                'facility' => $r->facility->name ?? 'N/A',
                'resident' => $r->resident->last_name . ', ' . $r->resident->first_name . ' ' . Str::limit($r->resident->middle_name, 1, '.'),
                'date' => $r->date->format('Y-m-d'),
                'date_display' => $r->date->format('M j, Y'),
                'time_display' => $r->start_time->format('H:i A') . ' to ' . $r->end_time->format('H:i A'),
                'fee' => (float) $r->total_fee,
                'status' => $r->status,
                'event_type' => $r->event_type,
                'notes' => $r->notes,
            ];
        })->values();

        return view('employee-facing.reservation.index', compact('reservations', 'facilities', 'residents', 'staffs', 'addOns', 'tableData'));
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

        if ($request->filled('add_ons')) {

            $addOnTotal = AddOn::whereIn('id', $request->add_ons)
                ->sum('price');

            $totalFee += $addOnTotal;
        }

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
            'add_ons'                       => 'nullable|array',
            'add_ons.*'                     => 'exists:add_ons,id',
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

        $reservation = Reservation::create($validated);

        if ($request->add_ons) {
            $addOns = AddOn::whereIn('id', $request->add_ons)->get();
            $syncData = $addOns->mapWithKeys(fn ($addOn) => [
                $addOn->id => [
                    'quantity'   => 1,
                    'unit_price' => $addOn->price,
                    'subtotal'   => $addOn->price,
                ],
            ])->toArray();
            $reservation->addOns()->sync($syncData);
        }

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
        $addOns = AddOn::where('is_active', '=', 'Active')->get();
        $staffs = User::whereIn('role', ['admin', 'staff'])->get();
        $residents = Resident::all();
        $facilities = Facility::with('addOns')->get();
        return view('employee-facing.reservation.edit', compact('reservation', 'facilities', 'staffs', 'residents', 'addOns'));
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

                    $conflictExists = Reservation::where('id', '!=', $request->id)
                        ->where('date', $request->date)
                        ->where('facility_id', '!=', $request->facility_id)
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
            'notes'         => 'nullable|string',
            'add_ons'   => 'nullable|array',
            'add_ons.*' => 'exists:add_ons,id',
        ]);

        $reservation->update($validated);

        $addOns = AddOn::whereIn('id', $request->add_ons ?? [])->get();
        $syncData = $addOns->mapWithKeys(fn ($addOn) => [
            $addOn->id => [
                'quantity'   => 1,
                'unit_price' => $addOn->price,
                'subtotal'   => $addOn->price,
            ],
        ]);
        $reservation->addOns()->sync($syncData);

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

    public function remove(Reservation $reservation)
    {
        return view('employee-facing.reservation.archive', [
            'reservation' => $reservation,
        ]);
    }

    public function archive(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'Archived',
        ]);

        return redirect()
            ->route('reservation.index')
            ->with('success', 'Reservation archived successfully.');
    }
}
