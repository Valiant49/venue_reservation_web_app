@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-surface-raised border-border text-text rounded-md shadow-sm p-0.5']) }}>

