@php
    $locale = app()->getLocale();
@endphp

<header class="topbar">
    <div class="topbar__inner">
        <a class="brand" href="{{ route('home', ['locale' => $locale]) }}">
            @if (file_exists(public_path('images/logo-treehouse.png')))
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
            <a href="{{ route('rentals.index', ['locale' => $locale]) }}">{{ __('nav.rentals') }}</a>
            <a href="{{ route('sales.index', ['locale' => $locale]) }}">{{ __('nav.sales') }}</a>
            <a href="{{ route('owners', ['locale' => $locale]) }}">{{ __('nav.owners') }}</a>
            <a href="{{ route('about', ['locale' => $locale]) }}">{{ __('nav.about') }}</a>
            <a href="{{ route('contact', ['locale' => $locale]) }}">{{ __('nav.contact') }}</a>

            <div class="lang">
                <a class="lang__item" href="{{ url('/it' . request()->getPathInfoWithoutLocale()) }}" @if ($locale === 'it') aria-current="page" @endif>IT</a>
                <a class="lang__item" href="{{ url('/en' . request()->getPathInfoWithoutLocale()) }}" @if ($locale === 'en') aria-current="page" @endif>EN</a>
            </div>
        </nav>
    </div>
</header>

<script>
// Mobile Menu Toggle
const toggle = document.querySelector('.mobile-toggle');
const nav = document.querySelector('#mainNav');

if (toggle && nav) {
  toggle.addEventListener('click', function() {
    const expanded = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', (!expanded).toString());
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
