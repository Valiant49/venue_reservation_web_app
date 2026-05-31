<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('System Reset') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Wipe out the entire system data. PROCEED WITH CAUTION.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-data-reset')"
        >{{ __('Delete System Data') }}
    </x-danger-button>

    <x-modal name="confirm-data-reset" focusable class="">
        <form method="post" action="{{ route('xml.reset') }}" class="p-6">
            @csrf
            @method('DELETE')
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to wipe the entire system data?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once you continue, all of the system\'s data will be permanently deleted. Please enter your password to confirm you would like to permanently delete the system data.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="verification-code" value="{{ __('Code') }}" class="sr-only" />

                <x-text-input id="verification-code" name="verification-code" type=number class="mt-1 block w-3/4"
                    placeholder="{{ __('Code') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Confirm Reset') }}
                    </x-danger-button>
                </div>
            </div>
        </form>
    </x-modal>
</section>
