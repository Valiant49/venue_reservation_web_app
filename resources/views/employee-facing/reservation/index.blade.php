<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Reservations') }}
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



        <div x-data="reservationTable()" x-init="init()">

            {{-- Controls --}}
            <div class="mb-3 flex justify-between items-center gap-3">
                <div>
                    <select x-model="filters.status" @change="syncUrl()" class="bg-surface rounded-md border-gray-300 text-sm px-3 py-2 mr-2">
                        <option value="">All Statuses</option>
                        <option value="Pending">Pending</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                    <input type="text" x-model="filters.facility" @input.debounce.150ms="syncUrl()"
                        placeholder="Filter facility..." class="bg-surface px-3 py-2 mr-2 rounded-md border-gray-300 text-sm">
                    <input type="text" x-model="filters.resident" @input.debounce.150ms="syncUrl()"
                        placeholder="Filter resident..." class="bg-surface px-3 py-2 mr-2 rounded-md border-gray-300 text-sm">
                    <button @click="resetFilters()" class="bg-background text-primary text-sm hover:bg-primary-hover hover:text-white px-3 py-2 mr-2 rounded-md">
                        Clear filters
                    </button>
                </div>

                <div class="mb-4 flex items-center justify-end">
                    <button onclick="document.getElementById('add-modal').showModal()"
                        class="shadow-xs bg-surface text-md text-text hover:bg-secondary-hover focus-visible:outline-secondary-subtle cursor-pointer rounded-md px-4 py-2 font-semibold hover:text-white focus-visible:outline-2 focus-visible:outline-offset-2">
                        Add Reservation
                    </button>
                </div>
            </div>

            <div
                class="bg-surface-alt shadow-xs border-border-strong max-h-180 relative overflow-x-auto overflow-y-auto rounded-md border">
                <table class="text-body w-full table-fixed text-left text-sm">
                    <thead
                        class="text-body bg-surface border-default-medium text-text sticky top-0 z-10 border-b text-sm">
                        <tr>
                            <template x-for="col in columns" :key="col.key">
                                <th @click="sortBy(col.key)" class="cursor-pointer select-none px-3 py-3 font-medium">
                                    <span x-text="col.label"></span>
                                    <span x-show="sort.key === col.key" x-text="sort.dir === 'asc' ? '▲' : '▼'"></span>
                                </th>
                            </template>
                            <th class="px-3 py-3 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="row in filteredSorted" :key="row.id">
                            <tr class="bg-background border-default border-b hover:bg-gray-300">
                                <td class="px-3 py-4" x-text="row.facility"></td>
                                <td class="truncate px-3 py-4" x-text="row.resident"></td>
                                <td class="px-3 py-4" x-text="row.date_display"></td>
                                <td class="px-3 py-4" x-text="row.time_display"></td>
                                <td class="px-3 py-4" x-text="row.fee"></td>
                                <td class="px-3 py-4" x-text="row.status"></td>
                                <td class="px-3 py-4" x-text="row.event_type"></td>
                                <td class="max-w-3xs truncate px-3 py-4" x-text="row.notes"></td>
                                <td class="px-3 py-4">
                                    <a :href="editUrl(row.id)" class="text-info font-medium hover:underline">Edit</a>
                                    @can('admin-access')
                                        <a :href="destroyUrl(row.id)"
                                            class="text-error font-medium hover:underline">Remove</a>
                                    @endcan
                                </td>
                            </tr>
                        </template>
                        <tr x-show="filteredSorted.length === 0">
                            <td colspan="9" class="px-3 py-6 text-center text-gray-400">No matching reservations.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <dialog id="add-modal"
            class="backdrop:backdrop-blur-xs open:animate-fade-in inset-0 m-auto w-full max-w-3xl rounded-xl bg-white p-6 shadow-2xl backdrop:bg-gray-900/50">

            <!-- Modal Header -->
            <div class="mb-5 flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-xl font-semibold text-gray-900">Add Reservation</h3>
                <button type="button" onclick="document.getElementById('add-modal').close()"
                    class="cursor-pointer rounded-md p-1.5 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body & Form -->
            <div>
                <form action="{{ route('reservation.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Grid container for a clean 2-column desktop layout -->
                    <div class="flex">
                        <div class="flex-1">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <!-- Facility Field -->
                                <div>
                                    <label for="facility"
                                        class="mb-1 block text-sm font-medium text-gray-700">Facility</label>
                                    <select name="facility_id" id="facility"
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                        <option value="" disabled
                                            {{ old('facility_type') === null ? 'selected' : '' }}>
                                            Please select...</option>
                                        @foreach ($facilities as $facility)
                                            <option value="{{ $facility->id }}"
                                                {{ old('facility_type') == $facility->id ? 'selected' : '' }}
                                                data-fee="{{ $facility->base_fee }}"
                                                data-type="{{ $facility->reservation_type }}"
                                                data-capacity="{{ $facility->max_capacity }}"
                                                data-starting-hours="{{ $facility->starting_hours }}"
                                                data-closing-hours="{{ $facility->closing_hours }}"
                                                data-max-duration="{{ $facility->max_reservation_duration }}">
                                                {{ $facility->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Resident Name Field -->
                                <div>
                                    <label for="resident"
                                        class="mb-1 block text-sm font-medium text-gray-700">Resident
                                        Name</label>
                                    <select name="reserved_by" id="resident"
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                        <option value="" disabled {{ old('reserved_by') ? '' : 'selected' }}>
                                            Select a
                                            resident...</option>
                                        @foreach ($residents as $resident)
                                            <option value="{{ $resident->id }}"
                                                {{ old('reserved_by') == $resident->id ? 'selected' : '' }}>
                                                {{ $resident->last_name }}, {{ $resident->first_name }}
                                                {{ Str::limit($resident->middle_name, 1, '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('reserved_by')
                                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Guest Count Field -->
                                <div>
                                    <label for="guest-count"
                                        class="mb-1 block text-sm font-medium text-gray-700">Guest
                                        Count</label>
                                    <input type="number" name="guest_count" id="guest-count" min="1"
                                        value="{{ old('guest_count') }}"
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                    <p id="guest-warning" class="mt-1 text-xs font-medium text-red-600">
                                        @error('guest_count')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <!-- Reservation Date Field -->
                                <div>
                                    <label for="date"
                                        class="mb-1 block text-sm font-medium text-gray-700">Reservation
                                        Date</label>
                                    <input type="date" name="date" id="date" value="{{ old('date') }}"
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                    <p id="date-warning" class="mt-1 text-xs font-medium text-red-600">
                                        @error('date')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <!-- Start Time Field -->
                                <div>
                                    <label for="start-time" class="mb-1 block text-sm font-medium text-gray-700">Start
                                        Time</label>
                                    <input type="time" name="start_time" id="start-time"
                                        value="{{ old('start_time') }}"
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                    <p id="time-warning" class="mt-1 text-xs font-medium text-red-600">
                                        @error('start_time')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <!-- End Time Field -->
                                <div>
                                    <label for="end-time" class="mb-1 block text-sm font-medium text-gray-700">End
                                        Time</label>
                                    <input type="time" name="end_time" id="end-time"
                                        value="{{ old('end_time') }}"
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                    @error('end_time')
                                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Status Field -->
                                <div>
                                    <label for="status"
                                        class="mb-1 block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status"
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                        <option value="Pending"
                                            {{ old('status', 'Pending') == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Confirmed"
                                            {{ old('status') == 'Confirmed' ? 'selected' : '' }}>
                                            Confirmed</option>
                                        <option value="Cancelled"
                                            {{ old('status') == 'Cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Event Type Field -->
                                <div>
                                    <label for="event-type" class="mb-1 block text-sm font-medium text-gray-700">Event
                                        Type</label>
                                    <input type="text" name="event_type" id="event-type"
                                        value="{{ old('event_type') }}" placeholder="e.g. Seminar"
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                    @error('event_type')
                                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Fee Field -->
                                <div>
                                    <label for="fee"
                                        class="mb-1 block text-sm font-medium text-gray-700">Estimated Fee</label>
                                    <input type="text" id="estimated-fee" value="{{ old('total_fee') }}"
                                        placeholder="₱0.00" disabled
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                    @error('total_fee')
                                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <input type="hidden" name="total_fee" id="total-fee">
                                <!-- Duration Calculation -->
                                <div>
                                    <label for="fee"
                                        class="mb-1 block text-sm font-medium text-gray-700">Duration</label>
                                    <input type="text" id="duration" placeholder="e.g. 1 hr" disabled
                                        class="focus:border-secondary w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">
                                    <p class="mt-1 text-xs font-medium text-red-600" id="duration-warning"></p>
                                </div>
                            </div>
                            <!-- Notes Field (Spans full width) -->
                            <div>
                                <label for="notes"
                                    class="mb-1 block text-sm font-medium text-gray-700">Notes</label>
                                <textarea name="notes" id="notes" rows="2" placeholder="Provide additional reservation details..."
                                    class="focus:border-secondary h-25 w-full resize-none rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-none focus:ring-1">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div id="addons-container" class="flex-1 pl-4">
                            <x-input-label>Add-ons for this Facility</x-input-label>
                            <div class="max-h-60 overflow-y-auto pr-1">
                                @foreach ($facilities as $fac)
                                    @foreach ($fac->addOns as $addOn)
                                        <label
                                            class="addon-option bg-background m-2 flex hidden items-center gap-2 rounded px-4 py-3"
                                            data-facility-id="{{ $fac->id }}">
                                            <input type="checkbox" name="add_ons[]" value="{{ $addOn->id }}" data-price="{{ $addOn->price }}">
                                            <div class="flex flex-1 items-center justify-between">
                                                <span class="font-medium text-black/80">{{ $addOn->name }}</span>
                                                <span
                                                    class="text-black/80">(₱{{ number_format($addOn->price, 2) }})</span>
                                            </div>
                                        </label>
                                    @endforeach
                                @endforeach
                            </div>
                            <p id="no-addons-msg" class="hidden text-sm text-gray-400">No add-ons available for this
                                facility.</p>
                        </div>
                    </div>

                    <!-- Modal Action Buttons Footer -->
                    <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
                        <x-secondary-button type="button" onclick="document.getElementById('add-modal').close()"
                            class="shadow-xs cursor-pointer rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Cancel
                        </x-secondary-button>
                        <x-primary-button type="submit" id="form-submit">
                            Submit
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </dialog>
    </div>

    <script>
        function reservationTable() {
            return {
                columns: [
                    { key: 'facility', label: 'Facility Name' },
                    { key: 'resident', label: 'Resident Name' },
                    { key: 'date', label: 'Date' },
                    { key: 'time', label: 'Time' },
                    { key: 'fee', label: 'Fee' },
                    { key: 'status', label: 'Status' },
                    { key: 'event_type', label: 'Event Type' },
                    { key: 'notes', label: 'Notes' },
                ],

                rows: @json($tableData ?? []),

                filters: { status: '', facility: '', resident: '' },
                sort: { key: 'date', dir: 'asc' },

                init() {
                    const p = new URLSearchParams(window.location.search);
                    this.filters.status = p.get('status') || '';
                    this.filters.facility = p.get('facility') || '';
                    this.filters.resident = p.get('resident') || '';
                    this.sort.key = p.get('sort') || 'date';
                    this.sort.dir = p.get('dir') || 'asc';
                },

                syncUrl() {
                    const p = new URLSearchParams();
                    if (this.filters.status) p.set('status', this.filters.status);
                    if (this.filters.facility) p.set('facility', this.filters.facility);
                    if (this.filters.resident) p.set('resident', this.filters.resident);
                    p.set('sort', this.sort.key);
                    p.set('dir', this.sort.dir);
                    history.replaceState(null, '', '?' + p.toString());
                },

                resetFilters() {
                    this.filters = { status: '', facility: '', resident: '' };
                    this.syncUrl();
                },

                sortBy(key) {
                    if (this.sort.key === key) {
                        this.sort.dir = this.sort.dir === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.sort.key = key;
                        this.sort.dir = 'asc';
                    }
                    this.syncUrl();
                },

                get filteredSorted() {
                    let data = this.rows.filter(r =>
                        (!this.filters.status || r.status === this.filters.status) &&
                        (!this.filters.facility || r.facility.toLowerCase().includes(this.filters.facility.toLowerCase())) &&
                        (!this.filters.resident || r.resident.toLowerCase().includes(this.filters.resident.toLowerCase()))
                    );
                    const { key, dir } = this.sort;
                    data.sort((a, b) => {
                        let v1 = a[key], v2 = b[key];
                        if (typeof v1 === 'string') { v1 = v1.toLowerCase(); v2 = v2.toLowerCase(); }
                        if (v1 < v2) return dir === 'asc' ? -1 : 1;
                        if (v1 > v2) return dir === 'asc' ? 1 : -1;
                        return 0;
                    });
                    return data;
                },

                editUrl(id) {
                    return "{{ route('reservation.edit', ':id') }}".replace(':id', id);
                },
                destroyUrl(id) {
                    return "{{ route('reservation.destroy', ':id') }}".replace(':id', id);
                },
            }
        }
    </script>
</x-app-layout>
