<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

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
            'facility_code'     => 'required|string|max:10',
            'facility_name'     => 'required|string|max:255',
            'facility_type'     => 'required|in:clubhouse,pool,basketball,volleyball,badminton',
            'base_fee'          => 'required|numeric|min:1',
            'capacity'          => 'required|integer|min:1',
            'description'       => 'required|string|max:255'
        ]);

        Facility::create($validated);

        return redirect('/facility')->with('success', 'Facility added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        $facilities = Facility::all();
        return view('facility.delete', compact('facilities', 'facility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        $facilities = Facility::all();
        return view('facility.edit', compact('facilities', 'facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
        'facility_code'     => 'required|string|max:10',
        'facility_name'     => 'required|string|max:255',
        'facility_type'     => 'required|in:clubhouse,pool,basketball,volleyball,badminton',
        'base_fee'          => 'required|numeric|min:1',
        'capacity'          => 'required|integer|min:1',
        'description'       => 'required|string|max:255'
         ]);

        $facility->update($validated);
        return redirect('/facility')->with('success', 'Facility updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();
        return redirect('/facility')->with('success', 'Facility removed.');
    }
}
