/**
 * Generic reusable form validator.
 * Attach any number of "checks" to a form. Each check reports valid/invalid.
 * Submit button is disabled unless ALL checks pass.
 *
 * Usage:
 *   initFormValidation({
 *     form: document.getElementById('add-modal'),      // scope element (dialog/form)
 *     submitBtn: document.getElementById('form-submit'),
 *     checks: [ ... ]  // array of check configs, see below
 *   });
 */
function initFormValidation({ form, submitBtn, checks }) {
    if (!form || !submitBtn) return;

    // state[checkName] = true/false
    const state = {};

    function updateSubmitButton() {
        const allValid = Object.values(state).every(Boolean);
        submitBtn.disabled = !allValid;
    }

    checks.forEach((check) => {
        const { name, fields, validate, watch, onInvalid, onValid } = check;

        // Resolve field elements from IDs, scoped to this form (avoids ID collisions)
        const els = {};
        for (const key in fields) {
            els[key] = form.querySelector(`#${fields[key]}`);
        }

        function runCheck() {
            // If any required element is missing, skip this check entirely
            if (Object.values(els).some((el) => !el)) {
                state[name] = true; // don't block submit for forms that lack this field
                updateSubmitButton();
                return;
            }

            const result = validate(els); // { valid: bool, message?: string }
            state[name] = result.valid;

            if (result.valid) {
                onValid?.(els, result);
            } else {
                onInvalid?.(els, result);
            }

            updateSubmitButton();
        }

        // Wire up listeners for whichever fields this check cares about
        (watch || Object.keys(fields)).forEach((key) => {
            const el = els[key];
            if (!el) return;
            const evt = el.tagName === 'SELECT' ? 'change' : 'input';
            el.addEventListener(evt, runCheck);
        });

        // Run once on load to set initial state
        runCheck();
    });
}

function toMinutes(timeStr) {
    const [h, m] = timeStr.split(':').map(Number);
    return h * 60 + m;
}

function to12Hour(timeStr) {
    const [h, m] = timeStr.split(':').map(Number);
    const period = h >= 12 ? 'PM' : 'AM';
    const hour12 = h % 12 || 12; // 0 becomes 12
    return `${hour12}:${String(m).padStart(2, '0')} ${period}`;
}

// ---------------------------------------------------------------------
// Example: wiring this up for the reservation "Add" modal
// ---------------------------------------------------------------------

// employee-facing reservation add-modal
document.addEventListener('DOMContentLoaded', () => {
    const addModal = document.getElementById('add-modal');
    if (!addModal) return;

    initFormValidation({
        form: addModal,
        submitBtn: addModal.querySelector('#form-submit'),
        checks: [
            {
                name: 'timeAndFee',
                fields: {
                    facility: 'facility',
                    start: 'start-time',
                    end: 'end-time'
                },
                watch: [
                    'facility',
                    'start',
                    'end'
                ],
                validate: ({ facility, start, end }) => {
                    const totalDisplay = addModal.querySelector('#estimated-fee');
                    const durationDisplay = addModal.querySelector('#duration');
                    const totalHidden = addModal.querySelector('#total-fee');

                    if (!facility.value || !start.value || !end.value) {
                        totalDisplay.value = '₱0.00';
                        durationDisplay.value = '0 hrs';
                        return { valid: true }; // not filled yet, don't block/error
                    }

                    const option = facility.options[facility.selectedIndex];
                    const hourlyRate = Number(option.dataset.fee);
                    const startTime = new Date('1970-01-01 ' + start.value);
                    const endTime = new Date('1970-01-01 ' + end.value);
                    const hours = (endTime - startTime) / (1000 * 60 * 60);

                    if (hours <= 0) {
                        totalDisplay.value = 'Invalid time';
                        durationDisplay.value = '-';
                        return { valid: false, message: 'End time must be after start time.' };
                    }

                    const totalMinutes = Math.round(hours * 60);
                    const hrs = Math.floor(totalMinutes / 60);
                    const mins = totalMinutes % 60;
                    let durationText = '';
                    if (hrs > 0) durationText += `${hrs} hr${hrs > 1 ? 's' : ''}`;
                    if (mins > 0) durationText += (durationText ? ' ' : '') + `${mins} min${mins > 1 ? 's' : ''}`;
                    durationDisplay.value = durationText || '0 mins';

                    const total = hourlyRate * hours;
                    totalDisplay.value = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP',
                    }).format(total);
                    totalHidden.value = total;

                    return { valid: true };
                },
            },
            {
                name: 'guestCount',
                fields: { guestCount: 'guest-count', facility: 'facility' },
                watch: ['guestCount', 'facility'],
                validate: ({ guestCount, facility }) => {
                    if (!guestCount.value || !facility.value) return { valid: true };

                    const count = Number(guestCount.value);
                    const option = facility.options[facility.selectedIndex];
                    const maxCapacity = Number(option.dataset.capacity);

                    return count > maxCapacity
                        ? { valid: false, message: `Facility's max capacity is ${maxCapacity}.` }
                        : { valid: true };
                },
                onValid: ({ guestCount }) => {
                    const warning = addModal.querySelector('#guest-warning');
                    guestCount.classList.remove('border-red-500', 'focus:border-red-500');
                    guestCount.classList.add('border-gray-300', 'focus:border-secondary');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ guestCount }, result) => {
                    const warning = addModal.querySelector('#guest-warning');
                    guestCount.classList.remove('border-gray-300', 'focus:border-secondary');
                    guestCount.classList.add('border-red-500', 'focus:border-red-500');
                    if (warning) warning.textContent = result.message;
                },
            },
            {
                name: 'checkDate',
                fields: {selectedDate: 'date'},
                watch: ['selectedDate'],
                validate: ({ selectedDate }) => {
                    if (!selectedDate.value) return { valid: true};

                    const today = new Date().toISOString().split('T')[0];
                    return selectedDate.value < today
                        ? { valid: false, message: 'Date cannot be in the past.' }
                        : { valid: true };
                },
                onValid: ({ selectedDate }) => {
                    const warning = addModal.querySelector('#date-warning');
                    selectedDate.classList.remove('border-red-500', 'focus:border-red-500');
                    selectedDate.classList.add('border-gray-300', 'focus:border-secondary');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ selectedDate }, result) => {
                    const warning = addModal.querySelector('#date-warning');
                    selectedDate.classList.remove('border-gray-300', 'focus:border-secondary');
                    selectedDate.classList.add('border-red-500', 'focus:border-red-500');
                    if (warning) warning.textContent = result.message;
                }
            },
            {
                name: 'operatingHoursAndDuration',
                fields: { facility: 'facility', start: 'start-time', end: 'end-time' },
                watch: ['facility', 'start', 'end'],
                validate: ({ facility, start, end }) => {
                    if (!facility.value || !start.value || !end.value) return { valid: true };

                    const option = facility.options[facility.selectedIndex];
                    const openTime = option.dataset.startingHours;
                    const closeTime = option.dataset.closingHours;
                    const maxDuration = Number(option.dataset.maxDuration);

                    if (start.value < openTime || end.value > closeTime) {
                        return {
                            valid: false,
                            message: `This facility is only available from ${to12Hour(openTime.slice(0,5))} to ${to12Hour(closeTime.slice(0,5))}.`,
                        };
                    }

                    const durationHours = (toMinutes(end.value) - toMinutes(start.value)) / 60;
                    if (durationHours > maxDuration) {
                        return { valid: false, message: `Max reservation duration is ${maxDuration} hour(s).` };
                    }

                    return { valid: true };
                },
                onValid: ({ end }) => {
                    const warning = addModal.querySelector('#time-warning'); // use editModal for edit-modal
                    end.classList.remove('border-red-500');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ end }, result) => {
                    const warning = addModal.querySelector('#time-warning'); // use editModal for edit-modal
                    end.classList.add('border-red-500');
                    if (warning) warning.textContent = result.message;
                },
            },
        ],
    });
});


// employee-facing reservation edit
document.addEventListener('DOMContentLoaded', () => {
    const editModal = document.getElementById('edit-modal');
    if (!editModal) return;

    initFormValidation({
        form: editModal,
        submitBtn: editModal.querySelector('#form-submit'),
        checks: [
            {
                name: 'timeAndFee',
                fields: { facility: 'facility', start: 'start-time', end: 'end-time' },
                watch: ['facility', 'start', 'end'],
                validate: ({ facility, start, end }) => {
                    const totalDisplay = editModal.querySelector('#estimated-fee');
                    const durationDisplay = editModal.querySelector('#duration');
                    const totalHidden = editModal.querySelector('#total-fee');

                    if (!facility.value || !start.value || !end.value) {
                        totalDisplay.value = '₱0.00';
                        durationDisplay.value = '0 hrs';
                        return { valid: true };
                    }

                    const option = facility.options[facility.selectedIndex];
                    const hourlyRate = Number(option.dataset.fee);
                    const startTime = new Date('1970-01-01 ' + start.value);
                    const endTime = new Date('1970-01-01 ' + end.value);
                    const hours = (endTime - startTime) / (1000 * 60 * 60);

                    if (hours <= 0) {
                        totalDisplay.value = 'Invalid time';
                        durationDisplay.value = '-';
                        return { valid: false, message: 'End time must be after start time.' };
                    }

                    const totalMinutes = Math.round(hours * 60);
                    const hrs = Math.floor(totalMinutes / 60);
                    const mins = totalMinutes % 60;
                    let durationText = '';
                    if (hrs > 0) durationText += `${hrs} hr${hrs > 1 ? 's' : ''}`;
                    if (mins > 0) durationText += (durationText ? ' ' : '') + `${mins} min${mins > 1 ? 's' : ''}`;
                    durationDisplay.value = durationText || '0 mins';

                    const total = hourlyRate * hours;
                    totalDisplay.value = new Intl.NumberFormat('en-PH', {
                        style: 'currency',
                        currency: 'PHP',
                    }).format(total);
                    totalHidden.value = total;

                    return { valid: true };
                },
            },
            {
                name: 'guestCount',
                fields: { guestCount: 'guest-count', facility: 'facility' },
                watch: ['guestCount', 'facility'],
                validate: ({ guestCount, facility }) => {
                    if (!guestCount.value || !facility.value) return { valid: true };
                    const option = facility.options[facility.selectedIndex];
                    const maxCapacity = Number(option.dataset.capacity);
                    const count = Number(guestCount.value);
                    return count > maxCapacity
                        ? { valid: false, message: `Facility's max capacity is ${maxCapacity}.` }
                        : { valid: true };
                },
                onValid: ({ guestCount }) => {
                    const warning = editModal.querySelector('#guest-warning');
                    guestCount.classList.remove('border-red-500', 'focus:border-red-500');
                    guestCount.classList.add('border-gray-300', 'focus:border-secondary');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ guestCount }, result) => {
                    const warning = editModal.querySelector('#guest-warning');
                    guestCount.classList.remove('border-gray-300', 'focus:border-secondary');
                    guestCount.classList.add('border-red-500', 'focus:border-red-500');
                    if (warning) warning.textContent = result.message;
                },
            },
            {
                name: 'checkDate',
                fields: { selectedDate: 'date' },
                watch: ['selectedDate'],
                validate: ({ selectedDate }) => {
                    if (!selectedDate.value) return { valid: true };
                    const today = new Date().toISOString().split('T')[0];
                    return selectedDate.value < today
                        ? { valid: false, message: 'Date cannot be in the past.' }
                        : { valid: true };
                },
                onValid: ({ selectedDate }) => {
                    const warning = editModal.querySelector('#date-warning');
                    selectedDate.classList.remove('border-red-500', 'focus:border-red-500');
                    selectedDate.classList.add('border-gray-300', 'focus:border-secondary');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ selectedDate }, result) => {
                    const warning = editModal.querySelector('#date-warning');
                    selectedDate.classList.remove('border-gray-300', 'focus:border-secondary');
                    selectedDate.classList.add('border-red-500', 'focus:border-red-500');
                    if (warning) warning.textContent = result.message;
                },
            },
            {
                name: 'operatingHoursAndDuration',
                fields: { facility: 'facility', start: 'start-time', end: 'end-time' },
                watch: ['facility', 'start', 'end'],
                validate: ({ facility, start, end }) => {
                    if (!facility.value || !start.value || !end.value) return { valid: true };

                    const option = facility.options[facility.selectedIndex];
                    const openTime = option.dataset.startingHours;
                    const closeTime = option.dataset.closingHours;
                    const maxDuration = Number(option.dataset.maxDuration);

                    if (start.value < openTime || end.value > closeTime) {
                        return {
                            valid: false,
                            message: `This facility is only available from ${to12Hour(openTime.slice(0,5))} to ${to12Hour(closeTime.slice(0,5))}.`,
                        };
                    }

                    const durationHours = (toMinutes(end.value) - toMinutes(start.value)) / 60;
                    if (durationHours > maxDuration) {
                        return { valid: false, message: `Max reservation duration is ${maxDuration} hour(s).` };
                    }

                    return { valid: true };
                },
                onValid: ({ end }) => {
                    const warning = editModal.querySelector('#time-warning'); // use editModal for edit-modal
                    end.classList.remove('border-red-500');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ end }, result) => {
                    const warning = editModal.querySelector('#time-warning'); // use editModal for edit-modal
                    end.classList.add('border-red-500');
                    if (warning) warning.textContent = result.message;
                },
            },
        ],
    });
});

//resident-facing reservation.pt1
document.addEventListener('DOMContentLoaded', () => {
    const billingForm = document.getElementById('reservation-form');
    console.log('form found:', billingForm);
    if (!billingForm) return;

    const facility = billingForm.querySelector('#facility'); // ← scoped, not global

    function toggleAddOns() {
        const container = billingForm.querySelector('#addons-container');
        const options = container.querySelectorAll('.addon-option');
        const noAddonsMsg = container.querySelector('#no-addons-msg');
        const facilityId = facility.value;

        let visibleCount = 0;

        options.forEach((opt) => {
            const matches = opt.dataset.facilityId === facilityId;
            opt.classList.toggle('hidden', !matches);
            if (matches) visibleCount++;

            if (!matches) {
                const checkbox = opt.querySelector('input[type="checkbox"]');
                if (checkbox) checkbox.checked = false;
            }
        });

        noAddonsMsg.classList.toggle('hidden', visibleCount > 0);
    }

    facility.addEventListener('change', toggleAddOns);
    toggleAddOns(); // run once on load, handles old() repopulation

    function calculateBilling() {
        const start = billingForm.querySelector('#start-time');
        const end = billingForm.querySelector('#end-time');

        const facilityFeeDisplay = billingForm.querySelector('#facility-fee-display');
        const addonsFeeDisplay = billingForm.querySelector('#addons-fee-display');
        const totalFeeDisplay = billingForm.querySelector('#total-fee-display');
        const totalFeeHidden = billingForm.querySelector('#total-fee');

        const formatPeso = (amt) =>
            new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(amt);

        // --- Facility fee ---
        let facilityFee = 0;
        if (facility.value && start.value && end.value) {
            const option = facility.options[facility.selectedIndex];
            const rate = Number(option.dataset.fee);
            const type = option.dataset.type; // "hourly" or "block"

            const startTime = new Date('1970-01-01 ' + start.value);
            const endTime = new Date('1970-01-01 ' + end.value);
            const hours = (endTime - startTime) / (1000 * 60 * 60);
            facilityFee = hours > 0 ? rate * hours : 0;
        }

        // --- Add-ons subtotal ---
        const checkedAddOns = billingForm.querySelectorAll('.addon-option input[type="checkbox"]:checked');
        let addonsFee = 0;
        checkedAddOns.forEach((cb) => {
            addonsFee += Number(cb.dataset.price);
        });

        // --- Total ---
        const total = facilityFee + addonsFee;

        facilityFeeDisplay.textContent = formatPeso(facilityFee);
        addonsFeeDisplay.textContent = formatPeso(addonsFee);
        totalFeeDisplay.textContent = formatPeso(total);
        totalFeeHidden.value = total;
    }

    facility.addEventListener('change', calculateBilling);
    billingForm.querySelector('#start-time').addEventListener('input', calculateBilling);
    billingForm.querySelector('#end-time').addEventListener('input', calculateBilling);
    billingForm.querySelector('#addons-container').addEventListener('change', calculateBilling); // catches any checkbox toggle inside

    calculateBilling(); // run once on load

    initFormValidation({
        form: billingForm,
        submitBtn: billingForm.querySelector('#form-submit'),
        checks: [
            {
                name: 'guestCount',
                fields: { guestCount: 'guest-count', facility: 'facility' },
                watch: ['guestCount', 'facility'],
                validate: ({ guestCount, facility }) => {
                    if (!guestCount.value || !facility.value) return { valid: true };

                    const option = facility.options[facility.selectedIndex];
                    const maxCapacity = Number(option.dataset.capacity);
                    const count = Number(guestCount.value);

                    return count > maxCapacity
                        ? { valid: false, message: `Facility's max capacity is ${maxCapacity}.` }
                        : { valid: true };
                },
                onValid: ({ guestCount }) => {
                    const warning = billingForm.querySelector('#guest-warning');
                    guestCount.classList.remove('border-red-500');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ guestCount }, result) => {
                    const warning = billingForm.querySelector('#guest-warning');
                    guestCount.classList.add('border-red-500');
                    if (warning) warning.textContent = result.message;
                },
            },
            {
                name: 'checkDate',
                fields: { selectedDate: 'date' },
                watch: ['selectedDate'],
                validate: ({ selectedDate }) => {
                    if (!selectedDate.value) return { valid: true };
                    const today = new Date().toISOString().split('T')[0];
                    return selectedDate.value < today
                        ? { valid: false, message: 'Date cannot be in the past.' }
                        : { valid: true };
                },
                onValid: ({ selectedDate }) => {
                    const warning = billingForm.querySelector('#date-warning');
                    selectedDate.classList.remove('border-red-500');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ selectedDate }, result) => {
                    const warning = billingForm.querySelector('#date-warning');
                    selectedDate.classList.add('border-red-500');
                    if (warning) warning.textContent = result.message;
                },
            },
            {
                name: 'endAfterStart',
                fields: { start: 'start-time', end: 'end-time' },
                watch: ['start', 'end'],
                validate: ({ start, end }) => {
                    if (!start.value || !end.value) return { valid: true };
                    return end.value <= start.value
                        ? { valid: false, message: 'End time must be after start time.' }
                        : { valid: true };
                },
                onValid: ({ end }) => {
                    const warning = billingForm.querySelector('#time-warning');
                    end.classList.remove('border-red-500');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ end }, result) => {
                    const warning = billingForm.querySelector('#time-warning');
                    end.classList.add('border-red-500');
                    if (warning) warning.textContent = result.message;
                },
            },
            {
                name: 'operatingHoursAndDuration',
                fields: { facility: 'facility', start: 'start-time', end: 'end-time' },
                watch: ['facility', 'start', 'end'],
                validate: ({ facility, start, end }) => {
                    if (!facility.value || !start.value || !end.value) return { valid: true };

                    const option = facility.options[facility.selectedIndex];
                    const openTime = option.dataset.startingHours;   // e.g. "08:00"
                    const closeTime = option.dataset.closingHours;    // e.g. "20:00"
                    const maxDuration = Number(option.dataset.maxDuration); // in hours

                    if (start.value < openTime || end.value > closeTime) {
                        return {
                            valid: false,
                            message: `This facility is only available from ${to12Hour(openTime.slice(0,5))} to ${to12Hour(closeTime.slice(0,5))}.`,
                        };
                    }

                    const startMins = toMinutes(start.value);
                    const endMins = toMinutes(end.value);
                    const durationHours = (endMins - startMins) / 60;

                    if (durationHours > maxDuration) {
                        return {
                            valid: false,
                            message: `Max reservation duration is ${maxDuration} hour(s).`,
                        };
                    }

                    return { valid: true };
                },
                onValid: ({ end }) => {
                    const warning = billingForm.querySelector('#time-warning');
                    end.classList.remove('border-red-500');
                    if (warning) warning.textContent = '';
                },
                onInvalid: ({ end }, result) => {
                    const warning = billingForm.querySelector('#time-warning');
                    end.classList.add('border-red-500');
                    if (warning) warning.textContent = result.message;
                },
            },
        ],
    });
});
