<x-app-layout>
@isset($reservation)
    <div class="flex min-h-[calc(100vh-4rem)] items-center justify-center p-6">
        <div id="edit-modal"
            class="w-full max-w-4xl rounded-xl bg-white p-6 shadow-2xl">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                <h3 class="text-xl font-semibold text-gray-900">Edit Reservation Details</h3>
                <a href="{{ route('reservation.index') }}"
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
            <form action="{{ route('reservation.update', $reservation) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="flex">
                    <div class="flex-1">
                        {{-- Row 1: Facility + Resident --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="facility" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Facility</label>
                                <select name="facility_id" id="facility"
                                    class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary bg-white">
                                    <option value="" disabled>Please select...</option>
                                    @foreach($facilities as $facility)
                                        <option value="{{ $facility->id }}" {{ $reservation->facility_id == $facility->id ? 'selected' : '' }}
                                            data-fee="{{ $facility->base_fee }}"
                                            data-type="{{ $facility->reservation_type }}"
                                            data-capacity="{{ $facility->max_capacity }}"
                                            data-starting-hours="{{ $facility->starting_hours }}"
                                            data-closing-hours="{{ $facility->closing_hours }}"
                                            data-max-duration="{{ $facility->max_reservation_duration }}">
                                            {{ $facility->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="client" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Resident Name</label>
                                <select name="reserved_by" id="client"
                                    class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary bg-white">
                                    <option value="" disabled>Select a resident...</option>
                                    @foreach($residents as $resident)
                                        <option value="{{ $resident->id }}" {{ $reservation->reserved_by == $resident->id ? 'selected' : '' }}>
                                            {{ $resident->last_name }}, {{ $resident->first_name }} {{ Str::limit($resident->middle_name, 1, '.') }}
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
                                <label for="guest-count" class="block text-sm font-medium text-gray-700 mb-1">Guest Count</label>
                                <input type="number" name="guest_count" id="guest-count" min="1" value="{{ old('guest_count', $reservation->guest_count) }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                                <p id="guest-warning" class="mt-1 text-xs font-medium text-red-600">
                                    @error('guest_count')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Reservation Date</label>
                                <input type="date" name="date" id="date" value="{{ old('reservation_date', $reservation->date->format('Y-m-d')) }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                                <p id="date-warning" class="mt-1 text-xs font-medium text-red-600">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>
                        {{-- Row 3: Start Time + End Time --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="start-time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                                <input type="time" name="start_time" id="start-time" value="{{ old('start_time', $reservation->start_time->format('H:i')) }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                                <p id="time-warning" class="mt-1 text-xs font-medium text-red-600">
                                    @error('start_time')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div>
                                <label for="end-time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                                <input type="time" name="end_time" id="end-time" value="{{ old('end_time', $reservation->end_time->format('H:i')) }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
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
                                    class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary bg-white">
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
                                    class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary bg-white">
                                    @foreach($staffs as $staff)
                                        <option value="{{ $staff->id }}" {{ old('facilitated_by', $reservation->facilitated_by) == $staff->id ? 'selected' : '' }}>
                                            {{ $staff->last_name }}, {{ $staff->first_name }} {{ Str::limit($staff->middle_name, 1, '.') }}
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
                            {{-- <div>
                                <label for="fee" class="block text-sm font-medium text-gray-700 mb-1">Total Fee</label>
                                <input type="text" name="total_fee" id="fee" value="{{ old('total_fee', $reservation->total_fee) }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                                @error('total_fee')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            <input type="hidden" name="total_fee" id="total-fee">
                            <div>
                                <label for="duration" class="mb-1 block text-sm font-medium text-gray-700">Duration</label>
                                <input type="text" id="duration" placeholder="e.g. 1 hr" disabled
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-secondary focus:outline-none focus:ring-1 ">
                            </div>
                            <div>
                                <label for="fee" class="mb-1 block text-sm font-medium text-gray-700">Total Fee</label>
                                <input type="text" id="estimated-fee" value="{{ old('total_fee', $reservation->total_fee) }}"
                                    placeholder="₱0.00" disabled
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-secondary focus:outline-none focus:ring-1 ">
                                @error('total_fee')
                                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="event-type" class="block text-sm font-medium text-gray-700 mb-1">Event Type</label>
                                <input type="text" name="event_type" id="event-type" value="{{ old('event_type', $reservation->event_type) }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                                @error('event_type')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- Notes (full width) --}}
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <textarea name="notes" id="notes" rows="3"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">{{ old('notes', $reservation->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div id="addons-container" class="pl-4 flex-1">
                        <x-input-label>Add-ons for this Facility</x-input-label>
                        <div class="max-h-60 overflow-y-auto pr-1">
                            @foreach ($facilities as $fac)
                                @foreach ($fac->addOns as $addOn)
                                    <label class="addon-option flex items-center gap-2 px-4 py-3 m-2 bg-background rounded hidden"
                                        data-facility-id="{{ $fac->id }}">
                                        <input type="checkbox" name="add_ons[]" value="{{ $addOn->id }}"
                                            @checked($reservation->addOns->contains($addOn->id))>
                                        <div class="flex flex-1 justify-between items-center">
                                            <span class="text-black/80 font-medium">{{ $addOn->name }}</span>
                                            <span class="text-black/80">(₱{{ number_format($addOn->price, 2) }})</span>
                                        </div>
                                    </label>
                                @endforeach
                            @endforeach
                        </div>
                        <p id="no-addons-msg" class="text-sm text-gray-400 hidden">No add-ons available for this facility.</p>
                    </div>
                </div>
                {{-- Footer Buttons --}}
                <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-4 mt-6">
                    <x-secondary-button onclick="window.location.href='{{ route('reservation.index') }}'"
                        class="cursor-pointer rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button type="submit" id="form-submit"
                        class="cursor-pointer rounded-lg px-4 py-2 bg-secondary hover:bg-secondary-hover text-sm font-medium text-text shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                        Update Reservation
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endisset
</x-app-layout>
