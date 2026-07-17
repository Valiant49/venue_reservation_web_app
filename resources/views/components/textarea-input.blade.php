@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-secondary focus:outline-hidden focus:ring-1 focus:ring-secondary bg-white text-gray-900']) }}></textarea>
