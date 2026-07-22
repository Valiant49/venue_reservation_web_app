<html>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="flex min-h-screen items-center justify-center bg-[#1B3A52] px-4 py-8">
    {{-- Card Container --}}
    <div class="w-full max-w-3xl overflow-hidden rounded-lg bg-white shadow-xl">

        {{-- x-data wrapper takes full width --}}
        <div x-data="{ step: {{ $errors->any() ? 2 : 1 }} }" class="w-full p-6 md:p-8">
            <form method="POST" action="{{ route('resident.register.store') }}" class="w-full space-y-4">
                @csrf

                {{-- STEP 1: Personal Info & Address --}}
                <div x-show="step === 1" class="space-y-4">
                    {{-- Validation Summary Alert --}}
                        @if ($errors->any())
                            <div class="mb-6 rounded-md bg-red-50 p-4 border-l-4 border-red-500 shadow-sm transition-all" id="error-summary">
                                <div class="flex items-start">
                                    <div class="shrink-0">
                                        {{-- Alert Icon --}}
                                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-semibold text-red-800">
                                            Please correct the following errors:
                                        </h3>
                                        <ul class="mt-2 text-xs text-red-700 list-disc list-inside space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                    <h3 class="text-xl font-bold text-gray-800">Step 1: Personal & Address Details</h3>

                    {{-- Names Row --}}
                    <div>
                        <x-input-label>First Name</x-input-label>
                        <x-text-input type="text" name="first_name" placeholder="Juan" value="{{ old('first_name') }}" class="w-full mb-5" />

                        <x-input-label>Middle Name</x-input-label>
                        <x-text-input type="text" name="middle_name" placeholder="Santos" value="{{ old('middle_name') }}" class="w-full mb-5" />

                        <x-input-label>Last Name</x-input-label>
                        <x-text-input type="text" name="last_name" placeholder="Dela Cruz" value="{{ old('last_name') }}" class="w-full mb-5" />

                        <x-input-label>Contact Number</x-input-label>
                        <x-text-input type="text" name="contact_num" placeholder="0911 222 3333" value="{{ old('contact_num') }}" class="w-full mb-5" />
                    </div>

                    {{-- Property Info Row --}}
                    <div class="grid grid-cols-3 gap-3">

                        <div>
                            <x-input-label>Block Number</x-input-label>
                            <x-text-input type="number" name="block_num"  value="{{ old('block_num') }}" class="w-full" />
                        </div>

                        <div>
                            <x-input-label>Lot Number</x-input-label>
                            <x-text-input type="number" name="lot_num" value="{{ old('lot_num') }}" class="w-full" />
                        </div>

                        <div>
                            <x-input-label>Street Number</x-input-label>
                            <x-text-input type="number" name="street_num" placeholder="5" value="{{ old('street_num') }}" class="w-full" />
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="button" @click="step = 2" class="rounded bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700 transition">
                            Next: Account Details &rarr;
                        </button>
                    </div>
                </div>

                {{-- STEP 2: Account Credentials --}}
                <div x-show="step === 2" x-cloak class="space-y-4">
                        @if ($errors->any())
                            <div class="mb-6 rounded-md bg-red-50 p-4 border-l-4 border-red-500 shadow-sm transition-all" id="error-summary">
                                <div class="flex items-start">
                                    <div class="shrink-0">
                                        {{-- Alert Icon --}}
                                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-semibold text-red-800">
                                            Please correct the following errors:
                                        </h3>
                                        <ul class="mt-2 text-xs text-red-700 list-disc list-inside space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    <h3 class="text-xl font-bold text-gray-800">Step 2: Account Credentials</h3>

                    <div class="space-y-3">
                        <div>
                            <x-text-input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full" />
                        </div>
                        <div>
                            <x-text-input type="password" name="password" placeholder="Password" class="w-full" />
                        </div>
                        <div>
                            <x-text-input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full" />
                        </div>
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" @click="step = 1" class="rounded bg-gray-500 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-600 transition">
                            &larr; Back
                        </button>
                        <button type="submit" class="rounded bg-success px-5 py-2.5 text-sm font-semibold text-white hover:bg-green-700 transition">
                            Complete Sign Up
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

</html>
