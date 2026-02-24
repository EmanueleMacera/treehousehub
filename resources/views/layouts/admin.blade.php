<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - {{ __('site.brand') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="container-fluid">
    <div class="row min-vh-100">
        <aside class="col-12 col-md-3 col-xl-2 bg-white border-end p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a class="h5 mb-0 text-decoration-none" href="{{ route('admin.dashboard') }}">Admin</a>
            </div>

            <nav class="nav flex-column gap-1">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">{{ __('admin.nav.dashboard') }}</a>
                <a class="nav-link" href="{{ route('admin.structures.index') }}">{{ __('admin.nav.structures') }}</a>
                <a class="nav-link" href="{{ route('admin.sales.index') }}">{{ __('admin.nav.sales') }}</a>
                <a class="nav-link" href="{{ route('admin.pages.edit', ['key' => 'about']) }}">{{ __('admin.nav.about') }}</a>
                <a class="nav-link" href="{{ route('admin.pages.edit', ['key' => 'owners']) }}">{{ __('admin.nav.owners') }}</a>
                <a class="nav-link" href="{{ url('/') }}">{{ __('admin.nav.back_public') }}</a>
            </nav>

            <hr>

            <a class="btn btn-outline-danger btn-sm w-100" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('admin.nav.logout') }}
            </a>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                @csrf
            </form>
        </aside>

        <main class="col-12 col-md-9 col-xl-10 p-4">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
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
