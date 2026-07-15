<x-app-layout>
@isset($staff)
    <dialog id="edit-modal" open
        class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

        {{-- Modal Header --}}
        <div class="mb-5 flex items-center justify-between border-b border-gray-100 pb-4">
            <h3 class="text-xl font-semibold text-gray-900">Edit Staff Details</h3>
            <a href="{{ route('staff.index') }}"
                class="cursor-pointer rounded-md p-1.5 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray:500">
                <span class="sr-only">Close</span>
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        {{-- Error Alert --}}
        @if($errors->any())
            <div class="mb-4 rounded-lg border border-red-100 bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                        <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form --}}
        <form action="/staff/{{ $staff->id }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Name + Email --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $staff->name) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $staff->email) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                    <span class="ml-1 font-normal text-gray-400">(leave blank to keep current)</span>
                </label>
                <input type="password" name="password" id="password" autocomplete="new-password"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <div class="flex gap-3">
                    @foreach(['admin', 'staff'] as $role)
                        <label
                            class="flex flex-1 cursor-pointer items-center gap-3 rounded-lg border px-4 py-3 text-sm transition duration-150
                                {{ old('role', $staff->role) == $role
                                    ? 'border-[var(--color-border-focus)] bg-[var(--color-primary-subtle)] text-[var(--color-text)]'
                                    : 'border-gray-200 bg-white text-gray-600 hover:border-gray-300 hover:bg-gray-50' }}">
                            <input
                                type="radio"
                                name="role"
                                value="{{ $role }}"
                                {{ old('role', $staff->role) == $role ? 'checked' : '' }}
                                class="accent-[var(--color-primary)]">
                            <div>
                                <p class="font-medium capitalize">{{ $role }}</p>
                                <p class="text-xs text-gray-400">
                                    {{ $role === 'admin' ? 'Full system access' : 'Standard access only' }}
                                </p>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('role')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Footer Buttons --}}
            <div class="mt-6 flex items-center justify-end space-x-3 border-t border-gray-100 pt-4">
                <a href="{{ route('staff.index') }}">
                    <x-secondary-button type="button"
                        class="cursor-pointer rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Cancel
                    </x-secondary-button>
                </a>
                <x-primary-button type="submit"
                    class="cursor-pointer rounded-lg px-4 py-2 bg-secondary hover:bg-secondary-hover text-sm font-medium text-text shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                    Update Staff
                </x-primary-button>
            </div>
        </form>

    </dialog>
@endisset
</x-app-layout>
