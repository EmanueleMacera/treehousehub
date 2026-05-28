<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - {{ __('site.brand') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ config('app.version') }}">
    @stack('styles')
</head>
<body class="admin-body">
<div class="admin-app">
    <aside class="admin-sidebar">
        <a class="admin-brand" href="{{ route('admin.dashboard') }}">
            <span class="admin-brand__mark">TH</span>
            <span class="admin-brand__copy">
                <span>TreeHouse Admin</span>
                <small>{{ auth()->user()?->email }}</small>
            </span>
        </a>

        <nav class="admin-nav" aria-label="Admin">
            <div class="admin-nav__label">Menu</div>
            <a class="nav-link {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i data-lucide="layout-dashboard" class="admin-icon" aria-hidden="true"></i>
                {{ __('admin.nav.dashboard') }}
            </a>
            <a class="nav-link {{ request()->routeIs('admin.structures.*') ? 'active' : '' }}" href="{{ route('admin.structures.index') }}">
                <i data-lucide="home" class="admin-icon" aria-hidden="true"></i>
                {{ __('admin.nav.structures') }}
            </a>
            <a class="nav-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}" href="{{ route('admin.sales.index') }}">
                <i data-lucide="euro" class="admin-icon" aria-hidden="true"></i>
                {{ __('admin.nav.sales') }}
            </a>
            <a class="nav-link {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.category-types.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i data-lucide="folders" class="admin-icon" aria-hidden="true"></i>
                {{ __('admin.nav.categories') }}
            </a>
        </nav>

        <div class="admin-sidebar__footer">
            <a class="btn btn-outline-light btn-sm btn-icon" href="{{ url('/') }}">
                <i data-lucide="external-link" class="admin-icon" aria-hidden="true"></i>
                {{ __('admin.nav.back_public') }}
            </a>
            <a class="btn btn-danger btn-sm btn-icon" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i data-lucide="log-out" class="admin-icon" aria-hidden="true"></i>
                {{ __('admin.nav.logout') }}
            </a>
        </div>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
            @csrf
        </form>
    </aside>

    <main class="admin-shell">
        <header class="admin-page-head">
            <div>
                <p class="admin-page-kicker">@yield('page_kicker', 'TreeHouse Italia')</p>
                <h1 class="admin-page-title">@yield('page_title', __('admin.dashboard.title'))</h1>
                <p class="admin-page-subtitle">@yield('page_subtitle', __('admin.dashboard.subtitle'))</p>
            </div>
            <div class="admin-head-actions">
                @yield('page_actions')
            </div>
        </header>

        @if (session('status'))
            <div class="alert alert-success border-0 shadow-sm" role="alert">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm" role="alert">
                <strong>{{ __('admin.validation.check_fields') }}</strong>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>
    if (window.lucide) {
        window.lucide.createIcons();
    }
</script>
@stack('scripts')
</body>
</html>
