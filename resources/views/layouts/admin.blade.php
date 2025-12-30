<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - {{ __('site.brand') }}</title>
</head>
<body>
<header>
    <nav>
        <a href="{{ url('/') }}">{{ __('admin.nav.back_public') }}</a>
        <a href="{{ route('admin.pages.edit', ['key' => 'about']) }}">{{ __('admin.nav.about') }}</a>
        <a href="{{ route('admin.pages.edit', ['key' => 'owners']) }}">{{ __('admin.nav.owners') }}</a>
    </nav>
</header>

<main>
    @if (session('status'))
        <div role="alert">{{ session('status') }}</div>
    @endif

    @yield('content')
</main>
</body>
</html>
