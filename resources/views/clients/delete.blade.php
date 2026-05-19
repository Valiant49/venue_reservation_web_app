@isset($client)
<div>
    <h3>Are you sure you want to remove this client?</h3>
    <table>
        <tr>
            <th>Block No.</th>
            <th>Lot No.</th>
            <th>Street No.</th>
            <th>Name</th>
            <th>Contact No.</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>{{ $client->block_num }}</td>
            <td>{{ $client->lot_num }}</td>
            <td>{{ $client->street_num }}</td>
            <td>{{ $client->first_name }} {{ $client->middle_name}} {{ $client->last_name}}</td>
            <td>{{ $client->contact_num }}</td>
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
