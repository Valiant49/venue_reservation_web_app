<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-info shadow-sm border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-info-subtle hover:text-info transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
