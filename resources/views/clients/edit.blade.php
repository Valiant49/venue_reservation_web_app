<x-app-layout>
    @isset($client) {{-- Changed from $clients to $client to match your variable usage --}}
        <dialog id="edit-modal" open
            class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                <h3 class="text-xl font-semibold text-gray-900">Edit Client Details</h3>

                <!-- Close Button (Redirects back to main list index since this is a separate file) -->
                <a href="/client"
                    class="cursor-pointer rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-500 transition-colors">
                    <span class="sr-only">Close</span>
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            <!-- Global Error Alert Box -->
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 p-4 border border-red-100">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Modal Body & Form -->
            <div>
                <form action="/client/{{ $client->id }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Section 1: Address Info (3-Column Layout Row) -->
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="block-no" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Block No.</label>
                            <input type="number" name="block_num" id="block-no" min="1" max="39" value="{{ old('block_num', $client->block_num) }}"
                                class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label for="lot-no" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Lot No.</label>
                            <input type="number" name="lot_num" id="lot-no" min="1" max="300" value="{{ old('lot_num', $client->lot_num) }}"
                                class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label for="street-no" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Street No.</label>
                            <input type="number" name="street_num" id="street-no" min="1" max="100" value="{{ old('street_num', $client->street_num) }}"
                                class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                        </div>
                    </div>

                    <!-- Section 2: Name Information (2-Column Grid Layout) -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="first_name" id="first-name" value="{{ old('first_name', $client->first_name) }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="last_name" id="last-name" value="{{ old('last_name', $client->last_name) }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Middle Name (Full width) -->
                    <div>
                        <label for="middle-name" class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                        <input type="text" name="middle_name" id="middle-name" value="{{ old('middle_name', $client->middle_name) }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    </div>

                    <!-- Section 3: Contact Info (2-Column Grid Layout) -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="contact-no" class="block text-sm font-medium text-gray-700 mb-1">Contact No.</label>
                            <input type="tel" name="contact_num" id="contact-no" value="{{ old('contact_num', $client->contact_num) }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        </div>
                    </div>`

                    <!-- Modal Action Buttons Footer -->
                    <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-4 mt-6">
                        <x-secondary-button onclick="location.href='/client'"
                            class="cursor-pointer rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Cancel
                        </x-secondary-button>
                        <x-primary-button type="submit"
                            class="cursor-pointer rounded-lg px-4 py-2 bg-secondary hover:bg-secondary-hover text-sm font-medium text-text shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                            Update Client
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </dialog>
    @endisset
</x-app-layout>
