<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = User::all();
        return view('employee-facing.staff.index', compact('staffs'));
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
            'name'          => 'required|string',
            'password'      => 'required|string|min:8',
            'email'         => 'required|email:filter',
            'role'          => 'required|in:admin,staff'
        ]);

        user::create($validated);
        return redirect('/staff')->with('success', 'Staff added successfuly.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $staff)
    {
        $staffs = User::all();
        return view('staff.delete', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $staff)
    {
        $staffs = User::all();
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $staff)
    {
        $validated = $request->validate([
            'name'          => 'required|string',
            'email'         => 'required|email',
            'role'          => 'required'
        ]);

        $staff->update($validated);
        return redirect('/staff')->with('success', 'Staff record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect('/staff')->with('success', 'Staff record removed.');
    }
}
