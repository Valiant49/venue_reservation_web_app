<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-resident-layout>
        <div class="mx-auto max-w-7xl">


            <!-- Header -->
            <div class="mb-8">

                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                    Review & Billing
                </h1>

                <p class="mt-2 text-gray-500">
                    Review your reservation details before submitting.
                </p>

            </div>



            <!-- Steps -->

            <div class="mb-10 flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-primary text-sm font-bold text-white">
                        1
                    </div>
                    <span class="text-gray-500">
                        Reservation Details
                    </span>
                </div>

                <div class="h-px flex-1 bg-primary"></div>

                <div class="flex items-center gap-3">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-primary text-sm font-bold text-white">
                        2
                    </div>
                    <span class="font-semibold text-gray-900">
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

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Reservation Summary -->
                <section class="rounded-2xl bg-white p-6 shadow-sm lg:col-span-2">
                    <h2 class="mb-6 text-xl font-bold text-gray-900">
                        Reservation Summary
                    </h2>
                    <div class="space-y-5">
                        <div class="flex justify-between">
                            <span class="text-gray-500">
                                Facility
                            </span>
                            <span class="font-semibold text-gray-900">
                                {{ $facility['name'] }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">
                                Reservation Date
                            </span>
                            <span class="font-semibold text-gray-900">
                                {{ Carbon\Carbon::parse($step1['date'])->format('M j, Y') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">
                                Time
                            </span>
                            <span class="font-semibold text-gray-900">
                                {{ Carbon\Carbon::parse($step1['start_time'])->format('h:i A') }} to
                                {{ Carbon\Carbon::parse($step1['end_time'])->format('h:i A') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">
                                Number of Guests
                            </span>
                            <span class="font-semibold text-gray-900">
                                {{ $step1['guest_count'] }} pax
                            </span>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-100 pt-6">
                        <h3 class="mb-4 text-lg font-bold text-gray-900">
                            Additional Services
                        </h3>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-500">
                                    Sound System
                                </span>
                                <span class="font-semibold">
                                    ₱500
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-500">
                                    Chairs
                                </span>
                                <span class="font-semibold">
                                    ₱300
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Billing -->
                <aside class="h-fit rounded-2xl bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900">
                        Billing Summary
                    </h2>
                    <div class="mt-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-500">
                                Facility Fee
                            </span>
                            <span class="font-semibold">
                                ₱{{ number_format($totalFee, 2, '.', ',') }}
                            </span>
                        </div>

                        <div class="flex justify-between">

                            <span class="text-gray-500">
                                Add-ons
                            </span>
                            <span class="font-semibold">

                            </span>
                        </div>

                        <div class="flex justify-between border-t pt-5">
                            <span class="text-lg font-bold">
                                Total
                            </span>
                            <span class="text-lg font-bold text-primary">
                                ₱2,800
                            </span>
                        </div>
                    </div>

                    <div class="mt-8 space-y-3">
                        <form action="{{ route('resident.reservation.store') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full rounded-xl bg-primary px-5 py-3 font-semibold text-white hover:bg-blue-700">
                                Submit Reservation
                            </button>
                        </form>

                        <a href="{{ route('resident.create-reservation') }}"
                            class="block w-full rounded-xl border border-gray-200 px-5 py-3 text-center font-semibold text-gray-700 hover:bg-gray-50">
                            Back to Details
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </x-resident-layout>
</body>

</html>
