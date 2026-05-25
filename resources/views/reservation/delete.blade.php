@isset($reservation)
    <div id="delete-modal">
        <h3>Are you sure you want to remove this reservation?</h3>

        <table>
            <tr>
                <th>Reservation Code</th>
                <td>{{ $reservation->reservation_code }}</td>
            </tr>
            <tr>
                <th>Facility</th>
                <td>{{ $reservation->facility->facility_name }}</td>
            </tr>
            <tr>
                <th>Client Name</th>
                <td>
                    {{ $reservation->client->last_name }},
                    {{ $reservation->client->first_name }}
                    {{ $reservation->client->middle_name }}
                </td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $reservation->reservation_date }}</td>
            </tr>
            <tr>
                <th>Time</th>
                <td>{{ $reservation->start_time }} to {{ $reservation->end_time }}</td>
            </tr>
            <tr>
                <th>Fee</th>
                <td>{{ $reservation->total_fee }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $reservation->status }}</td>
            </tr>
            <tr>
                <th>Event Type</th>
                <td>{{ $reservation->event_type }}</td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>{{ $reservation->notes }}</td>
            </tr>
        </table>

        <form action="">
            @csrf
            @method('DELETE')
            <button type="submit">Yes, Delete</button>
        </form>

        <a href="/reservation">Cancel</a>
    </div>
@endisset
