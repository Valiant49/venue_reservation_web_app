<x-app-layout>
@isset($facility)
    <dialog id="edit-modal" open
        class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

        {{-- Modal Header --}}
        <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Edit Facility Details</h3>
            <a href="/facility"
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
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
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
        <form action="/facility/{{ $facility->id }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Row 1: Code + Type (2 columns) --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="edit-fac-code" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Facility Code</label>
                    <input type="text" id="edit-fac-code" name="facility_code" value="{{ old('facility_code', $facility->facility_code) }}"
                        class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                </div>
                <div>
                    <label for="edit-fac-type" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Facility Type</label>
                    <select id="edit-fac-type" name="facility_type"
                        class="w-full rounded-md border border-gray-300 px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-white">
                        <option value="" disabled {{ !old('facility_type', $facility->facility_type) ? 'selected' : '' }}>Please select...</option>
                        <option value="clubhouse"  {{ (old('facility_type', $facility->facility_type)) == 'clubhouse'   ? 'selected' : '' }}>Clubhouse</option>
                        <option value="pool"       {{ (old('facility_type', $facility->facility_type)) == 'pool'        ? 'selected' : '' }}>Pool</option>
                        <option value="basketball" {{ (old('facility_type', $facility->facility_type)) == 'basketball'  ? 'selected' : '' }}>Basketball</option>
                        <option value="volleyball" {{ (old('facility_type', $facility->facility_type)) == 'volleyball'  ? 'selected' : '' }}>Volleyball</option>
                        <option value="badminton"  {{ (old('facility_type', $facility->facility_type)) == 'badminton'   ? 'selected' : '' }}>Badminton</option>
                    </select>
                </div>
            </div>

            {{-- Facility Name (full width) --}}
            <div>
                <label for="edit-fac-name" class="block text-sm font-medium text-gray-700 mb-1">Facility Name</label>
                <input type="text" id="edit-fac-name" name="facility_name" value="{{ old('facility_name', $facility->facility_name) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>

            {{-- Row 2: Base Fee + Capacity --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="base-fee" class="block text-sm font-medium text-gray-700 mb-1">Base Fee</label>
                    <input type="number" id="base-fee" name="base_fee" value="{{ old('base_fee', $facility->base_fee) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
                    <input type="text" id="capacity" name="capacity" value="{{ old('capacity', $facility->capacity) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>
            </div>

            {{-- Description (full width) --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <input type="text" id="description" name="description" value="{{ old('description', $facility->description) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>

            {{-- Footer Buttons --}}
            <div class="flex items-center justify-end space-x-3 border-t border-gray-100 pt-4 mt-6">
                <x-secondary-button onclick="location.href='/facility'"
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
@endisset
</x-app-layout>
