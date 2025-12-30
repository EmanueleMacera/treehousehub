<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('site.brand'))</title>
</head>
<body>
<header>
    <nav>
        <a href="{{ route('home') }}">{{ __('nav.home') }}</a>
        <a href="{{ route('rentals.index') }}">{{ __('nav.rentals') }}</a>
        <a href="{{ route('sales.index') }}">{{ __('nav.sales') }}</a>
        <a href="{{ route('owners') }}">{{ __('nav.owners') }}</a>
        <a href="{{ route('about') }}">{{ __('nav.about') }}</a>
        <a href="{{ route('contact') }}">{{ __('nav.contact') }}</a>
    </nav>
</header>

<main>
    @if (session('status'))
        <div role="alert">{{ session('status') }}</div>
    @endif

    @yield('content')
</main>

<footer>
    <small>{{ __('site.footer') }}</small>
</footer>
</body>
</html>
