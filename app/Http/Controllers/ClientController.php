<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('employee-facing.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'block_num' => 'required|integer|max:39',
            'lot_num'   => 'required|integer|max:300',
            'street_num' => 'required|integer|max:100',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'contact_num' => 'required|string',
            'email' => 'nullable|email:filter'
        ]);

        Client::create($validated);

        return redirect('/client')->with('success', 'Client record added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $clients = Client::all();
        return view('clients.delete', compact('clients', 'client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $clients = Client::all();
        return view('/clients.edit', compact('clients', 'client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'block_num' => 'required|integer|max:39',
            'lot_num'   => 'required|integer|max:300',
            'street_num' => 'required|integer|max:100',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'contact_num' => 'required|string',
            'email' => 'nullable|email'
        ]);

        $client->update($validated);

        return redirect('/client')->with('success', 'Client record updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect('/client')->with('success', 'Client record removed.');
    }
}
