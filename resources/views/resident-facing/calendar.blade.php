<head>
    <style>
        .fc-toolbar {
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .fc-button {
            padding: 0.35rem 0.6rem !important;
            font-size: 0.8rem !important;
        }

        .fc-toolbar-title {
            font-size: 1.4rem !important;
        }
    </style>
</head>

<x-resident-layout>
    <x-slot name="header">
        <h2 class="mx-auto max-w-7xl px-4 text-xl font-semibold leading-tight text-gray-800 sm:px-6 lg:px-8">
            {{ __('Calendar of Activities') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 h-[calc(100vh-8rem)]">
        <div id="calendar"></div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [FullCalendar.dayGridPlugin, FullCalendar.timeGridPlugin, FullCalendar.listPlugin],
            initialView: 'dayGridMonth',
            height: '100%',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            windowResize: function(view) {
                if (window.innerWidth < 640) {
                    calendar.setOption('headerToolbar', {
                        left: 'prev,next',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek'
                    });
                } else {
                    calendar.setOption('headerToolbar', {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,listWeek'
                    });
                }
            },
            events: '{{ route('resident.calendar.events') }}'
        });
        calendar.render();
        });
    </script>
@endpush

</x-resident-layout>
