<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class=py-4 px-4">
        <div class="grid grid-cols-5 place-items-stretch gap-4 mb-3">
            <div class="bg-background p-2 rounded-md h-[100px]">
                <h2 class="text-xl mb-4">No. of Today's Reservations</h2>
                <p class="text-md">XXX</p>
            </div>
            <div class="bg-background p-2 rounded-md h-[100px]">
                <h2 class="text-xl mb-4">No. of Pending Approvals</h2>
                <p class="text-md">XXX</p>
            </div>
            <div class="bg-background p-2 rounded-md h-[100px]">
                <h2 class="text-xl mb-4">Reservations w/o Payment</h2>
                <p class="text-md">XXX</p>
            </div>
            <div class="bg-background p-2 rounded-md h-[100px]">
                <h2 class="text-xl mb-4">Active Residents</h2>
                <p class="text-md">XXX</p>
            </div>
            <div class="bg-background p-2 rounded-md h-[100px]">
                <h2 class="text-xl mb-4">Reservations this Month</h2>
                <p class="text-md">XXX</p>
            </div>
        </div>
        <div class="mb-3">
            <div class="bg-background w-full p-2 rounded-md">
                Table 1
            </div>
        </div>
        <div class="mb-3">
            <div class="bg-background w-full p-2 rounded-md">
                Table 2
            </div>
        </div>
        <div class="flex gap-4 mb-3">
            <div class="bg-background w-full p-2 rounded-md">
                Table 3
            </div>
            <div class="bg-background w-full p-2 rounded-md">
                Table 4
            </div>
        </div>
    </div>
</x-app-layout>
