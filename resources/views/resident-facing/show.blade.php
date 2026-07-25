<x-resident-layout>
    @isset($reservation)
        <x-slot name="header">
            <h2 class="mx-auto max-w-7xl px-4 text-xl font-semibold leading-tight text-gray-800 sm:px-6 lg:px-8">
                My Reservations
            </h2>
        </x-slot>

        <div class="align-center flex h-[calc(100vh-8rem)] justify-center">
            <div class="m-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl">
                <h3 class="center mb-4 flex justify-center text-xl font-bold">Reservation Details</h3>
                <div class="bg-surface-alt border-border-strong shadow-xs mb-4 overflow-hidden rounded-md border">
                    <table class="w-full text-left text-sm">
                        <tbody>
                            <tr>
                                <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Reservation ID</th>
                                <td class="text-body px-4 py-3">{{ $reservation->code }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Facility</th>
                                <td class="text-body px-4 py-3">{{ $reservation->facility->name }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Date</th>
                                <td class="text-body px-4 py-3">{{ Carbon\Carbon::parse($reservation->date)->format('M j, Y') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Time</th>
                                <td class="text-body px-4 py-3">{{ Carbon\Carbon::parse($reservation->start_time)->format('H:i A') }} to {{ Carbon\Carbon::parse($reservation->end_time)->format('H:i A') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Total Fee</th>
                                <td class="text-body px-4 py-3">₱{{ $reservation->total_fee }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Status</th>
                                <td class="text-body px-4 py-3">{{ $reservation->status }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Event Type</th>
                                <td class="text-body px-4 py-3">{{ $reservation->event_type }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Notes</th>
                                <td class="text-body px-4 py-3">{{ $reservation->notes ?? 'No notes' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Add-ons</th>
                                <td class="text-body px-4 py-3">{{ 'TODO' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('resident.my-reservations') }}">Back</a>
            </div>
        </div>
    @endisset
</x-resident-layout>
