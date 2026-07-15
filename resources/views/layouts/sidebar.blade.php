<nav class=" bg-background w-[350px] ">
    <header class="m-4 h-full">
        <div class="flex flex-col h-full">
            <div class="logo flex p-2">
                <x-application-logo class="block h-10 m-2.5 w-auto fill-current " />
                <div >
                    <h2 class="text-2xl font-bold">Staff Portal</h2>
                    <p class="text-sm font-light">SOLADIA RESIDENCES</p>
                </div>
            </div>
            <div class="navigation flex flex-col p-4">
                <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-sidebar-link>
                <x-sidebar-link :href="route('client.index')" :active="request()->routeIs('client.index')">
                    {{ __('Clients') }}
                </x-sidebar-link>
                <x-sidebar-link :href="route('facility.index')" :active="request()->routeIs('facility.index')">
                    {{ __('Facilities') }}
                </x-sidebar-link>
                <x-sidebar-link :href="route('reservation.index')" :active="request()->routeIs('reservation.index')">
                    {{ __('Reservations') }}
                </x-sidebar-link>
                @can('admin-access')
                <x-sidebar-link :href="route('staff.index')" :active="request()->routeIs('staff.index')">
                    {{ __('Staff') }}
                </x-sidebar-link>
                <x-sidebar-link :href="route('log.index')" :active="request()->routeIs('log.index')">
                    {{ __('Logs') }}
                </x-sidebar-link>
                @endcan
            </div>
            <div class="account flex p-4 mt-auto mb-6 bg-surface rounded-2xl border-2 border-gray-200">
                <img src="{{ asset('storage/vertin_pfp.png') }}" alt="" class="rounded-full object-cover w-15 h-15">
                <div class="p-2">
                    <h2 class="text-text text-xl">Name</h2>
                    <p class="text-text text-sm">Role</p>
                </div>
            </div>
        </div>
    </header>
</nav>
