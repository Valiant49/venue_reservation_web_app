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

    {{-- This is the About Us page. --}}

     <!-- ================= ABOUT US ================= -->
    <section class="bg-white py-16 sm:py-20 lg:py-24 px-6 sm:px-10 lg:px-[90px]">
        <div class="max-w-[1400px] mx-auto">

            <h2 class="font-cormorant text-4xl sm:text-5xl lg:text-6xl text-[#111] mb-8 sm:mb-10 lg:mb-14">
                About Us
            </h2>

            <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-start">

                <img src="./assets/images/black.jpg" alt="Soladia community aerial view"
                     class="w-full lg:w-1/2 h-[260px] sm:h-[340px] lg:h-[420px] object-cover">

                <div class="w-full lg:w-1/2 flex flex-col">
                    <p class="font-alegreya text-base sm:text-lg leading-7 sm:leading-8 text-gray-800">
                        Soladia is a residential community built around the idea that a home
                        is more than just a house — it's the parks where kids play, the
                        clubhouse where neighbors gather, and the quiet streets that make a
                        place feel safe. Our Homeowners Association (HOA) exists to protect
                        and grow that feeling for every family who calls Soladia home,
                        managing shared spaces, upholding community standards, and giving
                        residents a direct voice in how our neighborhood grows.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= HISTORY ================= -->
    <section class="bg-white py-16 sm:py-20 lg:py-24 px-6 sm:px-10 lg:px-[90px]">
        <div class="max-w-[1400px] mx-auto">

            <h2 class="font-cormorant text-4xl sm:text-5xl lg:text-6xl text-[#111] mb-8 sm:mb-10 lg:mb-14">
                Our History
            </h2>

            <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-start">

                <img src="./assets/images/black.jpg" alt="Soladia development history"
                     class="w-full lg:w-1/2 h-[260px] sm:h-[340px] lg:h-[420px] object-cover">

                <div class="w-full lg:w-1/2 flex flex-col">
                    <p class="font-alegreya text-base sm:text-lg leading-7 sm:leading-8 text-gray-800">
                        Soladia began as a shared vision among its earliest homeowners: a
                        community where thoughtful design and genuine neighborliness could
                        grow side by side. What started as a handful of streets has grown
                        into a full residential district with dedicated recreation facilities,
                        function spaces, and an active homeowners' association that
                        continues the same founding principle — that a well-run community
                        is built by the people who live in it, not just for them.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= VISION & MISSION ================= -->
    <section class="bg-primary py-16 sm:py-20 lg:py-24 px-6 sm:px-10 lg:px-[90px]">
        <div class="max-w-[1400px] mx-auto">

            <h2 class="font-cormorant text-4xl sm:text-5xl lg:text-6xl text-white mb-8 sm:mb-10 lg:mb-14">
                Vision & Mission
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">

                <div>
                    <h3 class="font-alegreya font-medium text-white text-xl sm:text-2xl mb-3">
                        Our Vision
                    </h3>
                    <p class="font-alegreya text-base sm:text-lg leading-7 sm:leading-8 text-gray-200">
                        To be a residential community recognized for its well-maintained
                        facilities, strong sense of belonging, and responsible, transparent
                        governance — a place families choose to grow in for generations.
                    </p>
                </div>

                <div>
                    <h3 class="font-alegreya font-medium text-white text-xl sm:text-2xl mb-3">
                        Our Mission
                    </h3>
                    <p class="font-alegreya text-base sm:text-lg leading-7 sm:leading-8 text-gray-200">
                        To manage and preserve Soladia's shared spaces and services with
                        integrity, to represent the interests of every homeowner fairly, and
                        to foster a safe, connected, and welcoming environment where residents
                        can genuinely live their life.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <x-public-footer></x-public-footer>

</body>

</html>
