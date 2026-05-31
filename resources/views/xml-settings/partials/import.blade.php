<header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Import Records to XML') }}
    </h2>
    <p class="">
        {{ __('Import XML records for a specific entity.') }}
    </p>
</header>

<div class="py-12">
    <div class="">
        @if (session('success'))
            <div class="mb-4 rounded-md border border-green-200 bg-green-100 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-md border border-red-200 bg-red-100 p-4 text-sm text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="flex flex-wrap items-start justify-start gap-4">
        <div class="sm:mb-4">
            <form action="{{ route('xml.import', 'clients') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-input-label>Clients</x-input-label>
                <x-file-input name="xml_file" id="" />
                <x-primary-button>Import Clients</x-primary-button>
            </form>
        </div>
        <div class="sm:mb-4">
            <form action="{{ route('xml.import', 'facilities') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-input-label>Facilities</x-input-label>
                <x-file-input name="xml_file" id="" />
                <x-primary-button>Import Facilities</x-primary-button>
            </form>
        </div>
        <div class="sm:mb-4">
            <form action="{{ route('xml.import', 'reservations') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-input-label>Reservations</x-input-label>
                <x-file-input name="xml_file" id="" />
                <x-primary-button>Import Reservations</x-primary-button>
            </form>
        </div>
    </div>
</div>
