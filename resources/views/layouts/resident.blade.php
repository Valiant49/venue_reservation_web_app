<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Login') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-surface min-h-screen">

        @include('layouts.navigation')

        <div>
            @isset($header)
                <header class="rounded-lg border-b-2 border-gray-800 shadow">
                    <div class="flex-1 p-5 sm:px-6 lg:px-8">
                        {{-- @yield('header') --}}
                        {{ $header ?? '' }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                {{-- @yield('content') --}}
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
