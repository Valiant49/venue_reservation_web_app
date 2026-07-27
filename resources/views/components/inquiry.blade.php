<section class="bg-white py-20">
    <div class="mx-auto max-w-5xl px-8">
        <!-- Heading -->
        <h2 class="font-['Cormorant_Garamond'] text-6xl text-black">
            Inquiry
        </h2>
        <p class="mb-6 mt-1 font-['Alegreya'] text-sm text-black">
            We're here to help! Fill out the form below and our team will be in touch soon.
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
