<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @include('layouts.navigation')

    <!-- ================= CONTACT INFO ================= -->
    <section class="bg-white py-16 sm:py-20 lg:py-24 px-6 sm:px-10 lg:px-[90px]">
        <div class="max-w-[1400px] mx-auto">

            <h2 class="font-cormorant text-4xl sm:text-5xl lg:text-6xl text-black mb-8 sm:mb-10 lg:mb-14">
                Contact Us
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">

                <div class="flex flex-col items-center text-center bg-primary rounded-xl px-5 py-8">
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">HOA Office</h3>
                    <p class="font-nunito text-sm text-gray-200 leading-6">
                        123456 Avenue St,<br>Very Long Address City
                    </p>
                </div>

                <div class="flex flex-col items-center text-center bg-primary rounded-xl px-5 py-8">
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">Phone</h3>
                    <p class="font-nunito text-sm text-gray-200 leading-6">
                        +64-000-000<br>+64-300-000
                    </p>
                </div>

                <div class="flex flex-col items-center text-center bg-primary rounded-xl px-5 py-8">
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">Email</h3>
                    <p class="font-nunito text-sm text-gray-200 leading-6">
                        housing@rmeil.com<br>hoa@rmeil.com
                    </p>
                </div>

                <div class="flex flex-col items-center text-center bg-primary rounded-xl px-5 py-8">
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">Office Hours</h3>
                    <p class="font-nunito text-sm text-gray-200 leading-6">
                        Mon–Fri: 8AM–5PM<br>Sat: 9AM–12PM
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= DEPARTMENT CONTACTS ================= -->
    <section class="bg-primary py-16 sm:py-20 lg:py-24 px-6 sm:px-10 lg:px-[90px]">
        <div class="max-w-[1400px] mx-auto">

            <h2 class="font-cormorant text-4xl sm:text-5xl lg:text-6xl text-white mb-8 sm:mb-10 lg:mb-14">
                Reach the Right Department
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 sm:gap-10">

                <div>
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">Administration</h3>
                    <p class="font-nunito text-sm text-white leading-6 mb-2">
                        Dues, association records, resident concerns, and general HOA
                        inquiries.
                    </p>
                    <p class="font-nunito text-sm text-white font-semibold">admin@rmeil.com</p>
                </div>

                <div>
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">Security</h3>
                    <p class="font-nunito text-sm text-white leading-6 mb-2">
                        Gate access, visitor passes, and incident reports within the
                        community.
                    </p>
                    <p class="font-nunito text-sm text-white font-semibold">security@rmeil.com</p>
                </div>

                <div>
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">Maintenance</h3>
                    <p class="font-nunito text-sm text-white leading-6 mb-2">
                        Facility bookings, repairs, and upkeep of shared amenities and
                        common areas.
                    </p>
                    <p class="font-nunito text-sm text-white font-semibold">maintenance@rmeil.com</p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= INQUIRY ================= -->
    <section class="bg-white py-20">
        <div class="mx-auto max-w-5xl px-8">
            <!-- Heading -->
            <h2 class="font-['Cormorant_Garamond'] text-6xl text-black">
                Inquiry
            </h2>
            <p class="mb-6 mt-1 font-['Alegreya'] text-sm text-black">
                Jelly beans cake oat cake marzipan danish jelly-o muffin caramels chocolate —
                I love pastry sweet roll lemon drops
            </p>
            <form class="mx-auto max-w-2xl">
                <!-- Top Row -->
                <div class="grid gap-1 md:grid-cols-3">
                    <div>
                        <x-input-label>Name:</x-input-label>
                        <x-text-input type="text"></x-text-input>
                    </div>
                    <div>
                        <x-input-label> Number:</x-input-label>
                        <x-text-input type="text"></x-text-input>
                    </div>
                    <div>
                        <x-input-label>Email:</x-input-label>
                        <x-text-input type="email"></x-text-input>
                    </div>
                </div>
                <!-- Message -->
                <div class="mt-3">
                    <x-input-label>Message:</x-input-label>
                    <x-textarea-input rows="7"></x-textarea-input>
                </div>
                <!-- Button -->
                <div class="mt-5 text-center">
                    <button type="submit"
                        class="rounded-md bg-[#284b63] px-8 py-2 tracking-[4px] text-white duration-300 hover:bg-[#12364d]">
                        SUBMIT
                    </button>
                </div>
            </form>
        </div>
    </section>

    <x-public-footer></x-public-footer>
</body>

</html>
