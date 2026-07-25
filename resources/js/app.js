import './bootstrap';
import 'flowbite';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

import './staff-reservation-form';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.FullCalendar = { Calendar, dayGridPlugin, timeGridPlugin, listPlugin };

Alpine.start();
