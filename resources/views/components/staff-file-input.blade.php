@props(['disabled' => false])

<input
    type="file"
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'mt-1 block w-full text-sm text-gray-500 rounded-md border border-gray-300 bg-white shadow-xs focus:border-secondary focus:outline-hidden focus:ring-1 focus:ring-secondary disabled:cursor-not-allowed disabled:bg-gray-50 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer'
    ]) }}
>
