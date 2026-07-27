<x-app-layout>
@isset($reservation)
    <div class="flex min-h-screen items-center justify-center">
        <div class="m-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="#d97706"
                class="mx-auto size-24">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 9V5.25A2.25 2.25 0 0 1 6 3h12a2.25 2.25 0 0 1 2.25 2.25V9M3.75 9h16.5M3.75 9v9.75A2.25 2.25 0 0 0 6 21h12a2.25 2.25 0 0 0 2.25-2.25V9" />
            </svg>

            <h3 class="mb-2 text-center text-2xl font-semibold">
                Archive Reservation?
            </h3>

            <p class="mb-6 text-center text-sm text-gray-600">
                This reservation will no longer appear in the active reservation list,
                but its information will be retained for records and reports.
            </p>

            <div class="mb-6 overflow-hidden rounded-md border shadow-sm">
                <table class="w-full text-left text-sm">
                    <tbody>
                        <tr>
                            <th class="w-1/3 bg-primary px-4 py-3 text-right font-medium text-white">Reservation Code</th>
                            <td class="px-4 py-3">{{ $reservation->code }}</td>
                        </tr>

                        <tr>
                            <th class="bg-primary px-4 py-3 text-right font-medium text-white">Facility</th>
                            <td class="px-4 py-3">{{ $reservation->facility->name }}</td>
                        </tr>

                        <tr>
                            <th class="bg-primary px-4 py-3 text-right font-medium text-white">Resident</th>
                            <td class="px-4 py-3">
                                {{ $reservation->resident->last_name }},
                                {{ $reservation->resident->first_name }}
                                {{ $reservation->resident->middle_name }}
                            </td>
                        </tr>

                        <tr>
                            <th class="bg-primary px-4 py-3 text-right font-medium text-white">Date</th>
                            <td class="px-4 py-3">
                                {{ Carbon\Carbon::parse($reservation->date)->format('M j, Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th class="bg-primary px-4 py-3 text-right font-medium text-white">Time</th>
                            <td class="px-4 py-3">
                                {{ Carbon\Carbon::parse($reservation->start_time)->format('h:i A') }}
                                to
                                {{ Carbon\Carbon::parse($reservation->end_time)->format('h:i A') }}
                            </td>
                        </tr>

                        <tr>
                            <th class="bg-primary px-4 py-3 text-right font-medium text-white">Fee</th>
                            <td class="px-4 py-3">
                                ₱{{ number_format($reservation->total_fee, 2) }}
                            </td>
                        </tr>

                        <tr>
                            <th class="bg-primary px-4 py-3 text-right font-medium text-white">Status</th>
                            <td class="px-4 py-3">{{ $reservation->status }}</td>
                        </tr>

                        <tr>
                            <th class="bg-primary px-4 py-3 text-right font-medium text-white">Event Type</th>
                            <td class="px-4 py-3">{{ $reservation->event_type }}</td>
                        </tr>

                        <tr>
                            <th class="bg-primary px-4 py-3 text-right font-medium text-white">Notes</th>
                            <td class="px-4 py-3">{{ $reservation->notes }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('reservation.index') }}">
                    <x-primary-button type="button">
                        Cancel
                    </x-primary-button>
                </a>

                <form action="{{ route('reservation.archive', $reservation) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <x-secondary-button type="submit">
                        Archive Reservation
                    </x-secondary-button>
                </form>
            </div>

        </div>
    </div>
@endisset
</x-app-layout>
