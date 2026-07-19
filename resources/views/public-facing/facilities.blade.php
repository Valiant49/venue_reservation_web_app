<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600&family=Cormorant+Garamond:wght@500;600;700&family=Nunito:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-[#fafafa] font-['Nunito'] text-[#353535]">
    <!-- ================= HERO ================= -->
    <section class="relative h-[350px] w-full">
        <img src="images/hero.jpg" alt="Hero Banner" class="h-full w-full object-cover">
        <div class="absolute inset-0 bg-black/20"></div>
    </section>

    <!-- ================= TITLE ================= -->
    <section class="py-16 text-center">
        <h1 class="font-['Cormorant_Garamond'] text-7xl font-semibold text-[#284b63]"> FACILITIES</h1>
        <p class="mt-3 font-['Alegreya'] text-2xl">Live your life in Soladia with our Facilities</p>
    </section>

    <!-- ================= FUNCTION HALL ================= -->
    <section class="mx-auto max-w-6xl px-8 pb-24">
        <div class="grid items-center gap-16 lg:grid-cols-2">
            <!-- LEFT -->
            <div class="order-2 lg:order-1">
                <h2 class="font-['Cormorant_Garamond'] text-5xl font-semibold">
                    Function Hall
                </h2>
                <p class="mt-6 leading-8 text-gray-600">
                    Our elegant Function Hall is ideal for birthdays,
                    weddings, seminars, meetings, reunions and other
                    memorable events.
                    Experience a spacious and comfortable venue designed
                    to make every celebration unforgettable.
                </p>
                <div class="mt-10 flex justify-center gap-5 lg:justify-start">
                    <button
                        class="rounded-md border border-[#284b63] px-8 py-3 font-['Alegreya'] text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                        Preview
                    </button>
                    <button
                        class="rounded-md bg-[#284b63] px-8 py-3 font-['Alegreya'] text-white duration-300 hover:bg-[#12364d]">
                        Book Now
                    </button>
                </div>
            </div>
            <!-- RIGHT -->
            <div class="order-1 lg:order-2">
                <img src="images/functionhall.jpg" alt="Function Hall"
                    class="h-[360px] w-full rounded-xl object-cover shadow-xl">
            </div>
        </div>
    </section>

    <!-- ================= AQUATIC CENTER ================= -->
    <section class="bg-white py-20">
        <div class="mx-auto max-w-6xl px-8">
            <h2 class="mb-16 text-center font-['Cormorant_Garamond'] text-6xl font-semibold text-[#284b63]">
                Aquatic Center
            </h2>
            <!-- PARTY POOL -->
            <div class="mb-24 grid items-center gap-16 lg:grid-cols-2">
                <div>
                    <img src="images/partypool.jpg" alt="Party Pool"
                        class="h-[350px] w-full rounded-xl object-cover shadow-xl duration-300 hover:scale-105">
                </div>
                <div>
                    <h3 class="font-['Cormorant_Garamond'] text-5xl font-semibold">
                        Party Pool
                    </h3>
                    <p class="mt-6 leading-8 text-gray-600">
                        Celebrate birthdays, reunions, and private gatherings
                        in our Party Pool. Enjoy a refreshing environment perfect
                        for family bonding and memorable occasions.
                    </p>
                    <div class="mt-8 flex gap-5">
                        <button
                            class="rounded-md border border-[#284b63] px-8 py-3 text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                            Preview
                        </button>
                        <button class="rounded-md bg-[#284b63] px-8 py-3 text-white duration-300 hover:bg-[#12364d]">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
            <!-- LAP POOL -->
            <div class="mb-24 grid items-center gap-16 lg:grid-cols-2">
                <div class="order-2 lg:order-1">
                    <h3 class="font-['Cormorant_Garamond'] text-5xl font-semibold">
                        Lap Pool
                    </h3>
                    <p class="mt-6 leading-8 text-gray-600">
                        Designed for fitness enthusiasts, our Lap Pool provides
                        ample space for exercise, swimming lessons, and daily
                        training while enjoying a peaceful atmosphere.
                    </p>
                    <div class="mt-8 flex gap-5">
                        <button
                            class="rounded-md border border-[#284b63] px-8 py-3 text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                            Preview
                        </button>
                        <button class="rounded-md bg-[#284b63] px-8 py-3 text-white duration-300 hover:bg-[#12364d]">
                            Book Now
                        </button>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <img src="images/lappool.jpg" alt="Lap Pool"
                        class="h-[350px] w-full rounded-xl object-cover shadow-xl duration-300 hover:scale-105">
                </div>
            </div>
            <!-- ACTIVITY GAME POOL -->
            <div class="grid items-center gap-16 lg:grid-cols-2">
                <div>
                    <img src="images/activitypool.jpg" alt="Activity Game Pool"
                        class="h-[350px] w-full rounded-xl object-cover shadow-xl duration-300 hover:scale-105">
                </div>
                <div>
                    <h3 class="font-['Cormorant_Garamond'] text-5xl font-semibold">
                        Activity Game Pool
                    </h3>
                    <p class="mt-6 leading-8 text-gray-600">
                        Have fun with exciting water activities and games in our
                        Activity Game Pool. Perfect for kids, families, and groups
                        looking for a lively recreational experience.
                    </p>
                    <div class="mt-8 flex gap-5">
                        <button
                            class="rounded-md border border-[#284b63] px-8 py-3 text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                            Preview
                        </button>
                        <button class="rounded-md bg-[#284b63] px-8 py-3 text-white duration-300 hover:bg-[#12364d]">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= SPORTS COMPLEX ================= -->
    <section class="bg-[#fafafa] py-24">
        <div class="mx-auto max-w-6xl px-8">
            <h2 class="mb-16 text-center font-['Cormorant_Garamond'] text-6xl font-semibold text-[#284b63]">
                Sports Complex
            </h2>
            <!-- ================= BASKETBALL COURT ================= -->
            <div class="mb-24 grid items-center gap-16 lg:grid-cols-2">
                <div>
                    <img src="images/basketball.jpg" alt="Basketball Court"
                        class="h-[350px] w-full rounded-xl object-cover shadow-xl duration-300 hover:scale-105">
                </div>
                <div>
                    <h3 class="font-['Cormorant_Garamond'] text-5xl font-semibold hover:text-white
                        duration-300">
                        Basketball Court

                    </h3>
                    <p class="mt-6 leading-8 text-gray-600">
                        Enjoy competitive and recreational basketball in our
                        spacious court designed for players of all ages.
                        Whether for training, tournaments, or friendly games,
                        our facility offers a comfortable and exciting experience.
                    </p>
                    <div class="mt-8 flex gap-5">
                        <button
                            class="rounded-md border border-[#284b63] px-8 py-3 text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                            Preview
                        </button>
                        <button class="rounded-md bg-[#284b63] px-8 py-3 text-white duration-300 hover:bg-[#12364d]">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>

            <!-- ================= VOLLEYBALL COURT ================= -->
            <div class="mb-24 grid items-center gap-16 lg:grid-cols-2">
                <div class="order-2 lg:order-1">
                    <h3 class="font-['Cormorant_Garamond'] text-5xl font-semibold">
                        Volleyball Court
                    </h3>
                    <p class="mt-6 leading-8 text-gray-600">
                        Gather your fr
                        hover:text-white
                        duration-300">iends and enjoy exciting volleyball
                        matches in our well-maintained court. Perfect for
                        casual games, practice sessions, and community events.
                    </p>
                    <div class="mt-8 flex gap-5">
                        <button
                            class="rounded-md border border-[#284b63] px-8 py-3 text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                            Preview
                        </button>
                        <button class="rounded-md bg-[#284b63] px-8 py-3 text-white duration-300 hover:bg-[#12364d]">
                            Book Now
                        </button>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <img src="images/volleyball.jpg" alt="Volleyball Court"
                        class="h-[350px] w-full rounded-xl object-cover shadow-xl duration-300 hover:scale-105">
                </div>
            </div>

            <!-- ================= BADMINTON COURT ================= -->
            <div class="grid items-center gap-16 lg:grid-cols-2">
                <div>
                    <img src="images/badminton.jpg" alt="Badminton Court"
                        class="h-[350px] w-full rounded-xl object-cover shadow-xl duration-300 hover:scale-105">
                </div>
                <div>
                    <h3 class="font-['Cormorant_Garamond'] text-5xl font-semibold">
                        Badminton Court
                    </h3>
                    <p class="mt-6 leading-8 text-gray-600">
                        Stay active while enjoying a fast-paced game of
                        badminton. Our indoor court provides a safe and
                        enjoyable environment for beginners and experienced
                        players alike.
                    </p>
                    <div class="mt-8 flex gap-5">
                        <button
                            class="rounded-md border border-[#284b63] px-8 py-3 text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                            Preview
                        </button>
                        <button class="rounded-md bg-[#284b63] px-8 py-3 text-white duration-300 hover:bg-[#12364d]">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CLUBHOUSE ================= -->
    <section class="bg-white py-24">
        <div class="mx-auto max-w-6xl px-8">
            <div class="mb-24 grid items-center gap-16 lg:grid-cols-2">
                <div>
                    <img src="images/clubhouse.jpg" alt="Clubhouse"
                        class="h-[350px] w-full rounded-xl object-cover shadow-xl duration-300 hover:scale-105">
                </div>
                <div>
                    <h2 class="font-['Cormorant_Garamond'] text-5xl font-semibold">
                        Clubhouse
                    </h2>
                    <p class="mt-6 leading-8 text-gray-600">
                        Relax and spend quality time with family, friends, and
                        neighbors inside our elegant clubhouse. It is the perfect
                        place for gatherings, meetings, and community activities.
                    </p>
                    <div class="mt-8 flex gap-5">
                        <button
                            class="rounded-md border border-[#284b63] px-8 py-3 text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                            Preview
                        </button>
                        <button class="rounded-md bg-[#284b63] px-8 py-3 text-white duration-300 hover:bg-[#12364d]">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>

            <!-- ================= CONFERENCE ROOM ================= -->
            <div class="grid items-center gap-16 lg:grid-cols-2">
                <div class="order-2 lg:order-1">
                    <h2 class="font-['Cormorant_Garamond'] text-5xl font-semibold">
                        Conference Room
                    </h2>
                    <p class="mt-6 leading-8 text-gray-600">
                        Conduct productive meetings, seminars, and presentations
                        in our fully equipped conference room. Designed for
                        comfort and professionalism, it provides an ideal
                        environment for business and community discussions.
                    </p>
                    <div class="mt-8 flex gap-5">
                        <button
                            class="rounded-md border border-[#284b63] px-8 py-3 text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                            Preview
                        </button>
                        <button class="rounded-md bg-[#284b63] px-8 py-3 text-white duration-300 hover:bg-[#12364d]">
                            Book Now
                        </button>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <img src="images/conference.jpg" alt="Conference Room"
                        class="h-[350px] w-full rounded-xl object-cover shadow-xl duration-300 hover:scale-105">
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
                        <label class="mb-1 block text-sm text-[#284b63]">Name:</label>
                        <input type="text" class="h-9 w-full rounded-md bg-[#fafafa] px-3">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm text-[#284b63]">Contact Number:</label>
                        <input type="text" class="h-9 w-full rounded-md bg-[#fafafa] px-3">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm text-[#284b63]">Email:</label>
                        <input type="email" class="h-9 w-full rounded-md bg-[#fafafa] px-3">
                    </div>
                </div>
                <!-- Message -->
                <div class="mt-3">
                    <label class="mb-1 block text-sm text-[#284b63]">Message:</label>
                    <textarea rows="7" class="w-full resize-none rounded-md bg-[#fafafa] p-3"></textarea>
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

    <!-- ================= FOOTER ================= -->
    <footer class="bg-[#284b63] py-12 text-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Footer Grid -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
                <!-- Logo -->
                <div class="flex items-center pt-6">
                    <img src="images/lo.png" alt="Logo" class="h-16 w-16 flex-shrink-0 object-contain">
                    <h2 class="ml-4 whitespace-nowrap font-['Cormorant_Garamond'] text-xl tracking-wide">
                        SOLADIA RESIDENCES
                    </h2>
                </div>
                <!-- Contact -->
                <div class="text-left">
                    <h3 class="mb-4 font-['Cormorant_Garamond'] text-2xl">
                        Contact Us
                    </h3>
                    <div class="space-y-1 font-['Alegreya'] text-sm leading-6">
                        <p>+64-000-000</p>
                        <p>+64-300-000</p>
                        <p>housing@email.com</p>
                        <p>
                            123456 Avenue St.<br>
                            Long Address City
                        </p>
                    </div>
                </div>
                <!-- Navigation -->
                <div class="text-left">
                    <h3 class="mb-4 font-['Cormorant_Garamond'] text-2xl">
                        Navigation
                    </h3>
                    <div class="space-y-1 font-['Alegreya'] text-sm leading-6">
                        <a href="#" class="block hover:underline">Home</a>
                        <a href="#" class="block hover:underline">Facilities</a>
                        <a href="#" class="block hover:underline">Reserve a Facility</a>
                    </div>
                </div>
                <!-- Policy -->
                <div class="text-left">
                    <h3 class="mb-4 font-['Cormorant_Garamond'] text-2xl">
                        Policy
                    </h3>
                    <div class="space-y-1 font-['Alegreya'] text-sm leading-6">
                        <a href="#" class="block hover:underline">Privacy Policy</a>
                        <a href="#" class="block hover:underline">Terms and Conditions</a>
                    </div>
                </div>
            </div>
            <!-- Copyright -->
            <div class="mt-10 border-t border-white/20 pt-5 text-center">
                <p class="font-['Alegreya'] text-xs tracking-wide">
                    Copyright 2026 Soladia Residences, All Rights Reserved
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
