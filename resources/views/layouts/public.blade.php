<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('site.brand'))</title>

    @if (trim($__env->yieldContent('canonical')))
        <link rel="canonical" href="@yield('canonical')">
    @endif
</head>
<body>
<header>
    <nav>
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('nav.home') }}</a>
        <a href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">{{ __('nav.rentals') }}</a>
        <a href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">{{ __('nav.sales') }}</a>
        <a href="{{ route('owners', ['locale' => app()->getLocale()]) }}">{{ __('nav.owners') }}</a>
        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('nav.about') }}</a>
        <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('nav.contact') }}</a>
    </nav>

    <nav aria-label="Language">
        <a href="{{ url('/it' . request()->getPathInfoWithoutLocale()) }}">IT</a>
        <a href="{{ url('/en' . request()->getPathInfoWithoutLocale()) }}">EN</a>
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
