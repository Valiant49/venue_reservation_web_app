<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentPortalController extends Controller
{
    public function dashboard()
    {
        $resident = Auth::user();
        return view('resident-facing.dashboard', compact('resident'));
    }
}
