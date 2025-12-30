<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('site.brand'))</title>

    <meta name="description" content="@yield('meta_description', __('site.meta.description'))">

    @if (trim($__env->yieldContent('canonical')))
        <link rel="canonical" href="@yield('canonical')">
    @endif

    @vite(['resources/css/app.css'])
</head>
<body>
<header class="topbar">
    <div class="topbar__inner">
        <a class="brand" href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('site.brand') }}</a>

        <nav class="nav">
            <a href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">{{ __('nav.rentals') }}</a>
            <a href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">{{ __('nav.sales') }}</a>
            <a href="{{ route('owners', ['locale' => app()->getLocale()]) }}">{{ __('nav.owners') }}</a>
            <a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('nav.about') }}</a>
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('nav.contact') }}</a>
        </nav>

        <nav class="lang" aria-label="Language">
            <a class="lang__item" href="{{ url('/it' . request()->getPathInfoWithoutLocale()) }}" aria-current="{{ app()->getLocale() === 'it' ? 'page' : 'false' }}">IT</a>
            <a class="lang__item" href="{{ url('/en' . request()->getPathInfoWithoutLocale()) }}" aria-current="{{ app()->getLocale() === 'en' ? 'page' : 'false' }}">EN</a>
        </nav>
    </div>
</header>

<main class="container">
    @if (session('status'))
        <div class="alert" role="alert">{{ session('status') }}</div>
    @endif

    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <small>{{ __('site.footer') }}</small>
    </div>
</footer>
</body>
</html>
