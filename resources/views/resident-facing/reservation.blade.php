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

        <form action="{{ route('resident.billing.store') }}" method="POST">
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
                                    data-type="{{ $facility->reservation_type }}"
                                    data-capacity="{{ $facility->max_capacity }}">
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
                        <input type="text" name="event_type" value="{{ old('event_type', $step1['event_type']) }}" placeholder="e.g. Birthday, Meeting, Wedding"
                            class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                    </div>

                    <!-- Date and Guest Count -->
                    <div class="mb-6 grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Reservation Date
                            </label>
                            <input type="date" name="date" value="{{ old('date', $step1['date']) }}"
                                class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                        </div>

                        <!-- Guest Count -->
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Number of Guests
                            </label>
                            <input type="number" name="guest_count" value="{{ old('guest_count', $step1['guest_count']) }}" placeholder="Enter guest count"
                                class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                            <p class="mt-1 text-sm text-gray-500">
                                Maximum capacity: 50 guests
                            </p>
                        </div>
                    </div>

                    <div class="mb-6 grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Reservation Start Time
                            </label>
                            <input type="time" name="start_time" value="{{ old('start_time', $step1['start_time']) }}"
                                class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Reservation End Time
                            </label>
                            <input type="time" name="end_time" value="{{ old('end_time', $step1['end_time']) }}"
                                class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="mb-3 block text-sm font-semibold text-gray-700">
                            Additional Services
                        </label>
                        <!-- Add-ons Section -->
                        <div class="grid gap-3 sm:grid-cols-2">

                            <label class="flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 p-4 transition hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" name="addons[]" value="sound_system" class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Sound System
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">
                                    ₱500
                                </span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 p-4 transition hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" name="addons[]" value="chairs" class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Chairs
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">
                                    ₱300
                                </span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 p-4 transition hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" name="addons[]" value="tables" class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Tables
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">
                                    ₱200
                                </span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 p-4 transition hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" name="addons[]" value="lights" class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Lights
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">
                                    ₱400
                                </span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 p-4 transition hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" name="addons[]" value="cleaning_service" class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Cleaning Service
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">
                                    ₱600
                                </span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-between rounded-xl border border-gray-200 p-4 transition hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" name="addons[]" value="decoration" class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Decoration
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">
                                    ₱800
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-8">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Additional Notes
                        </label>
                        <textarea name="notes" rows="3" placeholder="Any special requests or notes (optional)"
                            class="focus:border-primary w-full rounded-xl border border-gray-200 px-4 py-3 outline-none">{{ old('notes', $step1['notes']) }}</textarea>
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
                            <span class="font-semibold text-gray-900">
                                ₱0.00
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                Add-ons
                            </span>
                            <span class="font-semibold text-gray-900">
                                ₱0.00
                            </span>
                        </div>

                        <div class="border-t border-gray-100 pt-5">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">
                                    Total
                                </span>
                                <span class="text-primary text-lg font-bold">
                                    ₱0.00
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 space-y-3">
                        <button type="submit"
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
