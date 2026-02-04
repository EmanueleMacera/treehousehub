<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('meta')
</head>

<body>
    @include('partials.navbar')

    @yield('header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>

</html>
