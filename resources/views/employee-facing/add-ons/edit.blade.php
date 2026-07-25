<x-app-layout>
    @isset($add_on)
        <div
            class="backdrop-blur-xs fixed inset-y-0 left-[350px] right-0 z-50 flex items-center justify-center bg-gray-900/50">

            <dialog id="edit-modal" open
                class="open:animate-fade-in static w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl">

                {{-- Header --}}
                <div class="mb-5 flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit Add-on
                    </h3>

                    <a href="{{ route('add-ons.index') }}"
                        class="cursor-pointer rounded-md p-1.5 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-500">

                        <span class="sr-only">Close</span>

                        <svg class="size-5" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-red-100 bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Please correct the following errors:
                                </h3>

                                <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('add-ons.update', $add_on) }}"
                    method="POST"
                    class="space-y-4">

                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name">
                            Add-on Name
                        </x-input-label>

                        <x-text-input
                            id="name"
                            name="name"
                            type="text"
                            class="mt-1 w-full"
                            value="{{ old('name', $add_on->name) }}" />
                    </div>

                    <div>
                        <x-input-label for="description">
                            Description
                        </x-input-label>

                        <x-textarea-input
                            id="description"
                            name="description"
                            class="mt-1 h-24 w-full resize-none">{{ old('description', $add_on->description) }}</x-textarea-input>
                    </div>

                    <div>
                        <x-input-label for="price">
                            Price
                        </x-input-label>

                        <x-text-input
                            id="price"
                            name="price"
                            type="number"
                            step="0.01"
                            placeholder="0.00"
                            class="mt-1 w-full"
                            value="{{ old('price', $add_on->price) }}" />
                    </div>

                    <div>
                        <x-input-label for="status">
                            Status
                        </x-input-label>

                        <x-select-input
                            id="status"
                            name="is_active"
                            placeholder="Please select..."
                            :selected="old('is_active', $add_on->is_active)"
                            :options="[
                                'Active' => 'Active',
                                'Inactive' => 'Inactive',
                            ]" />
                    </div>

                    {{-- Footer --}}
                    <div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-100 pt-4">

                        <x-secondary-button
                            type="button"
                            onclick="location.href='{{ route('add-ons.index') }}'"
                            class="cursor-pointer">

                            Cancel

                        </x-secondary-button>

                        <x-primary-button
                            type="submit"
                            class="cursor-pointer">

                            Update Add-on

                        </x-primary-button>

                    </div>

                </form>

            </dialog>

        </div>
    @endisset
</x-app-layout>
