<x-resident-layout>
    <div class="mx-auto mt-4 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Make a Reservation
            </h1>
            <p class="mt-2 text-gray-500">
                Complete the reservation details below.
            </p>
        </div>

        <div class="mb-10 flex items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="bg-primary flex h-9 w-9 items-center justify-center rounded-full text-sm font-bold text-white">
                    1
                </div>
                <span class="font-semibold text-gray-900">
                    Reservation Details
                </span>
            </div>

            <div class="h-px flex-1 bg-gray-200"></div>

            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-200 text-sm font-bold text-gray-500">
                    2
                </div>
                <span class="text-gray-400">
                    Review & Billing
                </span>
            </div>
        </div>

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

        <form action="{{ route('resident.billing.store') }}" method="POST" id="reservation-form">
            @csrf

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                <!-- Reservation Form -->
                <section class="rounded-2xl bg-white p-6 shadow-sm lg:col-span-2">
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900">
                            Reservation Details
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Select your preferred facility and reservation schedule.
                        </p>
                    </div>

                    <!-- Facility Selection -->
                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Select Facility
                        </label>
                        <select name="facility_id" id="facility"
                            class="focus:border-primary w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-gray-700 outline-none">
                            <option value="" disabled {{ old('facility_id') === null ? 'selected' : '' }}>
                                Please select...</option>
                            @foreach ($facilities as $facility)
                                <option value="{{ $facility->id }}"
                                    {{ old('facility_id', $step1['facility_id'] ?? null) == $facility->id ? 'selected' : '' }}
                                    data-fee="{{ $facility->base_fee }}"
                                    data-capacity="{{ $facility->max_capacity }}"
                                    data-starting-hours="{{ $facility->starting_hours }}"
                                    data-closing-hours="{{ $facility->closing_hours }}"
                                    data-max-duration="{{ $facility->max_reservation_duration }}">
                                    {{ $facility->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Event Type -->
                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Event Type
                        </label>
                        <input type="text" name="event_type" value="{{ old('event_type', $step1['event_type'] ?? null) }}" placeholder="e.g. Birthday, Meeting, Wedding"
                            class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                    </div>

                    <!-- Date and Guest Count -->
                    <div class="mb-6 grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Reservation Date
                            </label>
                            <input type="date" name="date" id="date" value="{{ old('date', $step1['date'] ?? null) }}"
                                class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                            <p id="date-warning" class="mt-1 text-xs font-medium text-red-600"></p>
                        </div>

                        <!-- Guest Count -->
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Number of Guests
                            </label>
                            <input type="number" name="guest_count" id="guest-count" value="{{ old('guest_count', $step1['guest_count'] ?? null) }}" placeholder="Enter guest count"
                                class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                            <p id="guest-warning" class="mt-1 text-xs font-medium text-red-600"></p>

                        </div>
                    </div>

                    <div class="mb-6 grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Reservation Start Time
                            </label>
                            <input type="time" name="start_time" id="start-time" value="{{ old('start_time', $step1['start_time'] ?? null) }}"
                                class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Reservation End Time
                            </label>
                            <input type="time" name="end_time" id="end-time" value="{{ old('end_time', $step1['end_time'] ?? null) }}"
                                class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                            <p id="time-warning" class="mt-1 text-xs font-medium text-red-600"></p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="mb-3 block text-sm font-semibold text-gray-700">
                            Additional Services
                        </label>
                        <!-- Add-ons Section -->
                        <div class="mb-8" id="addons-container">
                            <div class="grid gap-3 sm:grid-cols-2">
                                @foreach ($facilities as $facility)
                                    @foreach ($facility->addOns as $addOn)
                                        <label class="addon-option flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 p-4 transition hover:bg-gray-50 hidden"
                                            data-facility-id="{{ $facility->id }}">
                                            <div class="flex items-center gap-3">
                                                <input type="checkbox" name="addons[]" value="{{ $addOn->id }}"
                                                    data-price="{{ $addOn->price }}"
                                                    class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                                <span class="text-sm text-gray-700">{{ $addOn->name }}</span>
                                            </div>
                                            <span class="text-sm font-semibold text-gray-900">₱{{ number_format($addOn->price, 2) }}</span>
                                        </label>
                                    @endforeach
                                @endforeach
                            </div>
                            <p id="no-addons-msg" class="text-sm text-gray-400 hidden">No add-ons available for this facility.</p>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-8">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Additional Notes
                        </label>
                        <textarea name="notes" rows="3" placeholder="Any special requests or notes (optional)"
                            class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">{{ old('notes', $step1['notes'] ?? null) }}</textarea>
                    </div>

                    <!-- Client Information -->
                    {{-- <div class="border-t border-gray-100 pt-8">
                        <h3 class="mb-5 text-lg font-bold text-gray-900">
                            Client Information
                        </h3>

                        <div class="grid gap-4 md:grid-cols-2">
                            <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Full Name"
                                class="focus:border-primary rounded-xl border border-gray-200 px-4 py-3 outline-none">

                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address"
                                class="focus:border-primary rounded-xl border border-gray-200 px-4 py-3 outline-none">

                            <input type="text" name="contact_number" value="{{ old('contact_number') }}" placeholder="Contact Number"
                                class="focus:border-primary rounded-xl border border-gray-200 px-4 py-3 outline-none">
                        </div>
                    </div> --}}
                </section>

                <!-- Billing Summary -->
                <aside class="h-fit rounded-2xl bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900">
                        Billing Summary
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Review your reservation charges.
                    </p>

                    <div class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                Facility Fee
                            </span>
                            <span class="font-semibold text-gray-900" id="facility-fee-display">
                                ₱0.00
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                Add-ons
                            </span>
                            <span class="font-semibold text-gray-900" id="addons-fee-display">
                                ₱0.00
                            </span>
                        </div>

                        <div class="border-t border-gray-100 pt-5">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">
                                    Total
                                </span>
                                <span class="text-primary text-lg font-bold" id="total-fee-display">
                                    ₱0.00
                                </span>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="total_fee" id="total-fee">

                    <div class="mt-8 space-y-3">
                        <button type="submit" id="form-submit"
                            class="bg-primary hover:bg-primary-hover block w-full rounded-xl px-5 py-3 text-center font-semibold text-white transition">
                            Continue to Review
                        </button>

                        <button type="button"
                            class="w-full rounded-xl border border-gray-200 px-5 py-3 font-semibold text-gray-700 transition hover:bg-gray-50">
                            Save as Draft
                        </button>
                    </div>
                </aside>
            </div>
        </form>
    </div>
</x-resident-layout>
