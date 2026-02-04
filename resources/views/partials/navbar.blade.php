@php
    $locale = app()->getLocale();
@endphp

<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="{{ route('home', ['locale' => $locale]) }}">
            {{ config('app.name', 'TreehouseHub') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rentals.index', ['locale' => $locale]) }}">{{ __('nav.rentals') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sales.index', ['locale' => $locale]) }}">{{ __('nav.sales') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('owners', ['locale' => $locale]) }}">{{ __('nav.owners') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about', ['locale' => $locale]) }}">{{ __('nav.about') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact', ['locale' => $locale]) }}">{{ __('nav.contact') }}</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper($locale) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ url('it' . '/' . request()->path()) }}" onclick="event.preventDefault(); window.location.href='{{ url('it' . '/' . ltrim(preg_replace('#^(it|en)/?#', '', request()->path()), '/')) }}';">IT</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('en' . '/' . request()->path()) }}" onclick="event.preventDefault(); window.location.href='{{ url('en' . '/' . ltrim(preg_replace('#^(it|en)/?#', '', request()->path()), '/')) }}';">EN</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
