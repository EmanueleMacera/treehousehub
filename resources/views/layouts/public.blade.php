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
<link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ config('app.version') }}">
</head>
<body>
<header class="topbar">
<div class="topbar__inner container">
<a class="brand" href="{{ route('home', ['locale' => app()->getLocale()]) }}">TreeHouse Italia</a>
<nav class="nav">
<a href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Affitti</a>
<a href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Vendite</a>
<a href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Proprietari</a>
<a href="{{ route('about', ['locale' => app()->getLocale()]) }}">Chi siamo</a>
<a href="{{ route('contact', ['locale' => app()->getLocale()]) }}">Contatti</a>
</nav>
<nav class="lang">
<a class="lang__item" href="{{ url('/it' . request()->getPathInfoWithoutLocale()) }}" @if(app()->getLocale() === 'it') aria-current="page" @endif>IT</a>
<a class="lang__item" href="{{ url('/en' . request()->getPathInfoWithoutLocale()) }}" @if(app()->getLocale() === 'en') aria-current="page" @endif>EN</a>
</nav>
</div>
</header>
<main class="container">
@if (session('status'))
<div class="alert">{{ session('status') }}</div>
@endif
@yield('content')
</main>
<footer class="footer">
<div class="container">
<small>&copy; {{ date('Y') }} TreeHouse Italia</small>
</div>
</footer>
</body>
</html>
