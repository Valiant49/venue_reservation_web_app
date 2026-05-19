@isset($facility)
<div>
    <h3>Are you sure you want to delete this facility?</h3>
    <table>
        <tr>
            <th>Facility Code</th>
            <th>Name</th>
            <th>Type</th>
            <th>Base Fee</th>
            <th>Capacity</th>
            <th>Description</th>
        </tr>
        <tr>
            <td>{{ $facility->facility_code }}</td>
            <td>{{ $facility->facility_name }}</td>
            <td>{{ $facility->facility_type }}</td>
            <td>{{ $facility->base_fee }}</td>
            <td>{{ $facility->capacity }}</td>
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
