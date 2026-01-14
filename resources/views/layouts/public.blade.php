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
</head>
<body>
<header class="topbar">
<div class="topbar__inner">
<a class="brand" href="{{ route('home', ['locale' => app()->getLocale()]) }}">
@if(file_exists(public_path('images/logo-treehouse.png')))
<img src="{{ asset('images/logo-treehouse.png') }}" alt="TreeHouse Italia" class="brand__logo">
@else
TreeHouse Italia
@endif
</a>

<button class="mobile-toggle" aria-label="Toggle menu" aria-expanded="false">
<span class="mobile-toggle__line"></span>
<span class="mobile-toggle__line"></span>
<span class="mobile-toggle__line"></span>
</button>

<nav class="nav" id="mainNav">
<a href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Affitti</a>
<a href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Vendite</a>
<a href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Proprietari</a>
<a href="{{ route('about', ['locale' => app()->getLocale()]) }}">Chi siamo</a>
<a href="{{ route('contact', ['locale' => app()->getLocale()]) }}">Contatti</a>

<div class="lang">
<a class="lang__item" href="{{ url('/it' . request()->getPathInfoWithoutLocale()) }}" @if(app()->getLocale() === 'it') aria-current="page" @endif>IT</a>
<a class="lang__item" href="{{ url('/en' . request()->getPathInfoWithoutLocale()) }}" @if(app()->getLocale() === 'en') aria-current="page" @endif>EN</a>
</div>
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

<script>
// Mobile Menu Toggle
const toggle = document.querySelector('.mobile-toggle');
const nav = document.querySelector('#mainNav');

if (toggle && nav) {
toggle.addEventListener('click', function() {
const expanded = this.getAttribute('aria-expanded') === 'true';
this.setAttribute('aria-expanded', !expanded);
this.classList.toggle('active');
nav.classList.toggle('active');
});

// Close menu when clicking outside
document.addEventListener('click', function(e) {
if (!toggle.contains(e.target) && !nav.contains(e.target)) {
toggle.classList.remove('active');
nav.classList.remove('active');
toggle.setAttribute('aria-expanded', 'false');
}
});

// Close menu when clicking a link
const navLinks = nav.querySelectorAll('a');
navLinks.forEach(link => {
link.addEventListener('click', function() {
toggle.classList.remove('active');
nav.classList.remove('active');
toggle.setAttribute('aria-expanded', 'false');
});
});
}
</script>
</body>
</html>
