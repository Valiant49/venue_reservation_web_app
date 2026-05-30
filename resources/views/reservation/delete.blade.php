<x-app-layout>
@isset($reservation)
    <dialog id="delete-modal" open
        class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

        {{-- Modal Header --}}
        <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Remove Reservation</h3>
            <a href="/reservation"
                class="cursor-pointer rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-500 transition-colors">
                <span class="sr-only">Close</span>
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        {{-- Warning Icon + Prompt --}}
        <div class="flex flex-col items-center mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-14 text-red-400 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>
            <p class="text-gray-600 text-sm text-center">Are you sure you want to remove this reservation? This action cannot be undone.</p>
        </div>

        {{-- Details Table --}}
        <div class="rounded-lg border border-gray-200 overflow-hidden mb-6">
            <table class="w-full text-sm">
                <tr class="border-b border-gray-100">
                    <th class="px-4 py-2.5 text-left font-medium text-gray-500 bg-gray-50 w-2/5">Reservation Code</th>
                    <td class="px-4 py-2.5 text-gray-900">{{ $reservation->reservation_code }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="px-4 py-2.5 text-left font-medium text-gray-500 bg-gray-50">Facility</th>
                    <td class="px-4 py-2.5 text-gray-900">{{ $reservation->facility->facility_name }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="px-4 py-2.5 text-left font-medium text-gray-500 bg-gray-50">Client Name</th>
                    <td class="px-4 py-2.5 text-gray-900">
                        {{ $reservation->client->last_name }},
                        {{ $reservation->client->first_name }}
                        {{ $reservation->client->middle_name }}
                    </td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="px-4 py-2.5 text-left font-medium text-gray-500 bg-gray-50">Date</th>
                    <td class="px-4 py-2.5 text-gray-900">{{ $reservation->reservation_date }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="px-4 py-2.5 text-left font-medium text-gray-500 bg-gray-50">Time</th>
                    <td class="px-4 py-2.5 text-gray-900">{{ $reservation->start_time }} to {{ $reservation->end_time }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="px-4 py-2.5 text-left font-medium text-gray-500 bg-gray-50">Fee</th>
                    <td class="px-4 py-2.5 text-gray-900">{{ $reservation->total_fee }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="px-4 py-2.5 text-left font-medium text-gray-500 bg-gray-50">Status</th>
                    <td class="px-4 py-2.5 text-gray-900">{{ $reservation->status }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="px-4 py-2.5 text-left font-medium text-gray-500 bg-gray-50">Event Type</th>
                    <td class="px-4 py-2.5 text-gray-900">{{ $reservation->event_type }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2.5 text-left font-medium text-gray-500 bg-gray-50">Notes</th>
                    <td class="px-4 py-2.5 text-gray-900">{{ $reservation->notes }}</td>
                </tr>
            </table>
        </div>

        {{-- Footer Buttons --}}
        <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-4">
            <x-secondary-button onclick="location.href='/reservation'"
                class="cursor-pointer rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Cancel
            </x-secondary-button>
            <form action="/reservation/{{ $reservation->id }}" method="POST">
                @csrf
                @method('DELETE')
                <x-primary-button type="submit"
                    class="cursor-pointer rounded-lg px-4 py-2 text-primary shadow-sm focus:outline-none focus:ring-2">
                    Yes, Delete
                </x-primary-button>
            </form>
        </div>

    </dialog>
@endisset
</x-app-layout>
