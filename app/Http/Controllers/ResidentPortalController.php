<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentPortalController extends Controller
{
    public function dashboard()
    {
        $resident = Auth::user();
        return view('resident-facing.dashboard', compact('resident'));
    }

    public function reservation()
    {
        return view('resident-facing.reservations');
    }
}
