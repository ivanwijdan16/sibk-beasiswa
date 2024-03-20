<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SIBK')</title>
    <link rel="icon" type="image/ico" href="../favicon.ico" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @include('layouts._navbar')
    <main>
        @yield('content')
    </main>
    @include('layouts._footer')
    @stack('script')

    

</body>

</html>
