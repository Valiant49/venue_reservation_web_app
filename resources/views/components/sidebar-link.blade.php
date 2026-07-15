@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block inline-flex items-center px-1 p-2 border-r-2 border-secondary mb-2
                text-sm font-medium leading-5 text-text
                bg-gradient-to-l from-primary to-white-25
                hover:from-blue-400'

            : 'block inline-flex items-center px-1 p-2 border-r-2 border-secondary-subtle mb-2
                text-sm font-medium leading-5 text-text
                bg-gradient-to-l to-white-25
                hover:from-blue-400'
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
