<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sunshine City | Clients</title>
</head>

<body>
    <h1>Clients</h1>

    <p>Navigation</p>
    <ul>
        <li><a href="/dashboard">Dashboard</a></li>
        <li><a href="/client">Clients</a></li>
        <li><a href="/facility">Facilities</a></li>
        <li><a href=""></a></li>
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

    <h2>Clients</h2>

    <table>
        <tr>
            <th style="border: black solid 2px">Block No.</th>
            <th style="border: black solid 2px">Lot No.</th>
            <th style="border: black solid 2px">Street No.</th>
            <th style="border: black solid 2px">Name</th>
            <th style="border: black solid 2px">Contact No.</th>
            <th style="border: black solid 2px">Email</th>
            <th style="border: black solid 2px">Actions</th>
        </tr>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->block_num }}</td>
                <td>{{ $client->lot_num }}</td>
                <td>{{ $client->street_num }}</td>
                <td>{{ $client->first_name }} {{ Str::limit($client->middle_name, 1, '.') }} {{ $client->last_name }}</td>
                <td>{{ $client->contact_num }}</td>
                <td>{{ $client->email }}</td>
                <td>
                    <a href="/client/{{ $client->id }}/edit">Edit</a>
                    <a href="/client/{{ $client->id }}">Remove</a>

                </td>
            </tr>
        @endforeach
    </table>

    <br>

    <h2>CRUD Operations</h2>
    <h3>Add Client</h3>
    <div id="add-modal">
        <form action="/client" method="POST">
            @csrf
            <label for="block-no">Block No.:</label>
            <input type="number" name="block_num" id="block-no" min="1" max="39" required></input> <br>

            <label for="lot-no">Lot No.: </label>
            <input type="number" name="lot_num" id="lot-no" min="1" max="300" required> <br>

            <label for="street-no">Street No.: </label>
            <input type="number" name="street_num" id="street-no" min="1" max="100" required> <br>

            <label for="first-name">First Name: </label>
            <input type="text" name="first_name" id="first-name" required> <br>
            <label for="middle-name">Middle Name: </label>
            <input type="text" name="middle_name" id="middle-name"> <br>
            <label for="last-name">Last Name: </label>
            <input type="text" name="last_name" id="last-name" required> <br>

            <label for="contact-no">Contact No.: </label>
            <input type="tel" name="contact_num" id="contact-no" required> <br>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email"> <br> <br>

            <button type="submit">Submit</button>

        </form>
    </div>
</body>

</html>
