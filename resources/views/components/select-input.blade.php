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
    <option value="" disabled @selected(is_null($selected))>
        {{ $placeholder }}
    </option>

    {{-- Loop through the options array --}}
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @selected((string) $selected === (string) $value)>
            {{ $label }}
        </option>
    @endforeach
</select>
