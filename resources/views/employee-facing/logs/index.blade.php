<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Logs') }}
        </h2>
    </x-slot>

    <div class="px-4 py-6">

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

        <div
            class="bg-surface-alt shadow-xs border-border-strong max-h-180 relative overflow-x-auto overflow-y-auto rounded-md border">
            <table class="text-body w-full text-left text-sm">
                <thead
                    class="text-body bg-surface border-default-medium text-text sticky top-0 z-10 border-b text-sm">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium">Timestamp</th>
                        <th scope="col" class="px-4 py-3 font-medium">Entity ID</th>
                        <th scope="col" class="px-4 py-3 font-medium">Entity Type</th>
                        <th scope="col" class="px-4 py-3 font-medium">Action</th>
                        <th scope="col" class="px-4 py-3 font-medium">Old Value</th>
                        <th scope="col" class="px-4 py-3 font-medium">New Value</th>
                        <th scope="col" class="px-4 py-3 font-medium">User ID</th>
                        <th scope="col" class="px-4 py-3 font-medium">User Name</th>
                    </tr>
                </thead>
                <tbody id="log-table-body">
                    @foreach ($logs as $log)
                        <tr class="bg-background border-default hover:bg-gray-300 border-b">
                            <td class="px-4 py-4">
                                {{ $log->created_at }}
                            </td>
                            <td class="px-4 py-4">
                                {{ $log->entity_id }}
                            </td>
                            <td class="data-name px-4 py-4">
                                {{ class_basename($log->entity_type) }}
                            </td>
                            <td class="px-4 py-4">
                                {{ $log->action }}
                            </td>
                            <td class="px-4 py-4">
                                @if ($log->old_values)
                                    @foreach ($log->old_values as $key => $value)
                                        @continue($key === 'password' || $key === 'updated_at')
                                        <div><strong>{{ $key }}:</strong> {{ $value }}</div>
                                    @endforeach
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                @if ($log->new_values)
                                    @foreach ($log->new_values as $key => $value)
                                        @continue($key === 'password' || $key === 'updated_at')
                                        <div><strong>{{ $key }}:</strong> {{ $value }}</div>
                                    @endforeach
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                {{ $log->user_id }}
                            </td>
                            <td class="px-4 py-4">
                                {{ $log->user_name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-app-layout>
