document.addEventListener('DOMContentLoaded', () => {
    console.log('Hello World!');

    const facility = document.getElementById('facility');

    if (!facility) return;
    const start = document.getElementById('start-time');
    const end = document.getElementById('end-time');

    const guest_count = document.getElementById('guest-count');
    const guest_warning = document.getElementById('guest-warning');

    const totalDisplay = document.getElementById('estimated-fee');
    const durationDisplay = document.getElementById('duration');

    const submitBtn = document.getElementById('form-submit');

    // console.log(guest_warning);

    function calculateFee() {

        if (!facility.value || !start.value || !end.value) {
            totalDisplay.value = "₱0.00";
            durationDisplay.value = "0 hrs";
            return;
        }

        const option = facility.options[facility.selectedIndex];

        const hourlyRate = Number(option.dataset.fee);

        const startTime = new Date("1970-01-01 " + start.value);
        const endTime = new Date("1970-01-01 " + end.value);

        const hours = (endTime - startTime) / (1000 * 60 * 60);

        if (hours <= 0) {
            totalDisplay.value = "Invalid time";
            durationDisplay.value = "-";
            return;
        }

        const totalMinutes = Math.round(hours * 60);

        const hrs = Math.floor(totalMinutes / 60);
        const mins = totalMinutes % 60;

        let durationText = "";

        if (hrs > 0) durationText += `${hrs} hr${hrs > 1 ? "s" : ""}`;
        if (mins > 0) {
            if (durationText) durationText += " ";
            durationText += `${mins} min${mins > 1 ? "s" : ""}`;
        }

        durationDisplay.value = durationText || "0 mins";

        const total = hourlyRate * hours;

        totalDisplay.value =
            new Intl.NumberFormat(
                "en-PH",
                {
                    style: "currency",
                    currency: "PHP"
                }
            ).format(total);
    }

    function checkGuestCount() {
        if (!guest_count.value) {
            guest_warning.textContent = "";
            submitBtn.disabled = false;
            return;
        }

        const count = Number(guest_count.value);

        const option = facility.options[facility.selectedIndex];
        const max_capacity = Number(option.dataset.capacity);

        if (count > max_capacity) {
            guest_count.classList.remove('border-gray-300');
            guest_count.classList.remove('focus:border-secondary');

            guest_count.classList.add('border-red-500');
            guest_count.classList.add('focus:border-red-500');

            guest_warning.textContent = `Facility's max capacity is ${max_capacity}.`;
            submitBtn.disabled = true;

        } else {
            guest_count.classList.remove('border-red-500');
            guest_count.classList.remove('focus:border-red-500');

            guest_count.classList.add('border-gray-300');
            guest_count.classList.add('focus:border-secondary');

            guest_warning.textContent = "";
            submitBtn.disabled = false;
        }
    }

    facility.addEventListener("change", () => {
        calculateFee();
        checkGuestCount();
    });
    start.addEventListener("input", calculateFee);
    end.addEventListener("input", calculateFee);

    guest_count.addEventListener("input", checkGuestCount);

    calculateFee();
    checkGuestCount();
});
