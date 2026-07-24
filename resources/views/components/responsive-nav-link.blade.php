@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block w-full px-3 py-2 text-start text-md font-medium text-white border-l-4 border-secondary
        focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'

    : 'block w-full px-3 py-2 text-start text-md font-medium text-white border-l-4 border-transparent
        hover:text-white hover:border-gray-300
        focus:outline-none focus:text-white focus:border-gray-300
        transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
