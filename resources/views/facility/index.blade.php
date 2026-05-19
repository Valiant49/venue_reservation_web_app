<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sunshine CIty | Facilities</title>
</head>

<body>
    <h1>Facilities</h1>

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

    <h2>Facilities Available</h2>
    <table>
        <tr>
            <th style="border: black solid 2px">Facility ID</th>
            <th style="border: black solid 2px">Facility Code</th>
            <th style="border: black solid 2px">Name</th>
            <th style="border: black solid 2px">Type</th>
            <th style="border: black solid 2px">Base fee</th>
            <th style="border: black solid 2px">Capacity</th>
            <th style="border: black solid 2px">Description</th>
            <th style="border: black solid 2px">Actions</th>
        </tr>
        @foreach ($facilities as $facility)
            <tr>
                <td>{{ $facility->id }}</td>
                <td>{{ $facility->facility_code }}</td>
                <td>{{ $facility->facility_name }}</td>
                <td>{{ $facility->facility_type }}</td>
                <td>{{ $facility->base_fee }}</td>
                <td>{{ $facility->capacity }} pax</td>
                <td>{{ $facility->description }}</td>
                <td>
                    <a href="/facility/{{ $facility->id }}/edit">Edit</a>
                    <a href="/facility/{{ $facility->id }}">Remove</a>
                </td>
            </tr>
        @endforeach
    </table>

    <br>

    <h2>CRUD Operations</h2>
    <h3>Add Facility</h3>
    <div id="add-modal">
        <form action="/facility" method="POST">
            @csrf
            <label for="fac-code">Facility code:</label>
            <input type="text" id="fac-code" name="facility_code">

            <br>

            <label for="fac-name">Facility name:</label>
            <input type="text" id="fac-name" name="facility_name">

            <br>

            <label for="fac-type">Facility type:</label>
            <select name="facility_type" id="fac-type">
                <option value="" disabled {{ old('facility_type') ? '' : 'selected' }}>Please select...</option>
                <option value="clubhouse" {{ old('facility_type') == 'clubhouse' ? 'selected' : '' }}>Clubhouse</option>
                <option value="pool" {{ old('facility_type') == 'pool' ? 'selected' : '' }}>Pool</option>
                <option value="basketball" {{ old('facility_type') == 'basketball' ? 'selected' : '' }}>Basketball</option>
                <option value="volleyball" {{ old('facility_type') == 'volleyball' ? 'selected' : '' }}>Volleyball</option>
                <option value="badminton" {{ old('facility_type') == 'badminton' ? 'selected' : '' }}>Badminton</option>
            </select>

            <br>

            <label for="base-fee">Base fee:</label>
            <input type="number" id="base-fee" name="base_fee">

            <br>

            <label for="capacity">Capacity:</label>
            <input type="text" id="capacity" name="capacity">

            <br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description">

            <br>
            <br>

            <button type="submit">Submit</button>
        </form>
    </div>

    <h3>Update Facility Info</h3>
    <p>edit form is in another page</p>

    <h3>Remove Facility</h3>
    <p>remove form is in another page</p>

</body>

</html>
