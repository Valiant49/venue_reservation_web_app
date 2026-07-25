<x-resident-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            Dashboard
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-4">

        {{-- Main column --}}
        <div class="lg:col-span-2 flex flex-col gap-4">

            {{-- Greeting --}}
            <div class="bg-background py-4 px-4 rounded-md">
                <div class="text-2xl">Good day, {{ Auth::user()->first_name }}.</div>
                <div class="text-sm text-gray-500">
                    {{ Str::title(Auth::user()->account_status) }} {{ Str::title(Auth::user()->role) }}
                </div>
            </div>

            {{-- Reservations --}}
            <div class="bg-background py-4 px-4 rounded-md">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-2xl">My Reservations</p>
                    <a href="{{ route('resident.my-reservations') }}" class="text-sm text-primary hover:underline">
                        View all
                    </a>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-3">
                    @forelse ($reservations as $reservation)
                        <div class="bg-primary text-white rounded-lg px-4 py-3">
                            <div class="text-lg font-bold leading-tight">
                                {{ $reservation->facility->name }}
                            </div>

                            <div class="flex justify-between items-center mt-1">
                                <span class="text-xs tracking-wide text-white/70">
                                    {{ Str::upper($reservation->code) }}
                                </span>

                                @php
                                    $statusColors = [
                                        'confirmed' => 'bg-green-500/20 text-green-300',
                                        'pending'   => 'bg-yellow-500/20 text-yellow-300',
                                        'cancelled' => 'bg-red-500/20 text-red-300',
                                    ];
                                    $badge = $statusColors[strtolower($reservation->status)] ?? 'bg-white/10 text-white/80';
                                @endphp
                                <span class="text-xs font-medium px-2 py-0.5 rounded-full {{ $badge }}">
                                    {{ Str::title($reservation->status) }}
                                </span>
                            </div>

                            <div class="flex gap-3 mt-2 text-sm text-white/80">
                                <div>{{ Carbon\Carbon::parse($reservation->date)->format('M j, Y') }}</div>
                                <div>
                                    {{ Carbon\Carbon::parse($reservation->start_time)->format('h:i A') }}
                                    –
                                    {{ Carbon\Carbon::parse($reservation->end_time)->format('h:i A') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-gray-500">You have no reservations yet.</div>
                    @endforelse
                </div>
            </div>

            {{-- Available Facilities --}}
            <div class="bg-background py-4 px-4 rounded-md">
                <p class="text-2xl mb-3">Available Facilities</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @forelse ($facilities as $facility)
                        @php
                            $isOpen = strtolower($facility->facility_status) === 'open';
                        @endphp
                        <div class="flex items-center justify-between border border-gray-200 rounded-md px-3 py-2">
                            <div class="font-medium">{{ $facility->name }}</div>
                            <span class="flex items-center gap-1.5 text-xs font-medium">
                                <span class="w-2 h-2 rounded-full {{ $isOpen ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $isOpen ? 'Available' : 'In Use' }}
                            </span>
                        </div>
                    @empty
                        <div class="text-sm text-gray-500">No facilities to show.</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="flex flex-col gap-4">

            {{-- Quick stats --}}
            <div class="bg-background py-4 px-4 rounded-md">
                <p class="text-lg font-semibold mb-3">Overview</p>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white border border-gray-200 rounded-md px-3 py-3 text-center">
                        <div class="text-2xl font-bold text-primary">{{ $reservations->count() }}</div>
                        <div class="text-xs text-gray-500">Total Reservations</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-md px-3 py-3 text-center">
                        <div class="text-2xl font-bold text-primary">
                            {{ $reservations->where('status', 'confirmed')->count() }}
                        </div>
                        <div class="text-xs text-gray-500">Confirmed</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-md px-3 py-3 text-center">
                        <div class="text-2xl font-bold text-primary">
                            {{ $reservations->where('status', 'pending')->count() }}
                        </div>
                        <div class="text-xs text-gray-500">Pending</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-md px-3 py-3 text-center">
                        <div class="text-2xl font-bold text-primary">
                            {{ $facilities->where('facility_status', 'Open')->count() }}
                        </div>
                        <div class="text-xs text-gray-500">Open Facilities</div>
                    </div>
                </div>
            </div>

            {{-- Upcoming reservation highlight --}}
            @php
                $upcoming = $reservations->sortBy('date')->first();
            @endphp
            @if($upcoming)
                <div class="bg-background py-4 px-4 rounded-md">
                    <p class="text-lg font-semibold mb-3">Next Up</p>
                    <div class="border border-gray-200 rounded-md px-3 py-3">
                        <div class="font-bold">{{ $upcoming->facility->name }}</div>
                        <div class="text-sm text-gray-500 mt-1">
                            {{ Carbon\Carbon::parse($upcoming->date)->format('M j, Y') }}
                            ·
                            {{ Carbon\Carbon::parse($upcoming->start_time)->format('h:i A') }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Quick actions --}}
            <div class="bg-background py-4 px-4 rounded-md">
                <p class="text-lg font-semibold mb-3">Quick Actions</p>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('resident.available-facility') }}"
                       class="text-sm text-center bg-primary text-white rounded-md py-2 hover:bg-primary/90">
                        Reserve a Facility
                    </a>
                    <a href="{{ route('resident.my-reservations') }}"
                       class="text-sm text-center border border-gray-300 rounded-md py-2 hover:bg-gray-50">
                        View My Reservations
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-resident-layout>
