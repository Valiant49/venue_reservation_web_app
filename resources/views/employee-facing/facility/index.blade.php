<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Facilities') }}
        </h2>
    </x-slot>

    <div class="px-4 py-6">
        @if (session('success'))
            <div class="mb-4 rounded-md border border-green-200 bg-green-100 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-md border border-red-200 bg-red-100 p-4 text-sm text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4 flex items-center justify-end">
            <button onclick="document.getElementById('add-modal').showModal()"
                class="shadow-xs bg-surface text-md text-text hover:bg-secondary-hover hover:text-white focus-visible:outline-secondary-subtle cursor-pointer rounded-md px-4 py-2 font-semibold focus-visible:outline-2 focus-visible:outline-offset-2">
                Add Facility
            </button>
        </div>

        <div
            class="bg-surface shadow-xs border-border-strong max-h-180 relative overflow-x-auto overflow-y-auto rounded-md border">
            <table class="text-body w-full text-left text-sm">
                <thead
                    class="text-body bg-background border-default-medium text-text sticky top-0 z-10 border-b text-sm">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">Name</th>
                        <th scope="col" class="px-6 py-3 font-medium">Type</th>
                        <th scope="col" class="px-6 py-3 font-medium">Base fee</th>
                        <th scope="col" class="px-6 py-3 font-medium">Capacity</th>
                        <th scope="col" class="px-6 py-3 font-medium">Description</th>
                        @can('admin-access')
                            <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facilities as $facility)
                        <tr class="bg-background border-default hover:bg-gray-300 border-b">
                            <td class="px-6 py-4">
                                {{ $facility->facility_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $facility->facility_type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $facility->base_fee }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $facility->capacity }} pax
                            </td>
                            <td class="px-6 py-4">
                                {{ $facility->description }}
                            </td>
                            @can('admin-access')
                                <td class="px-6 py-4">
                                    <a href="/facility/{{ $facility->id }}/edit"
                                        class="text-info font-medium hover:underline">Edit</a>
                                    <a href="/facility/{{ $facility->id }}"
                                        class="text-error font-medium hover:underline">Remove</a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>


        <dialog id="add-modal"
            class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-lg rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-lg font-semibold text-gray-900">Add Facility</h3>
                <button type="button" onclick="document.getElementById('add-modal').close()"
                    class="cursor-pointer rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div>
                <form action="/facility" method="POST" class="mt-1 space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="facility-name">Facility name:</x-input-label>
                        <x-text-input type="text" id="facility-name" name="facility_name" class="mt-1 w-full" />
                    </div>

                    <div>
                        <x-input-label for="facility-type">Facility type:</x-input-label>
                        <x-select-input name="category" id="facility-type" placeholder="Select a facility..."
                        :options="[
                        'court' => 'Court',
                        'clubhouse' => 'Clubhouse',
                        'hall' => 'Hall',
                        'pool' => 'Pool',
                        ]" />
                    </div>

                    <div>
                        <x-input-label for="description">Description:</x-input-label>
                        <x-textarea-input type="textarea" id="description" name="description" class="mt-1 w-full h-25 resize-none" placeholder="Enter a description...">Text</x-textarea-input>
                    </div>

                    <div>
                        <x-input-label for="reservation-type">Reservation Type:</x-input-label>
                        <x-select-input name="reservation_type" id="reservation-type" placeholder="Hourly"
                            :options="[
                                'hourly' => 'Hourly',
                                'block' => 'Block'
                            ]" />
                    </div>


                    <div>
                        <x-input-label for="base-fee">Base fee (per hour):</x-input-label>
                        <x-text-input type="number" inputmode="decimal" pattern="^\d+(\.\d{1,2})?$" placeholder="0.00"  id="base-fee" name="base_fee" min="1" class="mt-1 w-full" />
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <x-input-label for="start-time">Starting Hours:</x-input-label>
                            <x-text-input type="time" id="start-time" name="starting_time" class="mt-1 w-full" />
                        </div>
                        <div>
                            <x-input-label for="closing-time">Closing Hours:</x-input-label>
                            <x-text-input type="time" id="closing-time" name="closing_time" class="mt-1 w-full" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <x-input-label for="capacity">Maximum Capacity:</x-input-label>
                            <x-text-input type="text" id="capacity" name="capacity" min="1" class="mt-1 w-full" />
                        </div>
                        <div>
                            <x-input-label for="duration">Maximum Reservation Duration:</x-input-label>
                            <x-text-input type="number" id="duration" name="maximum_reservation_duration" min=1 class="mt-1 w-full" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="facility-status">Status:</x-input-label>
                        <x-select-input name="facility_status" id="facility-status" placeholder="Select status..."
                            :options="[
                                'Open' => 'Open',
                                'Under Maintenance' => 'Under Maintenance',
                                'Closed' => 'Closed'
                            ]" />
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
                        <x-secondary-button type="button" onclick="document.getElementById('add-modal').close()"
                            class="shadow-xs cursor-pointer rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cancel</x-secondary-button>
                        <x-primary-button type="submit">Submit</x-primary-button>
                    </div>
                </form>
            </div>
    </div>
    </dialog>
</x-app-layout>
