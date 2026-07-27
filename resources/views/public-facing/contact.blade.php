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

                <div class="flex flex-col items-center text-center bg-primary px-5 py-8 rounded-tr-lg rounded-bl-lg">
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">HOA Office</h3>
                    <p class="font-nunito text-sm text-gray-200 leading-6">
                        123456 Avenue St,<br>Very Long Address City
                    </p>
                </div>

                <div class="flex flex-col items-center text-center bg-primary rounded-tr-lg rounded-bl-lg px-5 py-8">
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">Phone</h3>
                    <p class="font-nunito text-sm text-gray-200 leading-6">
                        +64-000-000<br>+64-300-000
                    </p>
                </div>

                <div class="flex flex-col items-center text-center bg-primary rounded-tr-lg rounded-bl-lg px-5 py-8">
                    <h3 class="font-alegreya font-medium text-white text-lg mb-2">Email</h3>
                    <p class="font-nunito text-sm text-gray-200 leading-6">
                        housing@rmeil.com<br>hoa@rmeil.com
                    </p>
                </div>

                <div class="flex flex-col items-center text-center bg-primary rounded-tr-lg rounded-bl-lg px-5 py-8">
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
    <x-inquiry></x-inquiry>

    <x-public-footer></x-public-footer>
</body>

</html>
