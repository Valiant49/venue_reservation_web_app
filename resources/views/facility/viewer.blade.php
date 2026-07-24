<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        #viewer {
            width: 100vw;
            height: 100dvh;
        }
    </style>

    @include('layouts.navigation')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <div class="relative w-screen h-[100dvh]">

        <div id="viewer" class="absolute inset-0"></div>

        <a
            href="{{ route('public.facility') }}"
            class="absolute top-4 left-4 z-50
                rounded-lg bg-primary
                px-3 py-2 sm:px-4 sm:py-2
                text-sm sm:text-base
                shadow-lg backdrop-blur
                hover:bg-primary-hover transition text-white"
        >
            ← Back
    </a>

    </div>

    <script>
        window.MODEL_PATH = @json(asset("/models/{$model}.glb"));
        console.log(window.MODEL_PATH)
    </script>

    @vite('resources/js/facility-viewer.js')
</body>

</html>
