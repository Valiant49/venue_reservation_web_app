<?php

namespace App\Http\Controllers\Resident;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class ResidentPortalController extends Controller
{
    public function dashboard()
    {
        $resident = Auth::user();
        return view('resident-facing.dashboard', compact('resident'));
    }

    public function reservations()
    {
        return view('resident-facing.reservations');
    }
}
