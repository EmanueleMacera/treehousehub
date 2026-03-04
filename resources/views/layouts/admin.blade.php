<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - {{ __('site.brand') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body { background: #f4f6fb; }
        .admin-sidebar { background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%); color: #cbd5e1; }
        .admin-brand { color: #fff; font-weight: 700; letter-spacing: .2px; }
        .admin-nav .nav-link { color: #cbd5e1; border-radius: 10px; padding: .6rem .75rem; }
        .admin-nav .nav-link:hover { background: rgba(148, 163, 184, .15); color: #fff; }
        .admin-nav .nav-link.active { background: #2563eb; color: #fff; }
        .admin-shell-header { background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:.85rem 1rem; }
        .admin-card { border: 1px solid #e2e8f0; border-radius: 14px; box-shadow: 0 10px 30px rgba(15,23,42,.05); }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row min-vh-100">
        <aside class="admin-sidebar col-12 col-md-3 col-xl-2 p-3 d-flex flex-column">
            <a class="admin-brand text-decoration-none h5 mb-4" href="{{ route('admin.dashboard') }}">TreeHouse Admin</a>

            <nav class="admin-nav nav flex-column gap-2 mb-3">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">{{ __('admin.nav.dashboard') }}</a>
                <a class="nav-link {{ request()->routeIs('admin.structures.*') ? 'active' : '' }}" href="{{ route('admin.structures.index') }}">{{ __('admin.nav.structures') }}</a>
                <a class="nav-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}" href="{{ route('admin.sales.index') }}">{{ __('admin.nav.sales') }}</a>
            </nav>

            <div class="mt-auto d-grid gap-2">
                <a class="btn btn-outline-light btn-sm" href="{{ url('/') }}">{{ __('admin.nav.back_public') }}</a>
                <a class="btn btn-danger btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('admin.nav.logout') }}</a>
            </div>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                @csrf
            </form>
        </aside>

        <main class="col-12 col-md-9 col-xl-10 p-3 p-lg-4">
            <div class="admin-shell-header d-flex justify-content-between align-items-center mb-3">
                <div>
                    <strong>@yield('page_title', __('admin.dashboard.title'))</strong>
                    <div class="small text-muted">Gestione strutture ricettive e immobili in vendita</div>
                </div>
                <div class="d-none d-md-flex gap-2">
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.structures.create') }}">+ {{ __('admin.nav.structures') }}</a>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.sales.create') }}">+ {{ __('admin.nav.sales') }}</a>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success border-0" role="alert">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger border-0" role="alert">
                    <strong>Controlla i campi inseriti.</strong>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
