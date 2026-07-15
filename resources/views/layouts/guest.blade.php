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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-primary">

            <div class="w-full sm:max-w-md mt- px-6 py-4 bg-surface  shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex flex-col justify-center align-center p-10 pb-0 m-auto">
                    <a href="/" class="mx-auto">
                        <x-application-logo class="w-20 h-20 fill-current text-primary" />
                    </a>
                    <h1 class="font-bold text-2xl text-center text-text">Soladia Residences</h1>
                    <h2 class="font-bold text-2xl text-center text-text-secondary">HOA Staff Portal</h2>
                </div>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
