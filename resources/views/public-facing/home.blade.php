<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Reservation System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-nunito bg-[#fafafa] text-[#353535]">

    @include('layouts.navigation')

    <!-- ================= HERO SECTION ================= -->
    <section class="relative flex min-h-screen w-full flex-col overflow-visible sm:h-screen sm:overflow-hidden">

        <img src="{{ asset('images/hero.jpg') }}" alt="Hero Image" class="block h-[55vh] w-full flex-none object-cover">

        <div class="bg-primary flex flex-1 flex-col justify-start px-6 sm:px-10 lg:px-[90px]">

            <h1
                class="font-cormorant mt-[0.3em] text-[clamp(3.5rem,15vw,8.75rem)] font-semibold leading-[0.95] text-white sm:-mt-[0.4em] sm:text-[clamp(2rem,6vw,8.75rem)] lg:-mt-[0.5em]">
                LIVE<br class="sm:hidden"> YOUR<br class="sm:hidden"> LIFE
            </h1>

            <p
                class="mb-4 mt-4 font-serif text-[clamp(1.15rem,3.2vw,3rem)] font-normal leading-[1.3] text-white sm:mt-5 sm:text-[clamp(1rem,2.2vw,3rem)]">
                Socialize, exercise, and play in {{-- <br> --}} Soladia
            </p>

            <a class="hover:bg-primary-hover mt-4 w-[10%] rounded-md bg-white px-2 py-4 text-center text-2xl transition duration-300 hover:text-white"
                href="{{ route('public.facility') }}">Explore</a>
        </div>
    </section>

    <!-- ================= ABOUT SECTION ================= -->
    <section class="bg-white px-6 py-16 sm:px-10 sm:py-20 lg:px-[90px] lg:py-24">
        <div class="mx-auto max-w-6xl">

            <h2 class="font-cormorant mb-8 text-4xl text-[#111] sm:mb-10 sm:text-5xl lg:mb-14 lg:text-6xl">
                About Soladia
            </h2>

            <div class="flex flex-col items-start gap-8 lg:flex-row lg:gap-16">

                <!-- Image -->
                <img src="{{ asset('images/about us.jpg') }}" alt="Aerial view of Soladia community"
                    class="h-[260px] w-full object-cover sm:h-[340px] lg:h-[420px] lg:w-1/2 rounded-bl-lg rounded-tr-lg">

                <!-- Text + Button -->
                <div class="flex w-full flex-col lg:w-1/2">
                    <p class="font-alegreya text-base leading-7 text-gray-800 sm:text-lg sm:leading-8">
                        Soladia is a residential community built around the idea that a home
                        is more than just a house — it's the parks where kids play, the
                        clubhouse where neighbors gather, and the quiet streets that make a
                        place feel safe. Our Homeowners Association (HOA) exists to protect
                        and grow that feeling for every family who calls Soladia home,
                        managing shared spaces, upholding community standards, and giving
                        residents a direct voice in how our neighborhood grows.
                    </p>

                    <button
                        class="bg-primary font-alegreya hover:bg-primary-hover mt-6 w-fit px-7 py-3 text-sm font-medium tracking-wide text-white transition duration-300 sm:mt-8 sm:text-base"
                        href={{ route('public.about') }}>
                        READ MORE
                    </button>

                </div>

            </div>

        </div>
    </section>

    <!-- ================= FACILITIES SECTION ================= -->
    <section class="bg-white px-6 py-16 sm:px-10 sm:py-20 lg:px-[90px] lg:py-24">
        <div class="mx-auto max-w-6xl">

            <h2 class="font-cormorant mb-10 text-4xl text-[#111] sm:mb-12 sm:text-5xl lg:mb-16 lg:text-6xl">
                Facilities Available
            </h2>

            <!-- Function Hall feature -->
            <div class="mb-14 flex flex-col items-start gap-6 sm:mb-16 lg:mb-20 lg:flex-row lg:gap-10">

                <div class="order-2 w-full lg:order-1 lg:w-1/2">
                    <h3 class="font-cormorant mb-3 text-2xl text-[#111] sm:mb-4 sm:text-3xl">
                        Function Hall
                    </h3>
                    <p class="font-alegreya text-sm leading-6 text-gray-700 sm:text-base sm:leading-7">
                        The Function Hall is Soladia's go-to venue for life's bigger moments —
                        birthdays, reunions, community assemblies, and everything in between.
                        With flexible seating for up to 150 guests, a full catering kitchen,
                        and a private entrance separate from the residential areas, it's
                        built to host without ever disrupting the neighborhood around it.
                        Residents can reserve the hall directly through the front desk or
                        the online booking form.
                    </p>
                </div>

                <img src="{{ asset('images/functionhall copy.jpg') }}" alt="Function hall interior"
                    class="order-1 h-[220px] w-full object-cover sm:h-[280px] lg:order-2 lg:h-[320px] lg:w-1/2 rounded-tr-lg rounded-bl-lg">

            </div>

            <!-- Facility cards grid -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3">

                <!-- Aquatic Center -->
                <div class="flex flex-col">
                    <img src="{{ asset('images/pool.png') }}" alt="Aquatic Center"
                        class="h-[160px] w-full object-cover sm:h-[180px] rounded-tr-lg">
                    <div class="bg-primary flex flex-1 flex-col px-4 py-5 rounded-bl-lg">
                        <h4 class="font-alegreya mb-2 text-lg font-medium text-white sm:text-xl">
                            Aquatic Center
                        </h4>
                        <p class="flex-1 font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                            A resort-style pool with a dedicated lap lane, shallow kids' area,
                            and shaded lounge deck — open daily for residents and their guests.
                        </p>
                        <button
                            class="font-nunito hover:text-primary mt-4 w-fit border border-white px-5 py-2 text-xs font-bold text-white transition duration-300 hover:bg-white sm:text-sm">
                            EXPLORE
                        </button>
                    </div>
                </div>

                <!-- The Clubhouse -->
                <div class="flex flex-col">
                    <img src="{{ asset('images/clubhouse.png') }}" alt="The Clubhouse"
                        class="h-[160px] w-full object-cover sm:h-[180px] rounded-tr-lg">
                    <div class="bg-primary flex flex-1 flex-col px-4 py-5 rounded-bl-lg">
                        <h4 class="font-alegreya mb-2 text-lg font-medium text-white sm:text-xl">
                            The Clubhouse
                        </h4>
                        <p class="flex-1 font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                            An open-air pavilion framed by a soaring pitched roof, surrounded by
                            landscaped gardens and a lantern-lit walkway — a peaceful spot for
                            residents to unwind or host a quiet gathering.
                        </p>
                        <button
                            class="font-nunito hover:text-primary mt-4 w-fit border border-white px-5 py-2 text-xs font-bold text-white transition duration-300 hover:bg-white sm:text-sm">
                            EXPLORE
                        </button>
                    </div>
                </div>

                <!-- Sports Complex -->
                <div class="flex flex-col">
                    <img src="{{ asset('images/court.png') }}" alt="Sports Complex"
                        class="h-[160px] w-full object-cover sm:h-[180px] rounded-tr-lg">
                    <div class="bg-primary flex flex-1 flex-col px-4 py-5 rounded-bl-lg">
                        <h4 class="font-alegreya mb-2 text-lg font-medium text-white sm:text-xl">
                            Sports Complex
                        </h4>
                        <p class="flex-1 font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                            Multi-purpose courts for basketball and badminton, plus an outdoor
                            fitness area — open from sunrise to sunset for residents who like
                            to stay active.
                        </p>
                        <button
                            class="font-nunito hover:text-primary mt-4 w-fit border border-white px-5 py-2 text-xs font-bold text-white transition duration-300 hover:bg-white sm:text-sm">
                            EXPLORE
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= HOW IT WORKS SECTION ================= -->
    <section class="bg-primary px-6 py-10 sm:px-10 sm:py-12 lg:px-[90px] lg:py-14">
        <div class="mx-auto max-w-6xl">

            <h2 class="font-cormorant mb-6 text-3xl text-white sm:mb-8 sm:text-4xl lg:mb-10 lg:text-5xl">
                How it Works
            </h2>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 sm:gap-6 lg:gap-10">

                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="mb-5 flex aspect-square w-full max-w-[140px] items-center justify-center rounded-full bg-white sm:mb-6 sm:max-w-[160px] lg:max-w-[180px]">
                        <svg class="text-primary h-1/2 w-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6 21v-3.375c0-.621.504-1.125 1.125-1.125h1.5c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                    <h3 class="font-alegreya mb-3 text-lg font-medium text-white sm:text-xl">
                        Select a Facility
                        <br>
                        Step 1
                    </h3>
                    <p class="font-['Source_Sans_Pro'] text-sm leading-6 text-gray-200 sm:text-base">
                        Browse the facilities page and pick the space that fits your event —
                        from the Function Hall for big gatherings to the Conference Room
                        for something smaller.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="mb-5 flex aspect-square w-full max-w-[140px] items-center justify-center rounded-full bg-white sm:mb-6 sm:max-w-[160px] lg:max-w-[180px]">
                        <svg class="text-primary h-1/2 w-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 16.5l1.5 1.5 3-3.5" />
                        </svg>
                    </div>
                    <h3 class="font-alegreya mb-3 text-lg font-medium text-white sm:text-xl">
                        Submit Reservation
                        <br>
                        Step 2
                    </h3>
                    <p class="font-['Source_Sans_Pro'] text-sm leading-6 text-gray-200 sm:text-base">
                        Fill out the reservation form with your preferred date and time.
                        Our team confirms availability and gets back to you within 24 hours.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="mb-5 flex aspect-square w-full max-w-[140px] items-center justify-center rounded-full bg-white sm:mb-6 sm:max-w-[160px] lg:max-w-[180px]">
                        <svg class="text-primary h-1/2 w-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                    </div>
                    <h3 class="font-alegreya mb-3 text-lg font-medium text-white sm:text-xl">
                        Pay, then Enjoy
                        <br>
                        Step 3
                    </h3>
                    <p class="font-['Source_Sans_Pro'] text-sm leading-6 text-gray-200 sm:text-base">
                        Settle the reservation fee, and the space is yours. Show up, enjoy
                        the event, and let us handle the rest.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= TESTIMONIALS SECTION ================= -->
    <section class="bg-white px-6 py-16 sm:px-10 sm:py-20 lg:px-[90px] lg:py-24">
        <div class="mx-auto max-w-6xl">

            <h2 class="font-cormorant mb-2 text-4xl text-[#111] sm:mb-3 sm:text-5xl lg:text-6xl">
                Community Testimonials
            </h2>

            <p class="font-alegreya mb-10 text-sm italic text-gray-600 sm:mb-12 sm:text-base lg:mb-16">
                Hear directly from our residents about their everyday experiences.
            </p>

            <!-- MOBILE CAROUSEL (hidden on sm and up) -->
            <div class="relative text-center sm:hidden">

                <input type="radio" name="testi" id="t1" class="peer/t1 hidden" checked>
                <input type="radio" name="testi" id="t2" class="peer/t2 hidden">
                <input type="radio" name="testi" id="t3" class="peer/t3 hidden">
                <input type="radio" name="testi" id="t4" class="peer/t4 hidden">

                <div
                    class="bg-primary mt-10 hidden flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg peer-checked/t1:flex">
                    <img src="{{ asset('images/angela.jpg') }}" alt="Maria Santos"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Maria Santos</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Resident since 2021</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        Moving to Soladia was the best decision for our family. The kids
                        have made so many friends at the pool, and the community events
                        make it feel like everyone actually knows each other.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 hidden flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg peer-checked/t2:flex">
                    <img src="{{ asset('images/james.jpg') }}" alt="James Reyes"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">James Reyes</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Resident since 2019</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        I book the Conference Room almost every week for work calls — it's
                        quiet, reliable, and just a short walk from my house. Small thing,
                        but it's made working from home so much easier.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 hidden flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg peer-checked/t3:flex">
                    <img src="{{ asset('images/angela.jpg') }}" alt="Angela Cruz"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Angela Cruz</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Resident since 2022</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        We hosted my daughter's birthday at the Function Hall and it was
                        perfect — spacious, easy to book, and the staff were genuinely
                        helpful the whole time.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 hidden flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg peer-checked/t4:flex">
                    <img src="{{ asset('images/daniel.jpg') }}" alt="Daniel Lim"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Daniel Lim</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Resident since 2020</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        The Sports Complex gets used constantly in our house — my son plays
                        basketball there almost every afternoon. It's great having somewhere
                        safe and close by for him to go.
                    </p>
                </div>

                <label for="t4"
                    class="bg-primary absolute left-0 top-1/2 hidden h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white peer-checked/t1:flex">‹</label>
                <label for="t2"
                    class="bg-primary absolute right-0 top-1/2 hidden h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white peer-checked/t1:flex">›</label>

                <label for="t1"
                    class="bg-primary absolute left-0 top-1/2 hidden h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white peer-checked/t2:flex">‹</label>
                <label for="t3"
                    class="bg-primary absolute right-0 top-1/2 hidden h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white peer-checked/t2:flex">›</label>

                <label for="t2"
                    class="bg-primary absolute left-0 top-1/2 hidden h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white peer-checked/t3:flex">‹</label>
                <label for="t4"
                    class="bg-primary absolute right-0 top-1/2 hidden h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white peer-checked/t3:flex">›</label>

                <label for="t3"
                    class="bg-primary absolute left-0 top-1/2 hidden h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white peer-checked/t4:flex">‹</label>
                <label for="t1"
                    class="bg-primary absolute right-0 top-1/2 hidden h-9 w-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full text-white peer-checked/t4:flex">›</label>

                <label for="t1"
                    class="peer-checked/t1:bg-primary peer-checked/t1:ring-primary mx-1 mt-6 inline-block h-3 w-3 cursor-pointer rounded-full bg-gray-300 transition-all duration-300 active:scale-75 peer-checked/t1:scale-150 peer-checked/t1:ring-2 peer-checked/t1:ring-offset-2"></label>
                <label for="t2"
                    class="peer-checked/t2:bg-primary peer-checked/t2:ring-primary mx-1 mt-6 inline-block h-3 w-3 cursor-pointer rounded-full bg-gray-300 transition-all duration-300 active:scale-75 peer-checked/t2:scale-150 peer-checked/t2:ring-2 peer-checked/t2:ring-offset-2"></label>
                <label for="t3"
                    class="peer-checked/t3:bg-primary peer-checked/t3:ring-primary mx-1 mt-6 inline-block h-3 w-3 cursor-pointer rounded-full bg-gray-300 transition-all duration-300 active:scale-75 peer-checked/t3:scale-150 peer-checked/t3:ring-2 peer-checked/t3:ring-offset-2"></label>
                <label for="t4"
                    class="peer-checked/t4:bg-primary peer-checked/t4:ring-primary mx-1 mt-6 inline-block h-3 w-3 cursor-pointer rounded-full bg-gray-300 transition-all duration-300 active:scale-75 peer-checked/t4:scale-150 peer-checked/t4:ring-2 peer-checked/t4:ring-offset-2"></label>

            </div>

            <!-- DESKTOP/TABLET GRID (hidden on mobile) -->
            <div class="hidden gap-x-6 gap-y-12 sm:grid sm:grid-cols-2 sm:gap-x-8 lg:grid-cols-4 lg:gap-x-6">

                <div
                    class="bg-primary mt-10 flex flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg">
                    <img src="{{ asset('images/maria.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover sm:h-24 sm:w-24">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Maria Santos</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Resident since 2021</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        Moving to Soladia was the best decision for our family. The kids
                        have made so many friends at the pool, and the community events
                        make it feel like everyone actually knows each other.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 flex flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg">
                    <img src="{{ asset('images/james.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover sm:h-24 sm:w-24">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">James Reyes</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Resident since 2019</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        We booked the Function Hall for our family reunion last year and it
                        was perfect — plenty of space, easy to reserve, and the staff made
                        the whole day stress-free.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 flex flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg">
                    <img src="{{ asset('images/angela.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover sm:h-24 sm:w-24">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Angela Cruz</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Resident since 2022</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        We hosted my daughter's birthday at the Function Hall and it was
                        perfect — spacious, easy to book, and the staff were genuinely
                        helpful the whole time.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 flex flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg">
                    <img src="{{ asset('images/daniel.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover sm:h-24 sm:w-24">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Daniel Lim</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Resident since 2020</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        The Sports Complex gets used constantly in our house — my son plays
                        basketball there almost every afternoon. It's great having somewhere
                        safe and close by for him to go.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= INQUIRY ================= -->
    <x-inquiry></x-inquiry>

    <x-public-footer></x-public-footer>

</body>

</html>
