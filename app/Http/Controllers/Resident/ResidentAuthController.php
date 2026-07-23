<?php

namespace App\Http\Controllers\Resident;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Resident;

use App\Http\Controllers\Controller;

class ResidentAuthController extends Controller
{
    public function showLogin()
    {
        return view('resident-facing.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        // dd(auth()->user()->role, auth()->user()->email);

        // // Reject staff/admin accounts trying to use the resident login
        // if (auth()->user()->role !== 'resident') {
        //     Auth::logout();
        //     return back()->withErrors(['email' => 'This login is for residents only.']);
        // }

        $user = auth()->user();
        if ($user->role !== 'resident') {
            Auth::logout();
            return back()->withErrors(['email' => 'This login is for residents only.']);
        }

        // dd($request);

        $request->session()->regenerate();
        return redirect()->intended(route('resident.dashboard'));
    }

    public function showRegister()
    {
        return view('resident-facing.register');
    }

    public function register(Request $request)
    {
        // $phoneNum = $request['contact_num'];
        // $cleanPhoneNum = str($phoneNum)->replace(' ', '')->toString();

        $cleanPhoneNum = Str::replace(' ', '', $request->input('contact_num'));

        $request->merge(['contact_num' => $cleanPhoneNum]);

        // dd($request);

        $validated = $request->validate([
            'first_name' => 'required|string',
            'middle_name'=> 'nullable|string',
            'last_name'  => 'required|string',
            'contact_num'=> 'required|string|size:11',
            'block_num'  => 'required|integer',
            'lot_num'    => 'required|integer',
            'street_num' => 'required|integer',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
        ]);


        $resident = Resident::create($validated); // role auto-set to 'resident' via your booted() hook

        Auth::login($resident);

        return redirect()->route('resident.dashboard');
    }


}
