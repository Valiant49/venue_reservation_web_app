@isset($clients)
<div id="edit-modal">
    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="/client/{{ $client->id }}" method="post">
        @csrf
        @method('PUT')

            <label for="block-no">Block No.:</label>
            <input type="number" name="block_num" id="block-no" min="1" max="39" value="{{ $client->block_num }}"> <br>

            <label for="lot-no">Lot No.: </label>
            <input type="number" name="lot_num" id="lot-no" min="1" max="300" value="{{ $client->lot_num}}"> <br>

            <label for="street-no">Street No.: </label>
            <input type="number" name="street_num" id="street-no" min="1" max="100" value="{{ $client->street_num}}"> <br>

            <label for="first-name">First Name: </label>
            <input type="text" name="first_name" id="first-name" value="{{ $client->first_name}}"> <br>
            <label for="middle-name">Middle Name: </label>
            <input type="text" name="middle_name" id="middle-name" value="{{ $client->middle_name}}"> <br>
            <label for="last-name">Last Name: </label>
            <input type="text" name="last_name" id="last-name" value="{{ $client->last_name}}"> <br>

            <label for="contact-no">Contact No.: </label>
            <input type="tel" name="contact_num" id="contact-no" value="{{ $client->contact_num}}"> <br>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" value="{{ $client->email}}"> <br> <br>

            <button type="submit">Submit</button>


    </form>
</div>
@endisset
