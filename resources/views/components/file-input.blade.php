{{-- resources/views/components/file-input.blade.php --}}

@props([
    'label'  => 'Upload File',
    'accept' => '*',
    'hint'   => null,
])

<div x-data="{
    fileName: null,
    dragging: false,
    handleFile(files) {
        if (files.length) this.fileName = files[0].name;
    }
}">
    {{-- <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label> --}}

    <div
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="dragging = false; handleFile($event.dataTransfer.files)"
        :class="dragging
            ? 'border-border-focus bg-primary-subtle'
            : 'border-border bg-surface-raised hover:bg-surface'"
        class="relative flex flex-col items-center justify-center gap-2 rounded-lg border-2 border-dashed px-6 py-8 mb-4 text-center transition duration-[var(--transition-base)] cursor-pointer"
    >
        {{-- Hidden actual input --}}
        <input
            type="file"
            accept="{{ $accept }}"
            {{ $attributes }}
            x-ref="fileInput"
            @change="handleFile($event.target.files)"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        >

        {{-- Icon --}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            :stroke="dragging ? 'var(--color-primary)' : 'var(--color-text-muted)'"
            class="size-8 transition duration-[var(--transition-base)]">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
        </svg>

        {{-- Label text --}}
        <div x-show="!fileName">
            <p class="text-sm font-medium text-[var(--color-text)]">
                Drop your file here, or <span class="text-[var(--color-primary)] underline underline-offset-2">browse</span>
            </p>
            @if($hint)
                <p class="mt-1 text-xs text-[var(--color-text-muted)]">{{ $hint }}</p>
            @endif
        </div>

        {{-- Selected file name --}}
        <div x-show="fileName" x-cloak class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="var(--color-success)" class="size-4 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
            <p class="text-sm font-medium text-[var(--color-text)]" x-text="fileName"></p>
            {{-- Clear button --}}
            <button
                type="button"
                @click.stop="fileName = null; $refs.fileInput.value = ''"
                class="ml-1 rounded p-0.5 text-[var(--color-text-muted)] hover:bg-[var(--color-surface-alt)] hover:text-[var(--color-text)] transition duration-[var(--transition-base)]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Validation error --}}
    @if($errors->has($attributes->get('name')))
        <p class="mt-1 text-xs text-red-600">{{ $errors->first($attributes->get('name')) }}</p>
    @endif
</div>
