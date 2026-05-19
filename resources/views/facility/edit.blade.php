@isset($facility)
<div id="edit-modal">
    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="/facility/{{ $facility->id }}" method="POST">
        @csrf
        @method('PUT')

        <label for="edit-fac-code">Facility code:</label>
        <input type="text" id="edit-fac-code" name="facility_code" value="{{ $facility->facility_code }}">

        <br>

        <label for="edit-fac-name">Facility name:</label>
        <input type="text" id="edit-fac-name" name="facility_name" value="{{ $facility->facility_name }}">

        <br>

        <label for="edit-fac-type">Facility type:</label>
        <select name="facility_type" id="edit-fac-type">
            <option value="" disabled {{ (!old('facility_type') && !isset($facility)) ? 'selected' : '' }}>Please select...</option>
            <option value="clubhouse" {{ (old('facility_type') ?? $facility->facility_type ?? '') == 'clubhouse' ? 'selected' : '' }}>Clubhouse</option>
            <option value="pool"      {{ (old('facility_type') ?? $facility->facility_type ?? '') == 'pool'      ? 'selected' : '' }}>Pool</option>
            <option value="basketball"{{ (old('facility_type') ?? $facility->facility_type ?? '') == 'basketball'? 'selected' : '' }}>Basketball</option>
            <option value="volleyball"{{ (old('facility_type') ?? $facility->facility_type ?? '') == 'volleyball'? 'selected' : '' }}>Volleyball</option>
            <option value="badminton" {{ (old('facility_type') ?? $facility->facility_type ?? '') == 'badminton' ? 'selected' : '' }}>Badminton</option>
        </select>

        <br>
        <label for="base-fee">Base fee:</label>
        <input type="number" id="base-fee" name="base_fee" value="{{ $facility->base_fee }}">

        <br>

        <label for="capacity">Capacity:</label>
        <input type="text" id="capacity" name="capacity" value="{{ $facility->capacity }}">

        <br>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="{{ $facility->description }}">

        <br>
        <br>

        <button type="submit">Submit</button>
    </form>
</div>
@endisset
