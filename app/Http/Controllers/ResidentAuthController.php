<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentAuthController extends Controller
{
    public function create()
    {
        return view('resident-facing.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        // Reject staff/admin accounts trying to use the resident login
        if (auth()->user()->role !== 'resident') {
            Auth::logout();
            return back()->withErrors(['email' => 'This login is for residents only.']);
        }

        $request->session()->regenerate();
        return redirect()->route('resident.dashboard');
    }

    public function showRegister()
    {
        return view('resident-facing.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'middle_name'=> 'nullable|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
            'block_num'  => 'required|integer',
            'lot_num'    => 'required|integer',
            'street_num' => 'required|integer',
        ]);

        $resident = Resident::create($validated); // role auto-set to 'resident' via your booted() hook

        Auth::login($resident);

        return redirect()->route('resident.dashboard');
    }
}
