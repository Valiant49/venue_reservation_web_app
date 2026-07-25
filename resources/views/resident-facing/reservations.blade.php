<x-resident-layout>
    <x-slot name="header">
        <h2 class="mx-auto max-w-7xl px-4 text-xl font-semibold leading-tight text-gray-800 sm:px-6 lg:px-8">
            My Reservations
        </h2>
    </x-slot>

    {{-- <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-2"> --}}
    <div class="mt-4 flex flex-col gap-4 lg:flex-row-reverse">
        {{-- Quick actions --}}
        <div class="bg-background w-full lg:flex-1 rounded-md px-4 py-4">
            <p class="mb-3 text-lg font-semibold">Quick Actions</p>
            <div class="flex flex-col gap-2">
                <a href="{{ route('resident.create-reservation') }}"
                    class="bg-primary hover:bg-primary/90 rounded-md py-2 text-center text-sm text-white">
                    Reserve a Facility
                </a>
                {{-- <a href="{{ route('resident.my-reservations') }}"
                    class="rounded-md border border-gray-300 py-2 text-center text-sm hover:bg-gray-50">
                    View My Reservations
                </a> --}}
            </div>
        </div>
        <div class="w-full lg:flex-1/3">
            @forelse ($reservations as $reservation)
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-500/20 text-yellow-300',
                        'rejected' => 'bg-red-500/20 text-red-300',
                        'under review' => 'bg-blue-500/20 text-blue-300',
                        'confirmed' => 'bg-green-500/20 text-green-300',
                        'completed' => 'bg-gray-500/20 text-gray-300',
                        'cancelled' => 'bg-red-500/20 text-red-300',
                    ];
                    $badge = $statusColors[strtolower($reservation->status)] ?? 'bg-white/10 text-white/80';
                @endphp
                <div class="bg-primary flex flex-col gap-2 rounded-lg px-4 py-4 text-white mb-3">
                    {{-- Primary: facility name + status --}}
                    <div class="flex items-start justify-between">
                        <div class="text-lg font-bold leading-tight">
                            {{ $reservation->facility->name }}
                        </div>
                        <span class="{{ $badge }} whitespace-nowrap rounded-full px-2 py-0.5 text-xs font-medium">
                            {{ $reservation->status }}
                        </span>
                    </div>
                    {{-- Secondary: code + event type --}}
                    <div class="flex items-center justify-between text-xs text-white/70">
                        <span class="tracking-wide">{{ Str::upper($reservation->code) }}</span>
                        <span>{{ $reservation->event_type }}</span>
                    </div>
                    {{-- Date / time --}}
                    <div class="mt-1 flex gap-3 text-sm text-white/80">
                        <div>{{ Carbon\Carbon::parse($reservation->date)->format('M j, Y') }}</div>
                        <div>
                            {{ Carbon\Carbon::parse($reservation->start_time)->format('h:i A') }}
                            –
                            {{ Carbon\Carbon::parse($reservation->end_time)->format('h:i A') }}
                        </div>
                    </div>
                    {{-- Tertiary: guests + fee --}}
                    <div class="mt-2 flex items-center justify-between border-t border-white/10 pt-2 text-sm">
                        <div class="text-white/80">
                            {{ $reservation->guest_count }} guest{{ $reservation->guest_count > 1 ? 's' : '' }}
                        </div>
                        <div class="font-semibold">
                            ₱{{ number_format($reservation->total_fee, 2) }}
                        </div>
                    </div>
                    {{-- Notes, only if present --}}
                    @if ($reservation->notes)
                        <div class="mt-1 line-clamp-2 text-xs italic text-white/60">
                            "{{ $reservation->notes }}"
                        </div>
                    @endif
                    {{-- Action --}}
                    {{-- <a href="{{ route('resident.reservation.show', $reservation->id) }}"
                            class="mt-2 inline-flex items-center justify-center rounded-md bg-white/10 py-2 text-sm font-medium transition hover:bg-white/20">
                            View Details
                        </a> --}}
                </div>
            @empty
                <div class="text-sm text-gray-500">You have no reservations yet.</div>
            @endforelse
        </div>

    </div>
</x-resident-layout>
