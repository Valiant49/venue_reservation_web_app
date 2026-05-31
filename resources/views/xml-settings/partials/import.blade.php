<header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Import Records to XML') }}
    </h2>
    <p class="">
        {{ __('Import XML records for a specific entity.') }}
    </p>
</header>

<div class="py-12">
    <div class="flex gap-4">
        <div>
            <form action="{{ route('xml.import', 'clients') }}" method="post">
                @csrf
                <x-input-label>Clients</x-input-label>
                <x-file-input type="file" name="xml_file" id="" class="mb-2"/>
                <x-primary-button>Import Clients</x-primary-button>
            </form>
        </div>
        <div>
            <form action="{{ route('xml.import', 'facilities') }}" method="post">
                @csrf
                <x-input-label>Facilities</x-input-label>
                <x-file-input type="file" name="xml_file" id="" class="mb-2"/>
                <x-primary-button>Import Facilities</x-primary-button>
            </form>
        </div>
        <div>
            <form action="{{ route('xml.import', 'clients') }}" method="post">
                @csrf
                <x-input-label>Reservations</x-input-label>
                <x-file-input type="file" name="xml_file" id="" class="mb-2"/>
                <x-primary-button>Import Reservations</x-primary-button>
            </form>
        </div>
    </div>
</div>
