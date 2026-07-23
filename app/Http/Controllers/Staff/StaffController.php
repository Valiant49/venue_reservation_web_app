<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    public function index()
    {
        $employees = User::whereIn('role', ['staff', 'admin'])->get();
        return view('employee-facing.staff.index', compact('employees'));
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
        return redirect(route('employees.index'))->with('success', 'Staff added successfuly.');
    }

    public function show(User $employee)
    {
        $staffs = User::whereIn('role', ['staff', 'admin'])->get();
        return view('employee-facing.staff.delete', compact('staffs', 'employee'));
    }

    public function edit(User $employee)
    {
        $staffs = User::whereIn('role', ['staff', 'admin'])->get();
        return view('employee-facing.staff.edit', compact('staffs', 'employee'));
    }

    public function update(Request $request, User $employee)
    {
        $validated = $request->validate([
            'first_name'  => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name'   => 'required|string',
            'email'       => 'required|email',
            'password'      => 'required|string|min:8',
            'role'        => 'required|in:admin,staff',
        ]);

        $employee->update($validated);

        return redirect(route('employees.index'))->with('success', 'Staff record updated.');
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect(route('employees.index'))->with('success', 'Staff record removed.');
    }
}
