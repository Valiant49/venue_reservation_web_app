@isset($client)
    <div>
        <h3>Are you sure you want to remove this client?</h3>
        <table>
            <tr>
                <th>Block No.</th>
                <td>{{ $client->block_num }}</td>
            </tr>
            <tr>
                <th>Lot No.</th>
                <td>{{ $client->lot_num }}</td>
            </tr>
            <tr>
                <th>Street No.</th>
                <td>{{ $client->street_num }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $client->first_name }} {{ $client->middle_name }} {{ $client->last_name }}</td>
            </tr>
            <tr>
                <th>Contact No.</th>
                <td>{{ $client->contact_num }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $client->email }}</td>
            </tr>

        </table>

        <form action="/client/{{ $client->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Yes, Delete</button>
        </form>

        <a href="/client">Cancel</a>
    </div>
@endisset
