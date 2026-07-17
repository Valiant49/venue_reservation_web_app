<x-app-layout>
@isset($reservation)
    <dialog id="edit-modal" open
        class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-2xl rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

        {{-- Modal Header --}}
        <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Edit Reservation Details</h3>
            <a href="/reservation"
                class="cursor-pointer rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-500 transition-colors">
                <span class="sr-only">Close</span>
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        {{-- Error Alert --}}
        @if($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 p-4 border border-red-100">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form --}}
        <form action="/reservation/{{ $reservation->id }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Row 1: Facility + Resident --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="facility" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Facility</label>
                    <select name="facility_id" id="facility"
                        class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                        <option value="" disabled>Please select...</option>
                        @foreach($facilities as $facility)
                            <option value="{{ $facility->id }}" {{ $reservation->facility_id == $facility->id ? 'selected' : '' }}>
                                {{ $facility->facility_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="client" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Resident Name</label>
                    <select name="reserved_by" id="client"
                        class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                        <option value="" disabled>Select a client...</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $reservation->reserved_by == $client->id ? 'selected' : '' }}>
                                {{ $client->last_name }}, {{ $client->first_name }} {{ Str::limit($client->middle_name, 1, '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('reserved_by')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Row 2: Date + Guest Count --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Reservation Date</label>
                    <input type="date" name="reservation_date" id="date" value="{{ old('reservation_date', $reservation->reservation_date) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('reservation_date')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="guest-count" class="block text-sm font-medium text-gray-700 mb-1">Guest Count</label>
                    <input type="number" name="guest_count" id="guest-count" min="1" value="{{ old('guest_count', $reservation->guest_count) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('guest_count')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Row 3: Start Time + End Time --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="start-time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                    <input type="time" name="start_time" id="start-time" value="{{ old('start_time', $reservation->start_time) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('start_time')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="end-time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                    <input type="time" name="end_time" id="end-time" value="{{ old('end_time', $reservation->end_time) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('end_time')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Row 4: Status + Facilitated By --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                        <option value="Pending"   {{ old('status', $reservation->status) == 'Pending'   ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ old('status', $reservation->status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Cancelled" {{ old('status', $reservation->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="facilitated-by" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Facilitated By</label>
                    <select name="facilitated_by" id="facilitated-by"
                        class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}" {{ old('facilitated_by', $reservation->facilitated_by) == $staff->id ? 'selected' : '' }}>
                                {{ $staff->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('facilitated_by')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Row 5: Fee + Event Type --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="fee" class="block text-sm font-medium text-gray-700 mb-1">Total Fee</label>
                    <input type="text" name="total_fee" id="fee" value="{{ old('total_fee', $reservation->total_fee) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('total_fee')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="event-type" class="block text-sm font-medium text-gray-700 mb-1">Event Type</label>
                    <input type="text" name="event_type" id="event-type" value="{{ old('event_type', $reservation->event_type) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('event_type')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Notes (full width) --}}
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                <textarea name="notes" id="notes" rows="3"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">{{ old('notes', $reservation->notes) }}</textarea>
                @error('notes')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Footer Buttons --}}
            <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-4 mt-6">
                <x-secondary-button onclick="location.href='/reservation'"
                    class="cursor-pointer rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Cancel
                </x-secondary-button>
                <x-primary-button type="submit"
                    class="cursor-pointer rounded-lg px-4 py-2 bg-secondary hover:bg-secondary-hover text-sm font-medium text-text shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                    Update Reservation
                </x-primary-button>
            </div>
        </form>

    </dialog>
@endisset
</x-app-layout>
