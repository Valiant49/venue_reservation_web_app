@props([
    'name',
    'id' => null,
    'options' => [],
    'placeholder' => 'Please select...',
    'selected' => null
])

<select
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-secondary focus:outline-hidden focus:ring-1 focus:ring-secondary bg-white text-gray-900']) }}
>
    {{-- Placeholder Option --}}
    <option value="" disabled {{ old($name, $selected) ? '' : 'selected' }}>
        {{ $placeholder }}
    </option>

    {{-- Loop through the options array --}}with the Reservation Type dropdown not displaying is likely due to a syntax error in the resources/views/components/select-in
    @foreach ($options as $value => $label)tax error in the
        <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
