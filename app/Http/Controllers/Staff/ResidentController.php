<?php

namespace App\Http\Controllers\Staff;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residents = User::where('role', '=', 'resident')->get();
        return view('employee-facing.residents.index', compact('residents'));
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
            'block_num'     => 'required|integer|max:39',
            'lot_num'       => 'required|integer|max:300',
            'street_num'    => 'required|integer|max:100',
            'first_name'    => 'required|string',
            'middle_name'   => 'nullable|string',
            'last_name'     => 'required|string',
            'password'      => 'required|string|min:8',
            'contact_num'   => 'required|string',
            'email'         => 'required|email:filter'
        ]);

        // dd($validated);

        Resident::create($validated);

        return redirect(route('residents.index'))->with('success', 'Resident record added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resident $resident)
    {
        $residents = Resident::all();
        return view('employee-facing.residents.delete', compact('residents', 'resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resident $resident)
    {
        $residents = Resident::all();
        return view('employee-facing.residents.edit', compact('residents', 'resident'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resident $resident)
    {
        $validated = $request->validate([
            'block_num'     => 'required|integer|max:39',
            'lot_num'       => 'required|integer|max:300',
            'street_num'    => 'required|integer|max:100',
            'first_name'    => 'required|string',
            'middle_name'   => 'nullable|string',
            'last_name'     => 'required|string',
            'contact_num'   => 'required|string',
            'email'         => 'nullable|email',
            'password'      => 'nullable|string|min:8',
        ]);

        // dd($validated);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $resident->update($validated);

        return redirect(route('residents.index'))->with('success', 'Resident record updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resident $resident)
    {
        $resident->delete();
        return redirect(route('residents.index'))->with('success', 'Resident record removed.');
    }
}
