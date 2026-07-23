<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Log;

use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::latest()->get();
        return view('employee-facing.logs.index', compact('logs'));
    }
}
