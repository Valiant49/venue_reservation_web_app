<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600&family=Cormorant+Garamond:wght@500;600;700&family=Nunito:wght@300;400;500;600&display=swap"
        rel="stylesheet"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-background font-['Nunito'] text-[#353535]">

    @include('layouts.navigation')

    <!-- ================= HERO ================= -->
    <section class="relative h-[350px] w-full">
        <img src="{{ asset('images/hero.jpg') }}" alt="Hero Banner" class="h-full w-full object-cover">
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
                <img src="{{ asset('images/functionhall copy.jpg') }}" alt="Function Hall"
                    class="h-[360px] w-full rounded-xl object-cover shadow-xl">
            </div>
        </div>
    </section>

    <!-- ================= AQUATIC CENTER ================= -->
    <section class="bg-white py-20">
        <div class="mx-auto max-w-6xl px-8">
            <!-- PARTY POOL -->
            <div class="mb-24 grid items-center gap-16 lg:grid-cols-2">
                <div>
                    <img src="{{ asset('images/pool.png') }}" alt="Party Pool"
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

        </div>
    </section>

    <!-- ================= SPORTS COMPLEX ================= -->
    <section class="bg-background py-24">
        <div class="mx-auto max-w-6xl px-8">
            <div class="grid items-center gap-16 lg:grid-cols-2">
                <!-- LEFT -->
                <div class="order-2 lg:order-1">
                    <h2 class="font-['Cormorant_Garamond'] text-5xl font-semibold">
                        Sports Area
                    </h2>
                    <p class="mt-6 leading-8 text-gray-600">
                        Designed for both action-packed basketball games and fast-paced badminton matches,
                        our versatile sports field offers a high-energy venue for players of all skill levels.
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
                    <img src="{{ asset('images/court.png') }}" alt="Basketball Court"
                        class="h-[360px] w-full rounded-xl object-cover shadow-xl duration-300 hover:scale-105">
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CLUBHOUSE ================= -->
    <section class="bg-white py-24">
        <div class="mx-auto max-w-6xl px-8">
            <div class="mb-24 grid items-center gap-16 lg:grid-cols-2">
                <div>
                    <img src="{{ asset('images/clubhouse.jpg') }}" alt="Clubhouse"
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
                        <a href="{{ route('public.facility.viewer', 'clubhouse') }}"
                            class="rounded-md border border-[#284b63] px-8 py-3 text-[#284b63] duration-300 hover:bg-[#284b63] hover:text-white">
                            Preview
                        </a>
                        <button class="rounded-md bg-[#284b63] px-8 py-3 text-white duration-300 hover:bg-[#12364d]">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= INQUIRY ================= -->
    <x-inquiry></x-inquiry>

    <x-public-footer></x-public-footer>


</body>
</html>
