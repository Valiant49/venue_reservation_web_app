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
                        <a href="{{ route('public.home') }}" class="block hover:underline">Home</a>
                        <a href="{{ route('public.facility') }}" class="block hover:underline">Facilities</a>
                        <a href="{{ route('public.about') }}" class="block hover:underline">About us</a>
                        <a href="{{ route('public.contact') }}" class="block hover:underline">Contact us</a>
                        <a href="{{ route('resident.my-reservations') }}" class="block hover:underline">Reserve a Facility</a>
                    </div>
                </div>
                <!-- Policy -->
                <div class="text-left">
                    <h3 class="mb-4 font-['Cormorant_Garamond'] text-2xl">
                        Policy
                    </h3>
                    <div class="space-y-1 font-['Alegreya'] text-sm leading-6">
                        <a href="{{ route('public.privacy-policy') }}" class="block hover:underline">Privacy Policy</a>
                        <a href="{{ route('public.toc') }}" class="block hover:underline">Terms and Conditions</a>
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
