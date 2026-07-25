<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add Ons') }}
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

        <div>
            <div class="mb-4 flex items-center justify-end">
                <button onclick="document.getElementById('add-modal').showModal()"
                    class="shadow-xs bg-surface text-md text-text hover:bg-secondary-hover focus-visible:outline-secondary-subtle cursor-pointer rounded-md px-4 py-2 font-semibold hover:text-white focus-visible:outline-2 focus-visible:outline-offset-2">
                    Add New Add-on
                </button>
            </div>
            <div
                class="bg-surface-alt shadow-xs border-border-strong max-h-180 relative overflow-x-auto overflow-y-auto rounded-md border">
                <table class="text-body w-full text-left text-sm">
                    <thead
                        class="text-body bg-surface border-default-medium text-text sticky top-0 z-10 border-b text-sm">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Add-on Name</th>
                            <th scope="col" class="px-6 py-3 font-medium">Description</th>
                            <th scope="col" class="px-6 py-3 font-medium">Price</th>
                            <th scope="col" class="px-6 py-3 font-medium">Status</th>
                            <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="add_on-table-body">
                        @foreach ($add_ons as $add_on)
                            <tr class="bg-background border-default border-b hover:bg-gray-300">
                                <th scope="row" class="text-heading whitespace-nowrap px-6 py-4 font-medium">
                                    {{ $add_on->name }}
                                </th>
                                <td class="data-name px-6 py-4">
                                    {{ $add_on->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $add_on->price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $add_on->is_active }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('add-ons.edit', $add_on) }}"
                                        class="text-info font-medium hover:underline">Edit</a>
                                    @can('admin-access')
                                        <a href="{{ route('add-ons.show', $add_on) }}"
                                            class="text-error font-medium hover:underline">Remove</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <dialog id="add-modal"
            class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-lg rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-lg font-semibold text-gray-900">Add an Add-on</h3>
                <button type="button" onclick="document.getElementById('add-modal').close()"
                    class="cursor-pointer rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('add-ons.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf

                <div>
                    <x-input-label for="name">Add-on Name</x-input-label>
                    <x-text-input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 w-full"/>
                </div>

                <div>
                    <x-input-label for="description">Add-on Description</x-input-label>
                    <x-textarea-input type="text" name="description" id="description" value="{{ old('description') }}" class="mt-1 w-full resize-none"></x-textarea-input>
                </div>

                <div>
                    <x-input-label for="price">Add-on Price</x-input-label>
                    <x-text-input type="number" name="price" id="price" value="{{ old('price') }}"
                        placeholder="0.00" step="0.01"
                        class="mt-1 w-full"/>
                </div>

                <div>
                    <x-input-label for="status">Add-on Status</x-input-label>
                    <x-select-input name="is_active" id="status"
                        placeholder="Please select..."
                        :selected="old('is_active')"
                        :options="[
                            'Active'    => 'Active',
                            'Inactive'  => 'Inactive',
                        ]"/>
                    {{-- <x-text-input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 w-full"/> --}}
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
