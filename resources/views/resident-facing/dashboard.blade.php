{{-- @extends('layouts.resident') --}}

{{-- @section('content') --}}
<x-resident-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                Dashboard
            </h2>
        </x-slot>

    <div class="bg-background py-4 px-2 mt-3 mb-3 rounded-md">
        <div class="text-2xl">Good day, {{ Auth::user()->first_name }}.</div>
        <div>{{ Str::title(Auth::user()->account_status) }} {{ Str::title(Auth::user()->role) }}</div>
    </div>

    <div class="bg-background py-4 px-2 mt-3 mb-3 rounded-md">
        <h3>My Reservations</h3>
        <div>
            @foreach ($reservations as $reservation)
                <div>
                    <div>{{ $reservation->facility->name }}</div>
                    <div>{{ Str::title($reservation->code) }}</div>

                </div>
            @endforeach
        </div>
    </div>
</x-resident-layout>

{{-- @endsection --}}
