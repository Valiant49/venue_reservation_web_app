<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Staff') }}
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
                Add New Staff
            </button>
        </div>

        <div
            class="bg-surface-alt shadow-xs border-border-strong max-h-180 relative overflow-x-auto overflow-y-auto rounded-md border">
            <table class="text-body w-full text-left text-sm">
                <thead
                     class="text-body bg-surface border-default-medium text-text sticky top-0 z-10 border-b text-sm">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">Name</th>
                        <th scope="col" class="px-6 py-3 font-medium">Email</th>
                        <th scope="col" class="px-6 py-3 font-medium">Role</th>
                        <th scope="col" class="px-6 py-3 font-medium">Created At</th>
                        <th scope="col" class="px-6 py-3 font-medium">Updated At</th>
                        @can('admin-access')
                        <th scope="col" class="px-6 py-3 font-medium">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody id="staff-table-body">
                    @foreach ($staffs as $staff)
                        <tr class="bg-background border-default hover:bg-gray-300 border-b">
                            <td scope="row" class="whitespace-nowrap px-6 py-4">
                                {{ $staff->first_name }} {{ Str::limit($staff->middle_name, 1, '.')}} {{ $staff->last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $staff->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $staff->role }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $staff->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $staff->updated_at }}
                            </td>
                            @can('admin-access')
                                <td class="px-6 py-4">
                                    <a href="/staff/{{ $staff->id }}/edit"
                                        class="text-info font-medium hover:underline">Edit</a>
                                    <a href="/staff/{{ $staff->id }}"
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
                <h3 class="text-lg font-semibold text-gray-900">Add Staff</h3>
                <button type="button" onclick="document.getElementById('add-modal').close()"
                    class="cursor-pointer rounded-md p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="/staff" method="POST" class="mt-4 space-y-4">
                @csrf
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="first-name">First Name</x-input-label>
                        <x-text-input type="text" name="first_name" id="first-name" value="{{ old('first_name') }}" required
                            class="mt-1 w-full" />
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <x-input-label for="middle-name">Middle Name</x-input-label>
                        <x-text-input type="text" name="middle_name" id="middle-name" value="{{ old('middle_name') }}"
                            class="mt-1 w-full" />
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <x-input-label for="last-name">Last Name</x-input-label>
                        <x-text-input type="text" name="last_name" id="last-name" value="{{ old('last_name') }}" required
                            class="mt-1 w-full" />
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <x-input-label for="email">Email Address</x-input-label>
                    <x-text-input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="mt-1 w-full" />
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-input-label for="password">Password</x-input-label>
                    <x-text-input type="password" name="password" id="password" autocomplete="new-password" required
                        class="mt-1 w-full" />
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-input-label>Role</x-input-label>
                    <div class="mt-2 flex gap-3">
                        @foreach (['admin', 'staff'] as $role)
                            <label
                                class="{{ old('role') == $role
                                    ? 'border-[var(--color-border-focus)] bg-[var(--color-primary-subtle)] text-[var(--color-text)]'
                                    : 'border-gray-200 bg-white text-gray-600 hover:border-gray-300 hover:bg-gray-50' }} flex flex-1 cursor-pointer items-center gap-3 rounded-lg border px-4 py-3 text-sm transition duration-150">
                                <input type="radio" name="role" value="{{ $role }}"
                                    {{ old('role') == $role ? 'checked' : '' }} class="accent-[var(--color-primary)]">
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
</x-app-layout>
