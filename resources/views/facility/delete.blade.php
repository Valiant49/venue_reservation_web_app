@isset($facility)
    <div>
        <h3>Are you sure you want to delete this facility?</h3>
        <table>
            <tr>
                <th>Facility Code</th>
                <td>{{ $facility->facility_code }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $facility->facility_name }}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{ $facility->facility_type }}</td>
            </tr>
            <tr>
                <th>Base Fee</th>
                <td>{{ $facility->base_fee }}</td>
            </tr>
            <tr>
                <th>Capacity</th>
                <td>{{ $facility->capacity }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $facility->description }}</td>
            </tr>
        </table>

        <form action="/facility/{{ $facility->facility_id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Yes, Delete</button>
        </form>

        <a href="/facility">Cancel</a>
    </div>
@endisset
