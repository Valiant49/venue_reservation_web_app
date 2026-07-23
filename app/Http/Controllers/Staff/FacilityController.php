<?php

namespace App\Http\Controllers\Staff;

use App\Models\Facility;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::all();
        return view('employee-facing.facility.index', compact('facilities'));
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
            'name'                          => 'required|string|max:255',
            'category'                      => 'required|string|in:hall,pool,court,clubhouse',
            'description'                   => 'required|string',
            'reservation_type'              => 'required|string|in:hourly,block',
            'facility_status'               => 'required|string|in:Open,Closed,Under Maintenance',
            'base_fee'                      => 'required|numeric|min:0',
            'starting_hours'                => 'required|date_format:H:i',
            'closing_hours'                 => 'required|date_format:H:i|after:starting_hours',
            'max_capacity'                  => 'required|integer:min:1',
            'max_reservation_duration'      => 'required|integer:min:1',
        ]);

        Facility::create($validated);

        return redirect(route('facility.index'))->with('success', 'Facility added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        $facilities = Facility::all();
        return view('employee-facing.facility.delete', compact('facilities', 'facility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        $facilities = Facility::all();
        return view('employee-facing.facility.edit', compact('facilities', 'facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name'                          => 'required|string|max:255',
            'category'                      => 'required|string|in:hall,pool,court,clubhouse',
            'description'                   => 'required|string',
            'reservation_type'              => 'required|string|in:hourly,block',
            'facility_status'               => 'required|string|in:Open,Closed,Under Maintenance',
            'base_fee'                      => 'required|numeric|min:0',
            'starting_hours'                => 'required|date_format:H:i',
            'closing_hours'                 => 'required|date_format:H:i|after:starting_hours',
            'max_capacity'                  => 'required|integer:min:1',
            'max_reservation_duration'      => 'required|integer:min:1',
         ]);

        $facility->update($validated);
        return redirect(route('facility.index'))->with('success', 'Facility updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();
        return redirect(route('facility.index'))->with('success', 'Facility removed.');
    }
}
