<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'TreeHouse Italia')</title>
<meta name="description" content="@yield('meta_description', 'Hub ufficiale TreeHouse Italia: strutture in affitto, immobili in vendita e servizi per proprietari.')">
@if (trim($__env->yieldContent('canonical')))
<link rel="canonical" href="@yield('canonical')">
@endif
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="TreeHouse Italia" />
<link rel="manifest" href="/site.webmanifest" />
<link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ config('app.version') }}">
<link rel="stylesheet" href="{{ asset('css/about-page.css') }}?v={{ config('app.version') }}">
<link rel="stylesheet" href="{{ asset('css/contact-page.css') }}?v={{ config('app.version') }}">
<link rel="stylesheet" href="{{ asset('css/logo-team.css') }}?v={{ config('app.version') }}">
<link rel="stylesheet" href="{{ asset('css/footer-links-addon.css') }}?v={{ config('app.version') }}">
</head>
<body>

@include('partials.navbar')

<main class="container">
@if (session('status'))
<div class="alert">{{ session('status') }}</div>
@endif
@yield('content')
</main>

{{-- Footer condiviso --}}
@include('partials.footer')

</body>
</html>
