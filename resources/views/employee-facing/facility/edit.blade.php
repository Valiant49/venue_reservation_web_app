<x-app-layout>
    @isset($facility)
    <div
        class="fixed inset-y-0 right-0 left-[350px] z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-xs">
        <dialog id="edit-modal" open
            class="open:animate-fade-in static w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                <h3 class="text-xl font-semibold text-gray-900">Edit Facility Details</h3>
                <a href="{{ route('facility.index') }}"
                    class="cursor-pointer rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-500 transition-colors">
                    <span class="sr-only">Close</span>
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
            {{-- Error Alert --}}
            @if($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 p-4 border border-red-100">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            {{-- Form --}}
            {{-- <form action="/facility/{{ $facility->id }}" method="POST" class="space-y-4"> --}}
            <form action="{{ route('facility.update', $facility) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="facility-name">Facility Name:</x-input-label>
                    <x-text-input type="text" id="facility-name" name="name" value="{{ old('name', $facility->name ?? '')}}"></x-text-input>
                </div>
                <div>
                    <x-input-label for="edit-fac-type">Facility Category:</x-input-label>
                    <x-select-input name="category" id="edit-fac-type"
                        placeholder="Please select..."
                        :selected="old('category', $facility->category)"
                        :options="[
                            'hall' => 'Hall',
                            'pool' => 'Pool',
                            'court' => 'Court',
                            'clubhouse' => 'Clubhouse',
                        ]"/>
                </div>

                <div>
                    <x-input-label for="description">Facility Description</x-input-label>
                    <x-textarea-input name="description" id="description" class="resize-none h-20">{{ old('description', $facility->description) }}</x-textarea-input>
                </div>

                <div>
                    <x-input-label for="reservation-type">Reservation Type:</x-input-label>
                    <x-select-input name="reservation_type" id="reservation-type"
                        placeholder="Please select..."
                        :selected="old('reservation_type', $facility->reservation_type)"
                        :options="[
                            'hourly' => 'Hourly',
                            'block' => 'Block'
                        ]"/>
                </div>

                <div>
                    <x-input-label for="base-fee">Base Fee</x-input-label>
                    <x-text-input type="number" id="base-fee" name="base_fee" placeholder="0.00"
                        value="{{ old('base_fee', $facility->base_fee) }}"></x-text-input>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <x-input-label for="start-time">Starting Hours:</x-input-label>
                        <x-text-input type="time" id="start-time" name="starting_hours" class="mt-1 w-full" value="{{ old('starting_hours', \Carbon\Carbon::parse($facility->starting_hours)->format('H:i')) }}" />
                    </div>
                    <div>
                        <x-input-label for="closing-time">Closing Hours:</x-input-label>
                        <x-text-input type="time" id="closing-time" name="closing_hours" class="mt-1 w-full" value="{{ old('closing_hours', \Carbon\Carbon::parse($facility->closing_hours)->format('H:i')) }}" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <x-input-label for="capacity"
                            class="block text-sm font-medium text-gray-700 mb-1">Maximum Capacity: </x-input-label>
                        <x-text-input type="text" id="capacity" name="max_capacity"
                            value="{{ old('max_capacity', $facility->max_capacity) }}" />
                    </div>
                    <div>
                        <x-input-label for="duration">Maximum Reservation Duration:</x-input-label>
                        <x-text-input type="number" id="duration" name="max_reservation_duration" min=1 class="mt-1 w-full"
                            value="{{ old('max_reservation_duration', $facility->max_reservation_duration) }}"/>
                    </div>
                </div>

                <div>
                    <x-input-label for="facility-status">Status:</x-input-label>
                    <x-select-input name="facility_status" id="facility-status" placeholder="Select status..."
                        :selected="old('facility_status', $facility->facility_status)"
                        :options="[
                            'Open' => 'Open',
                            'Under Maintenance' => 'Under Maintenance',
                            'Closed' => 'Closed'
                        ]" />
                </div>

                {{-- Footer Buttons --}}
                <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-4 mt-6">
                    <x-secondary-button onclick="location.href='{{ route('facility.index')}}'"
                        class="cursor-pointer rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button type="submit"
                        class="cursor-pointer rounded-lg px-4 py-2 bg-secondary hover:bg-secondary-hover text-sm font-medium text-text shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                        Update Facility
                    </x-primary-button>
                </div>
            </form>
        </dialog>
    </div>
    @endisset
</x-app-layout>
