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
    {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-hidden focus:ring-1 focus:ring-indigo-500 bg-white text-gray-900']) }}
>
    {{-- Placeholder Option --}}
    <option value="" disabled {{ old($name, $selected) ? '' : 'selected' }}>
        {{ $placeholder }}
    </option>

    {{-- Loop through the options array --}}
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
