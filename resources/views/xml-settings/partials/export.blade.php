<header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Export Records to XML') }}
    </h2>
    <p class="mt-1 text-sm text-gray-600">
        {{ __('Export all database records of a specific entity.') }}
    </p>
</header>

<div class="py-12">
    @if (session('success'))
        <div class="mb-4 rounded-md border border-green-200 bg-green-100 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 rounded-md border border-red-200 bg-red-100 p-4 text-sm text-red-700">
            {{ session('error') }}
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
    <div class="flex flex-wrap items-center justify-start gap-2 overflow-x-auto">
        <div>
            <form action="{{ route('xml.export', 'clients') }}" method="POST">
                @csrf <x-option-button> Download Clients Records </x-option-button>
            </form>
        </div>
        <div>
            <form action="{{ route('xml.export', 'facilities') }}" method="POST">
                @csrf <x-option-button> Download Facilities Records </x-option-button>
            </form>
        </div>
        <div>
            <form action="{{ route('xml.export', 'reservations') }}" method="POST">
                @csrf <x-option-button> Download Reservation Records</x-option-button>
            </form>
        </div>
        <div>
            <form action="{{ route('xml.export', 'staffs') }}" method="POST">
                @csrf <x-option-button> Download Staff Records</x-option-button>
            </form>
        </div>
    </div>
</div>
