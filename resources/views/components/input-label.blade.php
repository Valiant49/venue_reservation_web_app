@props(['value'])

<label {{ $attributes->merge(['class' => 'mb-1 block text-xs font-semibold tracking-wider text-gray-500']) }}>
    {{ $value ?? $slot }}
</label>
