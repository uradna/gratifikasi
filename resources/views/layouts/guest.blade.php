<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="https://bkpsdm.ponorogo.go.id/wp-content/uploads/2017/07/cropped-logokab-32x32.png"
        sizes="32x32" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">

    <link href="{{ asset('css/fontawesome/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/duotone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/regular.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/light.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>

</html>
