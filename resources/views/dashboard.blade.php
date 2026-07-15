<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class=py-4 px-4">
        <div class="grid grid-cols-5 place-items-stretch gap-4">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                {{-- header --}}
                <div class="p-3">
                    <div class="border-default-medium border-grey-4 border-b pb-3 text-2xl font-bold text-gray-900">
                        {{ __('Summary') }}
                    </div>
                    <div class="border-default-medium border-grey-4 flex gap-2 border-b pb-3 pt-3">
                        <div>
                            <h2 class="text-xl font-extrabold">Total Reservations This Week</h2>
                            <p class="text-lg font-medium"> {{ $totalReservationsThisWeek }} </p>
                        </div>
                    </div>
                    <div class="border-default-medium border-grey-4 flex gap-2 border-b pb-3 pt-3">
                        <div>
                            <h2 class="text-xl font-extrabold">No. of Available Facilities</h2>
                            <p class="text-lg font-medium">{{ $activeFacilitiesCount }}</p>
                        </div>
                    </div>
                    <div class="border-default-medium border-grey-4 flex gap-2 border-b pb-3 pt-3">
                        <div>
                            <h2 class="text-xl font-extrabold">No. of Active Residents on Record</h2>
                            <p class="text-lg font-medium">{{ $activeResidentsCount }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2 pb-3 pt-3">
                        <div>
                            <h2 class="text-xl font-extrabold">Pending/Unconfirmed Reservations</h2>
                            <p class="text-lg font-medium">{{ $pendingReservations }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-default-medium border-grey-4 flex justify-between border-b p-3">
                    <div class="text-2xl font-bold text-gray-900">
                        {{ __('Today at a glance') }}
                    </div>
                    <div id="datetime" class="text-2xl font-bold text-gray-900">
                    </div>
                    <script>
                        function updateDateTime() {
                            const now = new Date();
                            const date = now.toLocaleDateString('en-US', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            const time = now.toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            });
                            document.getElementById('datetime').textContent = `${date} — ${time}`;
                        }
                        updateDateTime();
                        setInterval(updateDateTime, 1000);
                    </script>
                </div>
                <div class="p-3">
                    <div
                        class="bg-surface-alt shadow-xs border-border-strong max-h-200 relative overflow-x-auto overflow-y-auto rounded-md border">
                        <table class="text-body w-full text-left text-sm">
                            <thead
                                class="text-body bg-primary border-default-medium text-text-inverse sticky top-0 z-10 border-b text-sm">
                                <tr>
                                    <th scope="col" class="px-3 py-3 font-medium">Facility</th>
                                    <th scope="col" class="px-3 py-3 font-medium">Client Name</th>
                                    <th scope="col" class="px-3 py-3 font-medium">Date</th>
                                    <th scope="col" class="px-3 py-3 font-medium">Time</th>
                                    <th scope="col" class="px-3 py-3 font-medium">Fee</th>
                                    <th scope="col" class="px-3 py-3 font-medium">Status</th>
                                </tr>
                            </thead>
                            @foreach ($reservationsToday as $reservation)
                                <tr
                                    class="bg-neutral-primary-soft border-default hover:bg-neutral-secondary-medium border-b">
                                    <td class="px-3 py-4"> {{ $reservation->facility->facility_name ?? 'N/A' }} </td>
                                    <td class="px-3 py-4">
                                        {{ $reservation->client->last_name }},
                                        {{ $reservation->client->first_name }}
                                        {{ Str::limit($reservation->client->middle_name, 1, '.') }}
                                    </td>
                                    <td class="px-3 py-4"> {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }} </td>
                                    <td class="px-3 py-4"> {{ \Carbon\Carbon::parse($reservation->start_time)->format('h:i A') }} to
                                        {{ \Carbon\Carbon::parse($reservation->end_time)->format('h:i A') }} </td>
                                    <td class="px-3 py-4"> {{ $reservation->total_fee }} </td>
                                    <td class="px-3 py-4"> {{ $reservation->status }} </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-3">
                    <div class="border-default-medium border-grey-4 border-b pb-3 text-2xl font-bold text-gray-900">
                        {{ __('Upcoming Reservations') }}
                        <x-input-label value="This Week" />
                    </div>
                    <div class="overflow-y-auto max-h-150">
                        @foreach ($reservations as $reservation)
                            <div class="border-default-medium border-grey-4 flex gap-2 border-b pb-3 pt-3">
                                <div>
                                    <p class="text-xl font-extrabold">
                                        {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('D - M d, Y') }}
                                    </p>
                                    <p class="text-lg font-medium"> {{ $reservation->facility->facility_name }} -
                                        {{ $reservation->guest_count }}pax. </p>
                                    <p class="text-md font-medium"> {{ $reservation->client->last_name }},
                                        {{ $reservation->client->first_name }} </p>
                                    <p class="text-sm font-medium"> {{ $reservation->status }} </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
