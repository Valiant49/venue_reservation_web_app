<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Reservations') }}
        </h2>
    </x-slot>

    <div class="px-4 py-6">
        @if (session('success'))
            <div class="mb-4 rounded-md border border-green-200 bg-green-100 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-md border border-red-200 bg-red-100 p-4 text-sm text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4 flex items-center justify-end">
            <button onclick="document.getElementById('add-modal').showModal()"
                class="shadow-xs bg-surface text-md text-text hover:bg-secondary-hover hover:text-white focus-visible:outline-secondary-subtle cursor-pointer rounded-md px-4 py-2 font-semibold focus-visible:outline-2 focus-visible:outline-offset-2">
                Add Reservation
            </button>
        </div>

        <div
            class="bg-surface-alt shadow-xs border-border-strong max-h-180 relative overflow-x-auto overflow-y-auto rounded-md border">
            <table class="text-body w-full text-left text-sm">
                <thead
                    class="text-body bg-surface border-default-medium text-text sticky top-0 z-10 border-b text-sm">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">Facility Name</th>
                        <th scope="col" class="px-6 py-3 font-medium">Resident Name</th>
                        <th scope="col" class="px-6 py-3 font-medium">Date</th>
                        <th scope="col" class="px-6 py-3 font-medium">Time</th>
                        <th scope="col" class="px-6 py-3 font-medium">Fee</th>
                        <th scope="col" class="px-6 py-3 font-medium">Status</th>
                        <th scope="col" class="px-6 py-3 font-medium">Event Type</th>
                        <th scope="col" class="px-6 py-3 font-medium">Notes</th>
                        <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                @foreach ($reservations as $reservation)
                    <tr class="bg-background border-default hover:bg-gray-300 border-b">
                        <td class="px-6 py-4"> {{ $reservation->facility->name ?? 'N/A' }} </td>
                        <td class="px-6 py-4">
                            {{ $reservation->resident->last_name }},
                            {{ $reservation->resident->first_name }}
                            {{ Str::limit($reservation->resident->middle_name, 1, '.') }}
                        </td>
                        <td class="px-6 py-4"> {{ $reservation->date }} </td>
                        <td class="px-6 py-4"> {{ $reservation->start_time }} to {{ $reservation->end_time }} </td>
                        <td class="px-6 py-4"> {{ $reservation->total_fee }} </td>
                        <td class="px-6 py-4"> {{ $reservation->status }} </td>
                        <td class="px-6 py-4"> {{ $reservation->event_type }} </td>
                        <td class="px-6 py-4"> {{ $reservation->notes }} </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('reservation.edit', $reservation) }}"
                                class="text-info font-medium hover:underline">Edit</a>
                            @can('admin-access')
                                <a href="{{ route('reservation.destroy', $reservation) }}"
                                    class="text-error font-medium hover:underline">Remove</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        <dialog id="add-modal"
            class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

            <!-- Modal Header -->
            <div class="mb-5 flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-xl font-semibold text-gray-900">Add Reservation</h3>
                <button type="button" onclick="document.getElementById('add-modal').close()"
                    class="cursor-pointer rounded-md p-1.5 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body & Form -->
            <div>
                <form action="{{ route('reservation.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Grid container for a clean 2-column desktop layout -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <!-- Facility Field -->
                        <div>
                            <label for="facility" class="mb-1 block text-sm font-medium text-gray-700">Facility</label>
                            <select name="facility_id" id="facility"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                <option value="" disabled {{ old('facility_type') === null ? 'selected' : '' }}>
                                    Please select...</option>
                                @foreach ($facilities as $facility)
                                    <option value="{{ $facility->id }}"
                                        {{ old('facility_type') == $facility->id ? 'selected' : '' }}>
                                        {{ $facility->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Resident Name Field -->
                        <div>
                            <label for="resident" class="mb-1 block text-sm font-medium text-gray-700">Resident
                                Name</label>
                            <select name="reserved_by" id="resident"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                <option value="" disabled {{ old('reserved_by') ? '' : 'selected' }}>Select a
                                    resident...</option>
                                @foreach ($residents as $resident)
                                    <option value="{{ $resident->id }}"
                                        {{ old('reserved_by') == $resident->id ? 'selected' : '' }}>
                                        {{ $resident->last_name }}, {{ $resident->first_name }}
                                        {{ Str::limit($resident->middle_name, 1, '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('reserved_by')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Guest Count Field -->
                        <div>
                            <label for="guest-count" class="mb-1 block text-sm font-medium text-gray-700">Guest
                                Count</label>
                            <input type="number" name="guest_count" id="guest-count" min="1"
                                value="{{ old('guest_count') }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @error('guest_count')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Reservation Date Field -->
                        <div>
                            <label for="date" class="mb-1 block text-sm font-medium text-gray-700">Reservation
                                Date</label>
                            <input type="date" name="date" id="date"
                                value="{{ old('date') }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @error('date')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Start Time Field -->
                        <div>
                            <label for="start-time" class="mb-1 block text-sm font-medium text-gray-700">Start
                                Time</label>
                            <input type="time" name="start_time" id="start-time" value="{{ old('start_time') }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @error('start_time')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Time Field -->
                        <div>
                            <label for="end-time" class="mb-1 block text-sm font-medium text-gray-700">End
                                Time</label>
                            <input type="time" name="end_time" id="end-time" value="{{ old('end_time') }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @error('end_time')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Field -->
                        <div>
                            <label for="status" class="mb-1 block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                <option value="Pending" {{ old('status', 'Pending') == 'Pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="Confirmed" {{ old('status') == 'Confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fee Field -->
                        <div>
                            <label for="fee" class="mb-1 block text-sm font-medium text-gray-700">Fee</label>
                            <input type="text" name="total_fee" id="fee" value="{{ old('total_fee') }}"
                                placeholder="0.00"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @error('total_fee')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Event Type Field -->
                        <div>
                            <label for="event-type" class="mb-1 block text-sm font-medium text-gray-700">Event
                                Type</label>
                            <input type="text" name="event_type" id="event-type" value="{{ old('event_type') }}"
                                placeholder="e.g. Seminar"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @error('event_type')
                                <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Notes Field (Spans full width) -->
                    <div>
                        <label for="notes" class="mb-1 block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes" id="notes" rows="2" placeholder="Provide additional reservation details..."
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Modal Action Buttons Footer -->
                    <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
                        <x-secondary-button type="button" onclick="document.getElementById('add-modal').close()"
                            class="shadow-xs cursor-pointer rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Cancel
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            Submit
                        </x-primary-button>
                    </div>
            </div>
</x-app-layout>
