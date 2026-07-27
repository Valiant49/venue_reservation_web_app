<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="px-4 py-4">
        <div class="mb-3 grid grid-cols-1 items-stretch gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-background flex min-w-0 flex-col justify-between rounded-md p-4">
                <h2 class="mb-2 break-words text-lg">No. of Today's Reservations</h2>
                <p class="text-xl font-semibold">{{ $reservationsTodayCount }}</p>
            </div>
            <div class="bg-background flex min-w-0 flex-col justify-between rounded-md p-4">
                <h2 class="mb-2 break-words text-lg">No. of Pending Reservations</h2>
                <p class="text-xl font-semibold">{{ $pendingReservationsCount }}</p>
            </div>
            <div class="bg-background flex min-w-0 flex-col justify-between rounded-md p-4">
                <h2 class="mb-2 break-words text-lg">No. of Active Residents</h2>
                <p class="text-xl font-semibold">{{ $activeResidentsCount }}</p>
            </div>
            <div class="bg-background flex min-w-0 flex-col justify-between rounded-md p-4">
                <h2 class="mb-2 break-words text-lg">Reservations this Month</h2>
                <p class="text-xl font-semibold">{{ $totalReservationsThisMonth }}</p>
            </div>
        </div>
        <div class="grid grid-auto-rows-max">
            <div class="mb-3">
                <div class="bg-background w-full rounded-md p-4">
                    <h2 class="mb-3 text-lg font-semibold">Today's Reservations</h2>

                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="border-b border-gray-200 text-gray-500">
                                    <th class="whitespace-nowrap py-2 pr-4 font-medium">Resident</th>
                                    <th class="whitespace-nowrap py-2 pr-4 font-medium">Facility</th>
                                    <th class="whitespace-nowrap py-2 pr-4 font-medium">Time</th>
                                    <th class="whitespace-nowrap py-2 pr-4 font-medium">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reservationsToday as $reservation)
                                    <tr class="border-b border-gray-100 last:border-0">
                                        <td class="whitespace-nowrap py-2 pr-4">{{ $reservation->resident->last_name }},
                                            {{ $reservation->resident->first_name }}
                                            {{ Str::limit($reservation->resident->middle_name, 1, '.') }} </td>
                                        <td class="whitespace-nowrap py-2 pr-4">{{ $reservation->facility->name }}</td>
                                        <td class="whitespace-nowrap py-2 pr-4">
                                            {{ $reservation->start_time->format('H:i A') }} -
                                            {{ $reservation->end_time->format('H:i A') }}</td>
                                        <td class="whitespace-nowrap py-2 pr-4">
                                            <span
                                                class="{{ $reservation->status === 'Confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} rounded-full px-2 py-0.5 text-xs font-medium">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 text-center text-gray-400">
                                            No reservations for today.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    <div class="flex justify-end">
                        <a href="{{ route('reservation.index') }}"
                            class="bg-primary rounded-lg px-2 py-2 font-medium text-white">
                            View More
                        </a>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="bg-background w-full rounded-md p-2">
                    <h2 class="mb-3 text-lg font-semibold">Pending Reservations</h2>
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 text-gray-500">
                                <th class="whitespace-nowrap py-2 pr-4 font-medium">Resident</th>
                                <th class="whitespace-nowrap py-2 pr-4 font-medium">Facility</th>
                                <th class="whitespace-nowrap py-2 pr-4 font-medium">Time</th>
                                <th class="whitespace-nowrap py-2 pr-4 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingReservations as $reservation)
                                <tr class="border-b border-gray-100 last:border-0">
                                    <td class="whitespace-nowrap py-2 pr-4">{{ $reservation->resident->last_name }},
                                        {{ $reservation->resident->first_name }}
                                        {{ Str::limit($reservation->resident->middle_name, 1, '.') }} </td>
                                    <td class="whitespace-nowrap py-2 pr-4">{{ $reservation->facility->name }}</td>
                                    <td class="whitespace-nowrap py-2 pr-4">{{ $reservation->start_time->format('H:i A') }}
                                        - {{ $reservation->end_time->format('H:i A') }}</td>
                                    <td class="whitespace-nowrap py-2 pr-4">
                                        <span
                                            class="{{ $reservation->status === 'Confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} rounded-full px-2 py-0.5 text-xs font-medium">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-400">
                                        No pending reservations.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="flex justify-end">
                        <a href="{{ route('reservation.index', ['status' => 'Pending']) }}"
                            class="bg-primary rounded-lg px-2 py-2 font-medium text-white">
                            View More
                        </a>
                    </div>
                </div>
            </div>
            <div class="mb-3 flex gap-4">
                <div class="bg-background w-full rounded-md p-2">
                    <h2 class="mb-3 text-lg font-semibold">Activity Log</h2>
                    <div class="max-h-60 overflow-y-auto">
                        <table class="text-body w-full text-left text-sm">
                            <thead
                                class="text-body bg-surface border-default-medium text-text sticky top-0 z-10 border-b text-sm">
                                <tr>
                                    <th scope="col" class="px-4 py-2 font-medium">Recent Activity</th>
                                </tr>
                            </thead>
                            <tbody id="log-table-body">
                                @foreach ($logs as $log)
                                    <tr class="bg-background border-default border-b hover:bg-gray-300">
                                        <td>
                                            [{{ $log->created_at }}] {{ $log->user_name }} {{ $log->action }} a
                                            {{ class_basename($log->entity_type) }}.
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="bg-background w-full rounded-md p-2">
                    <h2 class="mb-3 text-lg font-semibold">Quick Actions</h2>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('reservation.index') }}" class="bg-primary text-white hover:bg-primary-hover px-3 py-2 rounded-md text-center">Add Reservation</a>
                        <a href="{{ route('residents.index') }}" class="bg-primary text-white hover:bg-primary-hover px-3 py-2 rounded-md text-center">Add Resident</a>
                        <a href="{{ route('facility.index') }}" class="bg-primary text-white hover:bg-primary-hover px-3 py-2 rounded-md text-center">Add Facility</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
