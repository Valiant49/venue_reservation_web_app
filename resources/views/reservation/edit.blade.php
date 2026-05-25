@isset($reservation)
    <div id="edit-modal">
        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="/reservation/{{ $reservation->id }}" method="POST">
            @csrf
            @method('PUT')
            <label for="facility">Facility: </label>
            <select name="facility_id" id="facility">
                <option value="" disabled {{ old('facility_type') === null ? 'selected' : '' }}>Please select...
                </option>
                @foreach ($facilities as $facility)
                    <option value="{{ $facility->id }}" {{ $reservation->facility_id == $facility->id ? 'selected' : '' }}>
                        {{ $facility->facility_name }} </option>
                @endforeach
            </select>
            <br>

            <label for="client">Client Name: (temp)</label>
            <select name="reserved_by" id="client">
                <option value="" disabled {{ old('reserved_by') ? '' : 'selected' }}>Select a client...</option>
                @foreach ($clients as $client)
                    {{-- temp functionality for now --}}
                    <option value="{{ $client->id }}" {{ $reservation->reserved_by == $client->id ? 'selected' : '' }}>
                        {{ $client->last_name }}, {{ $client->first_name }} {{ Str::limit($client->middle_name, 1, '.') }}
                    </option>
                @endforeach
            </select>
            @error('reserved_by')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <br>

            <label for="guest-count">Guest Count: </label>
            <input type="number" name="guest_count" id="guest-count" min="1" value="{{ $reservation->guest_count }}">
            @error('guest_count')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <br>

            <label for="date">Reservation Date: </label>
            <input type="date" name="reservation_date" id="date" value="{{ $reservation->reservation_date }}">
            @error('reservation_date')
                <span style="color:red;"> {{ $message }} </span>
            @enderror
            <br>

            <label for="start-time">Start Time: </label>
            <input type="time" name="start_time" id="start-time" value="{{ $reservation->start_time }}">
            @error('end_time')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <br>

            <label for="end-time">End Time: </label>
            <input type="time" name="end_time" id="end-time" value="{{ $reservation->end_time }}">
            @error('end_time')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <br>

            <label for="status">Status: </label>
            <select name="status" id="status">
                <option value="Pending" {{ $reservation->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Confirmed" {{ $reservation->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="Cancelled" {{ $reservation->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            @error('status')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <br>

            <label for="fee">Fee: </label>
            <input type="text" name="total_fee" id="fee" value="{{ $reservation->total_fee }}">
            @error('total_fee')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <br>

            <label for="event-type">Event Type: </label>
            <input type="text" name="event_type" id="event-type" value="{{ $reservation->event_type }}">
            @error('event_type')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <br>

            <label for="notes">Notes: </label>
            <input type="text" name="notes" id="notes" value="{{ $reservation->notes }}">
            @error('notes')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <br>

            <label for="facilitated-by">Facilitated By: </label>
            <select name="facilitated_by" id="facilitated-by">
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ $reservation->facilitated_by == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }} </option>
                @endforeach
            </select>
            @error('facilitated_by')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <br>

            <button type="reset">Reset</button>
            <button type="submit">Submit</button>

        </form>
    </div>
@endisset
