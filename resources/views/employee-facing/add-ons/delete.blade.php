<x-app-layout>
    @isset($add_on)
        <div class="flex min-h-screen items-center justify-center">

            <div class="w-full max-w-xl rounded-xl bg-white p-6 shadow-2xl">

                {{-- Warning Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="red"
                    class="mx-auto size-24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />

                </svg>

                <h3 class="mb-6 text-center text-xl font-semibold">
                    Are you sure you want to remove this add-on?
                </h3>

                {{-- Details --}}
                <div class="bg-surface-alt border-border-strong shadow-xs mb-6 overflow-hidden rounded-md border">

                    <table class="w-full text-left text-sm">
                        <tbody>

                            <tr>
                                <th class="bg-primary w-1/3 px-4 py-3 text-right font-medium text-white">
                                    Add-on Name
                                </th>
                                <td class="text-body px-4 py-3">
                                    {{ $add_on->name }}
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-primary px-4 py-3 text-right font-medium text-white">
                                    Description
                                </th>
                                <td class="text-body px-4 py-3">
                                    {{ $add_on->description }}
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-primary px-4 py-3 text-right font-medium text-white">
                                    Price
                                </th>
                                <td class="text-body px-4 py-3">
                                    ₱{{ number_format($add_on->price, 2) }}
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-primary px-4 py-3 text-right font-medium text-white">
                                    Status
                                </th>
                                <td class="text-body px-4 py-3">
                                    {{ $add_on->is_active }}
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

                {{-- Footer --}}
                <div class="flex justify-end gap-3">

                    <a href="{{ route('add-ons.index') }}">
                        <x-primary-button type="button">
                            Cancel
                        </x-primary-button>
                    </a>

                    <form action="{{ route('add-ons.destroy', $add_on) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <x-secondary-button type="submit">
                            Yes, Delete
                        </x-secondary-button>

                    </form>

                </div>

            </div>

        </div>
    @endisset
</x-app-layout>
