<header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Export Records to XML') }}
    </h2>
    <p class="">
        {{ __('Export all database records of a specific entity.') }}
    </p>
</header>

<div class="py-12">
    <div class="flex items-center justify-start gap-2">
        <div>
            <form action="{{ route('xml.export', 'clients') }}" method="POST">
                @csrf <x-option-button> ⬇ Download Clients Records </x-option-button>
            </form>
        </div>
        <div>
            <form action="{{ route('xml.export', 'facilities') }}" method="POST">
                @csrf <x-option-button> ⬇ Download Facilities Records </x-option-button>
            </form>
        </div>
        <div>
            <form action="{{ route('xml.export', 'reservations') }}" method="POST">
                @csrf <x-option-button> ⬇ Download Reservation Records</x-option-button>
            </form>
        </div>
        <div>
            <form action="{{ route('xml.export', 'staffs') }}" method="POST">
                @csrf <x-option-button> ⬇ Download Staff Records</x-option-button>
            </form>
        </div>
    </div>
</div>
