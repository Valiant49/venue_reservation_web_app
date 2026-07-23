<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = User::whereIn('role', ['staff', 'admin'])->get();
        return view('employee-facing.staff.index', compact('staffs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => 'required|string',
            'middle_name'   => 'nullable|string',
            'last_name'     => 'required|string',
            'password'      => 'required|string|min:8',
            'email'         => 'required|email:filter',
            'role'          => 'required|in:admin,staff'
        ]);

        User::create($validated);
        return redirect('/staff')->with('success', 'Staff added successfuly.');
    }

    public function show(Staff $staff)
    {
        $staffs = Staff::all();
        return view('employee-facing.staff.delete', compact('staffs', 'staff'));
    }

    public function edit(Staff $staff)
    {
        $staffs = Staff::all();
        return view('employee-facing.staff.edit', compact('staffs', 'staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'first_name'  => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name'   => 'required|string',
            'email'       => 'required|email',
            'role'        => 'required|in:admin,staff',
        ]);

        $staff->update($validated);

        return redirect('/staff')->with('success', 'Staff record updated.');
    }

        public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect('/staff')->with('success', 'Staff record removed.');
    }
}
