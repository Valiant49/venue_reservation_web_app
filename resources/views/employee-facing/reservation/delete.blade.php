<x-app-layout>
@isset($reservation)
    <div class="align-center flex min-h-screen justify-center">
        <div class="m-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                class="size-25 m-auto">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>

            <h3 class="center mb-4 flex justify-center text-xl">Are you sure you want to remove this reservation?</h3>

            <div class="bg-surface-alt border-border-strong shadow-xs mb-4 overflow-hidden rounded-md border">
                <table class="w-full text-left text-sm">
                    <tbody>
                        <tr>
                            <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Reservation Code</th>
                            <td class="text-body px-4 py-3">{{ $reservation->code }}</td>
                        </tr>
                        <tr>
                            <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Facility</th>
                            <td class="text-body px-4 py-3">{{ $reservation->facility->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Resident Name</th>
                            <td class="text-body px-4 py-3">
                                {{ $reservation->resident->last_name }},
                                {{ $reservation->resident->first_name }}
                                {{ $reservation->resident->middle_name }}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Date</th>
                            <td class="text-body px-4 py-3">{{ Carbon\Carbon::parse($reservation->date)->format('M j, Y') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Time</th>
                            <td class="text-body px-4 py-3">
                                {{ Carbon\Carbon::parse($reservation->start_time)->format('h:i A') }} to {{ Carbon\Carbon::parse($reservation->end_time)->format('h:i A') }}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-primary text-white w-1/3 px-4 py-3 text-right font-medium">Fee</th>
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
                            <td class="text-body px-4 py-3">{{ $reservation->notes }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex-inline flex justify-end">
                <a href="{{ route('reservation.index') }}">
                    <x-primary-button type="button" class="mr-4">Cancel</x-primary-button>
                </a>
                <form action="{{ route('reservation.destroy', $reservation) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-secondary-button type="submit">Yes, Delete</x-secondary-button>
                </form>
            </div>

        </div>
    </div>
@endisset
</x-app-layout>
