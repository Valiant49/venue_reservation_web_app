<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Residents') }}
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

        <div class="mb-4 flex items-center justify-between">
            <x-text-input type="text" id="table-search" class="bg-surface rounded-md px-4 py-2 max-w-80"
                placeholder="Search name..." />

            <button onclick="document.getElementById('add-modal').showModal()"
                class="shadow-xs bg-surface text-md text-text hover:bg-secondary-hover hover:text-white focus-visible:outline-secondary-subtle cursor-pointer rounded-md px-4 py-2 font-semibold focus-visible:outline-2 focus-visible:outline-offset-2">
                Add New Resident
            </button>
        </div>

        <div
            class="bg-surface-alt shadow-xs border-border-strong max-h-180 relative overflow-x-auto overflow-y-auto rounded-md border">
            <table class="text-body w-full text-left text-sm">
                <thead
                    class="text-body bg-surface border-default-medium text-text sticky top-0 z-10 border-b text-sm">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">Address</th>
                        <th scope="col" class="px-6 py-3 font-medium">Name</th>
                        <th scope="col" class="px-6 py-3 font-medium">Contact No.</th>
                        <th scope="col" class="px-6 py-3 font-medium">Email</th>
                        <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody id="resident-table-body">
                    @foreach ($residents as $resident)
                        <tr class="bg-background border-default hover:bg-gray-300 border-b">
                            <th scope="row" class="text-heading whitespace-nowrap px-6 py-4 font-medium">
                                Blk {{ $resident->block_num }}, Lot {{ $resident->lot_num }}, Street No. {{ $resident->street_num }}
                            </th>

                            <td class="data-name px-6 py-4">
                                {{ $resident->first_name }} {{ Str::limit($resident->middle_name, 1, '.') }}
                                {{ $resident->last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $resident->contact_num }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $resident->email }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="/residents/{{ $resident->id }}/edit"
                                    class="text-info font-medium hover:underline">Edit</a>
                                @can('admin-access')
                                    <a href="/residents/{{ $resident->id }}"
                                        class="text-error font-medium hover:underline">Remove</a>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <br>

        <dialog id="add-modal"
            class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-lg rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-lg font-semibold text-gray-900">Add Resident</h3>
                <button type="button" onclick="document.getElementById('add-modal').close()"
                    class="cursor-pointer rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="/residents" method="POST" class="mt-4 space-y-4">
                @csrf

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="block-no">Block No.: </x-input-label>
                        <x-text-input type="number" name="block_num" id="block-no" min="1" max="39"
                            value="{{ old('block_num') }}" required class="mt-1 w-full" />
                    </div>
                    <div>
                        <x-input-label for="lot-no">Lot No.: </x-input-label>
                        <x-text-input type="number" name="lot_num" id="lot-no" min="1" max="300"
                            value="{{ old('lot_num') }}" required class="mt-1 w-full" />
                    </div>
                    <div>
                        <x-input-label for="street-no">Street No.: </x-input-label>
                        <x-text-input type="number" name="street_num" id="street-no" min="1" max="100"
                            value="{{ old('street_num') }}" required class="mt-1 w-full" />
                    </div>
                </div>

                <div>
                    <x-input-label for="first-name">First Name: </x-input-label>
                    <x-text-input type="text" name="first_name" id="first-name" value="{{ old('first_name') }}"
                        required class="mt-1 w-full" />
                </div>

                <div>
                    <x-input-label for="middle-name">Middle Name: </x-input-label>
                    <x-text-input type="text" name="middle_name" id="middle-name" value="{{ old('middle_name') }}"
                        class="mt-1 w-full" />
                </div>

                <div>
                    <x-input-label for="last-name">Last Name: </x-input-label>
                    <x-text-input type="text" name="last_name" id="last-name" value="{{ old('last_name') }}"
                        required class="mt-1 w-full" />
                </div>

                <div>
                    <x-input-label for="password">Password: </x-input-label>
                    <x-text-input type="password" name="password" id="password"
                    value="{{ old('password') }}" required class="mt-1 w-full" />
                </div>

                {{-- Contact Information --}}
                <div>
                    <x-input-label for="contact-no">Contact No.: </x-input-label>
                    <x-text-input type="tel" name="contact_num" id="contact-no"
                        value="{{ old('contact_num') }}" required class="mt-1 w-full" />
                </div>

                <div>
                    <x-input-label for="email">Email: </x-input-label>
                    <x-text-input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="mt-1 w-full" />
                </div>

                <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
                    <x-secondary-button type="button" onclick="document.getElementById('add-modal').close()"
                        class="shadow-xs cursor-pointer rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        Submit
                    </x-primary-button>
                </div>

            </form>
        </dialog>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('table-search');
            const tableBody = document.getElementById('resident-table-body');
            const rows = tableBody.getElementsByTagName('tr');

            searchInput.addEventListener('input', function() {
                const filterValue = searchInput.value.toLowerCase().trim();

                // Loop through all table rows
                for (let i = 0; i < rows.length; i++) {
                    // Find the specific column containing the name
                    const nameColumn = rows[i].querySelector('.data-name');

                    if (nameColumn) {
                        const nameText = nameColumn.textContent || nameColumn.innerText;

                        // If the typed text matches part of the name, show row; otherwise hide it
                        if (nameText.toLowerCase().includes(filterValue)) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
