<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="viewer" class="w-full h-[90vh]"></div>

    <script>
    window.MODEL_PATH = "/models/{{ $model }}.glb";
    console.log(window.MODEL_PATH)
    </script>

    @vite('resources/js/facility-viewer.js')
</body>
</html>
