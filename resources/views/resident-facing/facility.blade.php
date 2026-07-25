<x-resident-layout>
    <x-slot name="header">
        <h2 class="mx-auto max-w-7xl px-4 text-xl font-semibold leading-tight text-gray-800 sm:px-6 lg:px-8">
            Available Facilities
        </h2>
    </x-slot>

    <div class="mt-4">
        @foreach ($facilities as $facility)
            <div class="flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm mt-3">
                {{-- Image --}}
                <div class="relative h-40 w-full bg-gray-100 md:h-48">
                    @if ($facility->image)
                        <img src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}"
                            class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center text-sm text-gray-400">
                            No image available
                        </div>
                    @endif

                    {{-- Status badge, floating top-right --}}
                    @php
                        $statusColors = [
                            'open' => 'bg-green-500/90 text-white',
                            'under maintenance' => 'bg-yellow-500/90 text-white',
                            'closed' => 'bg-red-500/90 text-white',
                        ];
                        $badge = $statusColors[strtolower($facility->facility_status)] ?? 'bg-gray-500/90 text-white';
                    @endphp
                    <span class="{{ $badge }} absolute right-2 top-2 rounded-full px-2 py-1 text-xs font-medium">
                        {{ $facility->facility_status }}
                    </span>
                </div>

                {{-- Body --}}
                <div class="flex flex-1 flex-col gap-3 p-4">
                    {{-- Name + category --}}
                    <div>
                        <div class="text-lg font-bold leading-tight text-gray-900">
                            {{ $facility->name }}
                        </div>
                        <div class="text-xs uppercase tracking-wide text-gray-500">
                            {{ Str::title($facility->category) }}
                        </div>
                    </div>

                    {{-- Description, truncated --}}
                    <p class="line-clamp-2 text-sm text-gray-600">
                        {{ $facility->description }}
                    </p>

                    {{-- Key attributes grid --}}
                    <div class="mt-1 grid grid-cols-2 gap-x-3 gap-y-2 text-sm">
                        <div>
                            <div class="text-xs text-gray-400">Hours</div>
                            <div class="font-medium text-gray-800">
                                {{ Carbon\Carbon::parse($facility->starting_hours)->format('h:i A') }}
                                –
                                {{ Carbon\Carbon::parse($facility->closing_hours)->format('h:i A') }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-400">Capacity</div>
                            <div class="font-medium text-gray-800">
                                {{ $facility->max_capacity }} pax
                            </div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-400">Base Fee</div>
                            <div class="font-medium text-gray-800">
                                ₱{{ number_format($facility->base_fee, 2) }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-400">Reservation</div>
                            <div class="font-medium text-gray-800">
                                {{ Str::title($facility->reservation_type) }}
                                ({{ $facility->max_reservation_duration }} hrs max)
                                {{-- {{ $facility->reservation_type === 'hourly' ? 'hr max' : 'min max' }} --}}
                            </div>
                        </div>
                    </div>

                    {{-- CTA
        <a href="{{ route('resident.facility.show', $facility->id) }}"
           class="mt-auto inline-flex justify-center items-center text-sm font-medium text-white bg-primary hover:bg-primary/90 rounded-md py-2 transition">
            View Details
        </a> --}}
                </div>
            </div>
        @endforeach
    </div>




</x-resident-layout>
