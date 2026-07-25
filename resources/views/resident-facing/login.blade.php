<html>


<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<div class="min-h-screen flex items-center justify-center bg-[#1B3A52] px-4 py-8">
    <div class="w-full max-w-3xl bg-white rounded shadow-xl flex flex-col md:flex-row overflow-hidden">

        {{-- Image: compact banner on mobile, full side panel on desktop --}}
        <div class="hidden md:block md:w-1/2 bg-gray-300">
            <img src="{{ asset('images/resident-login-side.jpg') }}"
                alt=""
                class="w-full h-full object-cover" />
        </div>

        {{-- Right panel / form --}}
        <div class="w-full md:w-1/2 p-6 sm:p-8 md:p-10 flex flex-col justify-center">

            <div class="flex flex-col items-center mb-6 md:mb-8">
                <x-application-logo class="h-12 w-12 md:h-14 md:w-14 mb-3" />
                <p class="text-sm tracking-wide font-semibold text-[#1B3A52]">
                    SOLADIA RESIDENCES
                </p>
            </div>

            <h1 class="text-lg md:text-xl font-bold text-center text-[#1B3A52] mb-6">
                RESIDENT SIGN IN
            </h1>

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('resident.login.store') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="email" class="block text-sm font-medium text-[#1B3A52] mb-1">
                        {{ __('Email') }}
                    </x-input-label>
                    <x-text-input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="username"
                           class="w-full rounded border-gray-300 focus:border-[#1B3A52] focus:ring-[#1B3A52] text-sm" />
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <x-input-label for="password" class="block text-sm font-medium text-[#1B3A52] mb-1">
                        {{ __('Password') }}
                    </x-input-label>
                    <x-text-input id="password"
                           type="password"
                           name="password"
                           required
                           autocomplete="current-password"
                           class="w-full rounded border-gray-300 focus:border-[#1B3A52] focus:ring-[#1B3A52] text-sm" />
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-6">
                    <x-input-label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#1B3A52] focus:ring-[#1B3A52] mr-2">
                        {{ __('Remember Me') }}
                    </x-input-label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#1B3A52] hover:underline">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full bg-[#1B3A52] text-white font-semibold tracking-wide py-3 rounded hover:bg-[#12283A] transition">
                    {{ __('SIGN IN') }}
                </button>
            </form>
            <div class="text-sm tracking-wide font-medium text-primary/75 text-center m-1">
                <span>Don't have an account?</span>
                <a href="{{ route('resident.register') }}" class="font-medium hover:font-bold hover:text-primary/100">
                    Register.
                </a>
            </div>
        </div>
    </div>
</div>

</html>
