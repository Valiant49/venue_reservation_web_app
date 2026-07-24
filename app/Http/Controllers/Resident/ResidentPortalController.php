<?php

namespace App\Http\Controllers\Resident;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\Facility;
use App\Models\Reservation;

class ResidentPortalController extends Controller
{
    public function dashboard()
    {
        $resident = Auth::user();
        $reservations = Auth::user()->reservations;
        // dd($reservations);
        return view('resident-facing.dashboard', compact('resident', 'reservations'));
    }

    public function facility()
    {
        $facilityList = Facility::all();
        return view('resident-facing.facility', compact('facilityList'));
    }

    public function reservations()
    {
        return view('resident-facing.reservations');
    }
}
