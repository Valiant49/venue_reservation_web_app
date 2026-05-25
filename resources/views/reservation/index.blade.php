<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sunshine City | Reservation</title>
</head>

<body>
    <h1>Reservations</h1>

    <p>Navigation</p>
    <ul>
        <li><a href="/dashboard">Dashboard</a></li>
        <li><a href="/client">Clients</a></li>
        <li><a href="/facility">Facilities</a></li>
        <li><a href="/reservation">Reservations</a></li>
    </ul>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Reservations</h2>

    <table>
        <tr>
            <th style="border: black solid 2px">Reservation Code</th>
            <th style="border: black solid 2px">Facility</th>
            <th style="border: black solid 2px">Client Name</th>
            <th style="border: black solid 2px">Date</th>
            <th style="border: black solid 2px">Time</th>
            <th style="border: black solid 2px">Fee</th>
            <th style="border: black solid 2px">Status</th>
            <th style="border: black solid 2px">Event Type</th>
            <th style="border: black solid 2px">Notes</th>
            <th style="border: black solid 2px">Actions</th>
        </tr>
        @foreach ($reservations as $reservation)
            <tr>
                <td> {{ $reservation->reservation_code }} </td>
                <td> {{ $reservation->facility->facility_name ?? "N/A" }} </td>
                <td>
                    {{ $reservation->client->last_name }},
                    {{ $reservation->client->first_name }}
                    {{ Str::limit($reservation->client->middle_name, 1, '.') }}
                </td>
                <td> {{ $reservation->reservation_date }} </td>
                <td> {{ $reservation->start_time }} to {{ $reservation->end_time }} </td>
                <td> {{ $reservation->total_fee }} </td>
                <td> {{ $reservation->status }} </td>
                <td> {{ $reservation->event_type }} </td>
                <td> {{ $reservation->notes }} </td>
                <td>
                    <a href="/reservation/{{ $reservation->id }}/edit">Edit</a>
                    <a href="/reservation/{{ $reservation->id }}">Remove</a>
                </td>
            </tr>
        @endforeach
    </table>

    <br>

    <h2>CRUD Operations</h2>
    <h3>Add Reservation</h3>
    <div id="add-modal">
        <form action="/reservation" method="POST">
            @csrf
                <label for="facility">Facility: </label>
                <select name="facility_id" id="facility">
                    <option value="" disabled {{ old('facility_type') === null ?  'selected' : '' }}>Please select...</option>
                    @foreach ($facilities as $facility)
                        <option value="{{ $facility->id }}" {{ old('facility_type') == $facility->id ? 'selected' : '' }}> {{ $facility->facility_name }} </option>
                    @endforeach
                </select>
                <br>

                <label for="client">Client Name: (temp)</label>
                <select name="reserved_by" id="client">
                    <option value="" disabled {{ old('reserved_by') ? '' : 'selected' }}>Select a client...</option>
                    @foreach ($clients as $client) {{-- temp functionality for now --}}
                        <option value="{{ $client->id }}" {{ old('reserved_by') == $client->id ? 'selected' : '' }}>
                            {{ $client->last_name }}, {{ $client->first_name }} {{ Str::limit($client->middle_name, 1, '.') }}
                        </option>
                    @endforeach
                </select>
                @error('reserved_by') <span style="color: red;">{{ $message }}</span> @enderror
                <br>

                <label for="guest-count">Guest Count: </label>
                <input type="number" name="guest_count" id="guest-count" min="1" value="{{ old('guest_count') }}">
                @error('guest_count') <span style="color: red;">{{ $message }}</span> @enderror
                <br>

                <label for="date">Reservation Date: </label>
                <input type="date" name="reservation_date" id="date" value="{{ old('reservation_date') }}">
                @error('reservation_date') <span style="color:red;"> {{ $message }} </span> @enderror
                <br>

                <label for="start-time">Start Time: </label>
                <input type="time" name="start_time" id="start-time" value="{{ old('start_time') }}">
                @error('end_time') <span style="color: red;">{{ $message }}</span> @enderror
                <br>

                <label for="end-time">End Time: </label>
                <input type="time" name="end_time" id="end-time" value="{{ old('end_time') }}">
                @error('end_time') <span style="color: red;">{{ $message }}</span> @enderror
                <br>

                <label for="status">Status: </label>
                <select name="status" id="status">
                    <option value="Pending" {{ old('status', 'Pending') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Confirmed" {{ old('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status') <span style="color: red;">{{ $message }}</span> @enderror
                <br>

                <label for="fee">Fee: </label>
                <input type="text" name="total_fee" id="fee" value="{{ old('total_fee') }}">
                @error('total_fee') <span style="color: red;">{{ $message }}</span> @enderror
                <br>

                <label for="event-type">Event Type: </label>
                <input type="text" name="event_type" id="event-type" value="{{ old('event_type') }}">
                @error('event_type') <span style="color: red;">{{ $message }}</span> @enderror
                <br>

                <label for="notes">Notes: </label>
                <input type="text" name="notes" id="notes" value="{{ old('notes') }}">
                @error('notes') <span style="color: red;">{{ $message }}</span> @enderror
                <br>

                <label for="facilitated-by">Facilitated By: </label>
                <select name="facilitated_by" id="facilitated-by">
                    @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}> {{ $staff->name }} </option>
                    @endforeach
                </select>
                @error('facilitated_by') <span style="color: red;">{{ $message }}</span> @enderror
                <br>

                <button type="reset">Reset</button>
                <button type="submit">Submit</button>

        </form>
    </div>
</body>

</html>
