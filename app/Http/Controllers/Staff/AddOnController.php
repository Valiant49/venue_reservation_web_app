<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;

use App\Models\AddOn;
use App\Models\Facility;

use App\Http\Controllers\Controller;

class AddOnController extends Controller
{
    public function index()
    {
        $add_ons = AddOn::all();
        // dump($add_ons);
        return view('employee-facing.add-ons.index', compact('add_ons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'description'=> 'required|string|max:255',
            'price'     => 'required|numeric|min:0',
            'is_active'=> 'required|string|in:Active,Inactive'
        ]);

        AddOn::create($validated);

        return redirect(route('add-ons.index'))->with('success', 'Add-on created successfully.');
    }
}
