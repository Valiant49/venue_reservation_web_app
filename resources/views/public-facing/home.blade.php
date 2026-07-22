<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Reservation System</title>

    <!-- Tailwind CDN (preview only — swap for Vite build in Laravel) -->
    {{-- <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#284b63",
                        "primary-hover": "#12364d",
                        secondary: "#d9d9d9",
                    },
                    fontFamily: {
                        cormorant: ["Cormorant Garamond", "serif"],
                        alegreya: ["Alegreya", "serif"],
                        nunito: ["Nunito", "sans-serif"],
                    },
                },
            },
        };
    </script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600&family=Cormorant+Garamond:wght@600&family=Nunito:wght@400;700;800&display=swap"
        rel="stylesheet"> --}}
</head>

<body class="font-nunito bg-[#fafafa] text-[#353535]">

    @include('layouts.navigation')

    <!-- ================= HERO SECTION ================= -->
    <section class="relative flex min-h-screen w-full flex-col overflow-visible sm:h-screen sm:overflow-hidden">

        <img src="{{ asset('images/hero.jpg') }}" alt="Hero Image" class="block h-[55vh] w-full flex-none object-cover">

        <div class="bg-primary flex flex-1 flex-col justify-start px-6 sm:px-10 lg:px-[90px]">

            <h1 class="font-cormorant -mt-[0.3em] text-[clamp(3.5rem,15vw,8.75rem)] font-semibold leading-[0.95] text-white sm:-mt-[0.4em] sm:text-[clamp(2rem,6vw,8.75rem)] lg:-mt-[0.5em]">
                LIVE<br class="sm:hidden"> YOUR<br class="sm:hidden"> LIFE
            </h1>

            <p class="font-serif mt-4 mb-4 text-[clamp(1.15rem,3.2vw,3rem)] font-normal leading-[1.3] text-white sm:mt-5 sm:text-[clamp(1rem,2.2vw,3rem)]">
                Socialize, exercise, and play in {{-- <br> --}} Soladia
            </p>

            <a class="bg-white w-[10%] px-2 py-4 mt-4 text-center text-2xl hover:bg-primary-hover hover:text-white transition duration-300 rounded-md"
                href="{{ route('public.facility') }}">Explore</a>
        </div>
    </section>

    <!-- ================= ABOUT SECTION ================= -->
    <section class="bg-white px-6 py-16 sm:px-10 sm:py-20 lg:px-[90px] lg:py-24">
        <div class="mx-auto max-w-[1400px]">

            <h2 class="font-cormorant mb-8 text-4xl text-[#111] sm:mb-10 sm:text-5xl lg:mb-14 lg:text-6xl">
                About Soladia
            </h2>

            <div class="flex flex-col items-start gap-8 lg:flex-row lg:gap-16">

                <!-- Image -->
                <img src="{{ asset('images/black.jpg') }}" alt="Aerial view of Soladia community"
                    class="h-[260px] w-full object-cover sm:h-[340px] lg:h-[420px] lg:w-1/2">

                <!-- Text + Button -->
                <div class="flex w-full flex-col lg:w-1/2">

                    <p class="font-alegreya text-base leading-7 text-gray-800 sm:text-lg sm:leading-8">
                        Cupcake ipsum dolor sit amet chocolate. Pastry jelly-o cotton candy carrot
                        cake candy canes bear claw bonbon donut. Halvah sugar plum tiramisu toffee
                        wafer cookie. Lemon drops pie jujubes carrot cake tiramisu oat cake jelly.
                        Macaroon dragée jujubes dessert carrot cake donut dragée. Caramels lemon
                        drops cotton candy cookie marshmallow ice cream tootsie roll.
                    </p>

                    <button class="bg-primary font-alegreya hover:bg-primary-hover mt-6 w-fit px-7 py-3 text-sm font-medium tracking-wide text-white transition duration-300 sm:mt-8 sm:text-base"
                        href={{route('public.about')}}>
                        READ MORE
                    </button>

                </div>

            </div>

        </div>
    </section>

    <!-- ================= FACILITIES SECTION ================= -->
    <section class="bg-white px-6 py-16 sm:px-10 sm:py-20 lg:px-[90px] lg:py-24">
        <div class="mx-auto max-w-[1400px]">

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
                        Cupcake ipsum dolor sit amet gummies tootsie roll soufflé sweet roll.
                        Candy canes lemon drops sugar plum sesame snaps gingerbread cotton
                        candy sweet pudding cake. Tiramisu pie muffin chocolate cake bonbon
                        chocolate bar biscuit shortbread. Cookie jujubes powder croissant tiramisu
                        sugar plum donut. Gummies jelly cake bonbon liquorice donut gummi
                        bears. Jelly jelly-o dessert biscuit chocolate. Cake tart biscuit chocolate bar
                        gummies.
                    </p>
                </div>

                <img src="{{ asset('images/black.jpg') }}" alt="Function hall interior"
                    class="order-1 h-[220px] w-full object-cover sm:h-[280px] lg:order-2 lg:h-[320px] lg:w-1/2">

            </div>

            <!-- Facility cards grid -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">

                <!-- Card template x4 -->
                <div class="flex flex-col">
                    <img src="{{ asset('images/black.jpg') }}" alt="Aquatic Center"
                        class="h-[160px] w-full object-cover sm:h-[180px]">
                    <div class="bg-primary flex flex-1 flex-col px-4 py-5">
                        <h4 class="font-alegreya mb-2 text-lg font-medium text-white sm:text-xl">
                            Aquatic Center
                        </h4>
                        <p class="flex-1 font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                            Cupcake ipsum dolor sit amet topping danish. Tiramisu tootsie roll halvah
                            marzipan cupcake gummies gummies. Candy canes apple pie pie apple pie
                            fruitcake.
                        </p>
                        <button
                            class="font-nunito hover:text-primary mt-4 w-fit border border-white px-5 py-2 text-xs font-bold text-white transition duration-300 hover:bg-white sm:text-sm">
                            EXPLORE
                        </button>
                    </div>
                </div>

                <div class="flex flex-col">
                    <img src="{{ asset('images/black.jpg') }}" alt="The Clubhouse"
                        class="h-[160px] w-full object-cover sm:h-[180px]">
                    <div class="bg-primary flex flex-1 flex-col px-4 py-5">
                        <h4 class="font-alegreya mb-2 text-lg font-medium text-white sm:text-xl">
                            The Clubhouse
                        </h4>
                        <p class="flex-1 font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                            Cupcake ipsum dolor sit amet topping danish. Tiramisu tootsie roll halvah
                            marzipan cupcake gummies gummies. Candy canes apple pie pie apple pie
                            fruitcake.
                        </p>
                        <button
                            class="font-nunito hover:text-primary mt-4 w-fit border border-white px-5 py-2 text-xs font-bold text-white transition duration-300 hover:bg-white sm:text-sm">
                            EXPLORE
                        </button>
                    </div>
                </div>

                <div class="flex flex-col">
                    <img src="{{ asset('images/black.jpg') }}" alt="Sports Complex"
                        class="h-[160px] w-full object-cover sm:h-[180px]">
                    <div class="bg-primary flex flex-1 flex-col px-4 py-5">
                        <h4 class="font-alegreya mb-2 text-lg font-medium text-white sm:text-xl">
                            Sports Complex
                        </h4>
                        <p class="flex-1 font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                            Cupcake ipsum dolor sit amet topping danish. Tiramisu tootsie roll halvah
                            marzipan cupcake gummies gummies. Candy canes apple pie pie apple pie
                            fruitcake.
                        </p>
                        <button
                            class="font-nunito hover:text-primary mt-4 w-fit border border-white px-5 py-2 text-xs font-bold text-white transition duration-300 hover:bg-white sm:text-sm">
                            EXPLORE
                        </button>
                    </div>
                </div>

                <div class="flex flex-col">
                    <img src="{{ asset('images/black.jpg') }}" alt="Conference Room"
                        class="h-[160px] w-full object-cover sm:h-[180px]">
                    <div class="bg-primary flex flex-1 flex-col px-4 py-5">
                        <h4 class="font-alegreya mb-2 text-lg font-medium text-white sm:text-xl">
                            Conference Room
                        </h4>
                        <p class="flex-1 font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                            Cupcake ipsum dolor sit amet topping danish. Tiramisu tootsie roll halvah
                            marzipan cupcake gummies gummies. Candy canes apple pie pie apple pie
                            fruitcake.
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
        <div class="mx-auto max-w-[1400px]">

            <h2 class="font-cormorant mb-6 text-3xl text-white sm:mb-8 sm:text-4xl lg:mb-10 lg:text-5xl">
                How it Works
            </h2>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 sm:gap-6 lg:gap-10">

                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-secondary mb-5 aspect-square w-full max-w-[140px] sm:mb-6 sm:max-w-[160px] lg:max-w-[180px]">
                    </div>
                    <h3 class="font-alegreya mb-3 text-lg font-medium text-white sm:text-xl">
                        Select a Facility
                        <br>
                        Step 1
                    </h3>
                    <p class="font-['Source_Sans_Pro'] text-sm leading-6 text-gray-200 sm:text-base">
                        Cupcake ipsum dolor sit amet cotton candy cake.
                        Chocolate cake liquorice apple pie jelly beans sweet.
                        Bear claw donut marzipan marzipan carrot cake
                        muffin chupa chups pudding.
                    </p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-secondary mb-5 aspect-square w-full max-w-[140px] sm:mb-6 sm:max-w-[160px] lg:max-w-[180px]">
                    </div>
                    <h3 class="font-alegreya mb-3 text-lg font-medium text-white sm:text-xl">
                        Submit Reservation
                        <br>
                        Step 2
                    </h3>
                    <p class="font-['Source_Sans_Pro'] text-sm leading-6 text-gray-200 sm:text-base">
                        Cupcake ipsum dolor sit amet cotton candy cake.
                        Chocolate cake liquorice apple pie jelly beans sweet.
                        Bear claw donut marzipan marzipan carrot cake
                        muffin chupa chups pudding.
                    </p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-secondary mb-5 aspect-square w-full max-w-[140px] sm:mb-6 sm:max-w-[160px] lg:max-w-[180px]">
                    </div>
                    <h3 class="font-alegreya mb-3 text-lg font-medium text-white sm:text-xl">
                        Pay, then Enjoy
                        <br>
                        Step 3
                    </h3>
                    <p class="font-['Source_Sans_Pro'] text-sm leading-6 text-gray-200 sm:text-base">
                        Cupcake ipsum dolor sit amet cotton candy cake.
                        Chocolate cake liquorice apple pie jelly beans sweet.
                        Bear claw donut marzipan marzipan carrot cake
                        muffin chupa chups pudding.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= TESTIMONIALS SECTION ================= -->
    <section class="bg-white px-6 py-16 sm:px-10 sm:py-20 lg:px-[90px] lg:py-24">
        <div class="mx-auto max-w-[1400px]">

            <h2 class="font-cormorant mb-2 text-4xl text-[#111] sm:mb-3 sm:text-5xl lg:text-6xl">
                Community Testimonials
            </h2>

            <p class="font-alegreya mb-10 text-sm italic text-gray-600 sm:mb-12 sm:text-base lg:mb-16">
                Jelly beans cake oat cake marzipan danish jelly-o muffin caramels chocolate — I love pastry sweet roll
                lemon drops
            </p>

            <!-- MOBILE CAROUSEL (hidden on sm and up) -->
            <div class="relative text-center sm:hidden">

                <input type="radio" name="testi" id="t1" class="peer/t1 hidden" checked>
                <input type="radio" name="testi" id="t2" class="peer/t2 hidden">
                <input type="radio" name="testi" id="t3" class="peer/t3 hidden">
                <input type="radio" name="testi" id="t4" class="peer/t4 hidden">

                <div
                    class="bg-primary mt-10 hidden flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg peer-checked/t1:flex">
                    <img src="{{ asset('images/black.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover">
                    <h3 class="font-nunito text-base font-semibold text-white">Jane Doe 1</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300">Professional Human for 20 years</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200">
                        Jelly beans cake oat cake marzipan danish jelly-o muffin caramels chocolate.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 hidden flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg peer-checked/t2:flex">
                    <img src="{{ asset('images/black.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover">
                    <h3 class="font-nunito text-base font-semibold text-white">Jane Doe 2</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300">Professional Human for 20 years</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200">
                        I love pastry sweet roll lemon drops shortbread. Sweet roll oat cake gummies.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 hidden flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg peer-checked/t3:flex">
                    <img src="{{ asset('images/black.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover">
                    <h3 class="font-nunito text-base font-semibold text-white">Jane Doe 3</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300">Professional Human for 20 years</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200">
                        Sweet roll oat cake gummies toffee icing cake danish caramels chocolate.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 hidden flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg peer-checked/t4:flex">
                    <img src="{{ asset('images/black.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover">
                    <h3 class="font-nunito text-base font-semibold text-white">Jane Doe 4</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300">Professional Human for 20 years</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200">
                        Caramels lemon drops cotton candy cookie marshmallow ice cream tootsie roll.
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
                    <img src="{{ asset('images/black.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover sm:h-24 sm:w-24">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Jane Doe</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Professional Human for 20 years</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        Jelly beans cake oat cake marzipan danish jelly-o muffin caramels chocolate.
                        I love pastry sweet roll lemon drops shortbread. Sweet roll oat cake
                        gummies toffee icing cake.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 flex flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg">
                    <img src="{{ asset('images/black.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover sm:h-24 sm:w-24">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Jane Doe</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Professional Human for 20 years</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        Jelly beans cake oat cake marzipan danish jelly-o muffin caramels chocolate.
                        I love pastry sweet roll lemon drops shortbread. Sweet roll oat cake
                        gummies toffee icing cake.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 flex flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg">
                    <img src="{{ asset('images/black.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover sm:h-24 sm:w-24">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Jane Doe</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Professional Human for 20 years</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        Jelly beans cake oat cake marzipan danish jelly-o muffin caramels chocolate.
                        I love pastry sweet roll lemon drops shortbread. Sweet roll oat cake
                        gummies toffee icing cake.
                    </p>
                </div>

                <div
                    class="bg-primary mt-10 flex flex-col items-center rounded-xl px-5 pb-6 pt-12 text-center shadow-lg">
                    <img src="{{ asset('images/black.jpg') }}" alt="Jane Doe"
                        class="-mt-20 mb-4 h-20 w-20 rounded-full border-4 border-white object-cover sm:h-24 sm:w-24">
                    <h3 class="font-nunito text-base font-semibold text-white sm:text-lg">Jane Doe</h3>
                    <p class="font-nunito mb-3 text-xs text-gray-300 sm:text-sm">Professional Human for 20 years</p>
                    <p class="font-['Source_Sans_Pro'] text-xs leading-5 text-gray-200 sm:text-sm">
                        Jelly beans cake oat cake marzipan danish jelly-o muffin caramels chocolate.
                        I love pastry sweet roll lemon drops shortbread. Sweet roll oat cake
                        gummies toffee icing cake.
                    </p>
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
