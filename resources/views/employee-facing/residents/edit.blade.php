<x-app-layout>
    @isset($resident)
        <div class="fixed inset-y-0 right-0 left-[350px] z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-xs">
            <dialog id="edit-modal" open
                class="open:animate-fade-in static w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl">
                <!-- Modal Header -->
                <div class="mb-5 flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="text-xl font-semibold text-gray-900">Edit Resident Details</h3>
                    <!-- Close Button (Redirects back to main list index since this is a separate file) -->
                    <a href="/residents"
                        class="cursor-pointer rounded-md p-1.5 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-500">
                        <span class="sr-only">Close</span>
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <!-- Global Error Alert Box -->
                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-red-100 bg-red-50 p-4">
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
                                <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">
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
                    <form action="{{ route('residents.update', $resident) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <!-- Section 1: Address Info (3-Column Layout Row) -->
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="block-no" >Block No.</x-input-label>
                                <x-text-input type="number" name="block_num" id="block-no" min="1" max="39"
                                    value="{{ old('block_num', $resident->block_num) }}"/>
                            </div>
                            <div>
                                <x-input-label for="lot-no">Lot No.</x-input-label>
                                <x-text-input type="number" name="lot_num" id="lot-no" min="1" max="300"
                                    value="{{ old('lot_num', $resident->lot_num) }}"/>
                            </div>
                            <div>
                                <x-input-label for="street-no">Street No.</x-input-label>
                                <x-text-input type="number" name="street_num" id="street-no" min="1" max="100"
                                    value="{{ old('street_num', $resident->street_num) }}"/>
                            </div>
                        </div>
                        <!-- Section 2: Name Information (2-Column Grid Layout) -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <x-input-label for="first-name">First Name</x-input-label>
                                <x-text-input type="text" name="first_name" id="first-name"
                                    value="{{ old('first_name', $resident->first_name) }}"/>
                            </div>
                            <div>
                                <x-input-label for="middle-name">Middle Name</x-input-label>
                                <x-text-input type="text" name="middle_name" id="middle-name"
                                    value="{{ old('middle_name', $resident->middle_name) }}"/>
                            </div>
                            <div>
                                <x-input-label for="last-name">Last Name</x-input-label>
                                <x-text-input type="text" name="last_name" id="last-name"
                                    value="{{ old('last_name', $resident->last_name) }}"/>
                            </div>
                        </div>
                        <!-- Password (Full width) -->
                         <div>
                                <x-input-label for="password">Password</x-input-label>
                                <x-text-input type="password" name="password" id="password"
                                    value="{{ old('password') }}"/>
                            </div>
                        <!-- Section 3: Contact Info (2-Column Grid Layout) -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <x-input-label for="contact-no">Contact No.</x-input-label>
                                <x-text-input type="tel" name="contact_num" id="contact-no"
                                    value="{{ old('contact_num', $resident->contact_num) }}"/>
                            </div>
                            <div>
                                <x-input-label for="email">Email Address</x-input-label>
                                <x-text-input type="email" name="email" id="email" value="{{ old('email', $resident->email) }}"/>
                            </div>
                        </div>
                        <!-- Modal Action Buttons Footer -->
                        <div class="mt-6 flex items-center justify-end space-x-3 border-t border-gray-100 pt-4">
                            <x-secondary-button onclick="location.href='{{ route('residents.index') }}'"
                                class="cursor-pointer rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cancel
                            </x-secondary-button>
                            <x-primary-button type="submit"
                                class="bg-secondary hover:bg-secondary-hover text-text cursor-pointer rounded-lg px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                                Update Resident
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </dialog>
        </div>
    @endisset
</x-app-layout>
