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

    public function show(AddOn $add_on)
    {
        $add_ons = AddOn::all();
        return view('employee-facing.add-ons.delete', compact('add_ons', "add_on"));
    }

    public function edit(AddOn $add_on)
    {
        $add_ons = AddOn::all();
        return view('employee-facing.add-ons.edit', compact('add_ons', 'add_on'));
    }

    public function update(Request $request, AddOn $add_on)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'description'=> 'required|string|max:255',
            'price'     => 'required|numeric|min:0',
            'is_active'=> 'required|string|in:Active,Inactive'
        ]);

        $add_on->update($validated);

        return redirect(route('add-ons.index'))->with('success', 'Add-on record updated.');
    }

    public function destroy(AddOn $add_on)
    {
        $facility->delete();
        return redirect(route('add-ons.index'))->with('success', 'Add-on removed.');
    }
}
