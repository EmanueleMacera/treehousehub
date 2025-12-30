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

    <style>
        :root {
            --bg: #0b1220;
            --panel: rgba(255, 255, 255, 0.06);
            --panel2: rgba(255, 255, 255, 0.09);
            --text: rgba(255, 255, 255, 0.92);
            --muted: rgba(255, 255, 255, 0.72);
            --primary: #3fd08b;
            --primary2: #2b8cff;
            --border: rgba(255, 255, 255, 0.12);
            --shadow: 0 20px 60px rgba(0, 0, 0, 0.45);
            --radius: 18px;
            --radius2: 14px;
        }
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            padding: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Noto Sans, Helvetica, Arial;
            background: radial-gradient(1000px 600px at 20% -10%, rgba(63, 208, 139, 0.22), transparent 55%),
                        radial-gradient(900px 600px at 90% 0%, rgba(43, 140, 255, 0.18), transparent 55%),
                        var(--bg);
            color: var(--text);
        }
        a { color: inherit; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .container { width: min(1100px, calc(100% - 32px)); margin: 0 auto; }
        .topbar { position: sticky; top: 0; z-index: 50; backdrop-filter: blur(10px); background: rgba(11, 18, 32, 0.65); border-bottom: 1px solid var(--border); }
        .topbar__inner { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 14px 0; }
        .brand { font-weight: 700; letter-spacing: 0.3px; }
        .nav { display: flex; gap: 14px; flex-wrap: wrap; color: var(--muted); }
        .nav a:hover { color: var(--text); }
        .lang { display: inline-flex; gap: 6px; }
        .lang__item { border: 1px solid var(--border); padding: 6px 10px; border-radius: 999px; color: var(--muted); }
        .lang__item[aria-current="page"] { background: var(--panel2); color: var(--text); }
        .alert { margin: 16px 0; padding: 12px 14px; border: 1px solid rgba(63, 208, 139, 0.3); background: rgba(63, 208, 139, 0.1); border-radius: var(--radius2); }
        .footer { border-top: 1px solid var(--border); margin-top: 60px; padding: 22px 0; color: var(--muted); }
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 10px 14px; border-radius: 999px; border: 1px solid var(--border); gap: 10px; font-weight: 600; }
        .btn--primary { border-color: rgba(63, 208, 139, 0.35); background: linear-gradient(135deg, rgba(63, 208, 139, 0.95), rgba(43, 140, 255, 0.75)); color: #06101c; box-shadow: 0 18px 40px rgba(63, 208, 139, 0.18); }
        .btn--ghost { background: rgba(255, 255, 255, 0.02); color: var(--text); }
        .link { color: var(--primary); }
        .sectionTitle { margin: 0; font-size: 26px; }
        .sectionSubtitle { margin: 10px 0 18px; color: var(--muted); max-width: 70ch; }
        .muted { color: var(--muted); }
        .hero { display: grid; grid-template-columns: 1.3fr 0.9fr; gap: 22px; padding: 34px 0 10px; }
        .hero__content { background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); border: 1px solid var(--border); border-radius: var(--radius); padding: 26px; box-shadow: var(--shadow); }
        .hero__visual { border-radius: var(--radius); border: 1px solid var(--border); background: radial-gradient(300px 300px at 30% 30%, rgba(63, 208, 139, 0.22), transparent 55%), radial-gradient(320px 320px at 70% 60%, rgba(43, 140, 255, 0.18), transparent 55%), rgba(255,255,255,0.03); box-shadow: var(--shadow); display: flex; align-items: flex-end; padding: 18px; min-height: 220px; }
        .kicker { margin: 0 0 10px; color: rgba(255,255,255,0.74); font-weight: 600; letter-spacing: 0.6px; text-transform: uppercase; font-size: 12px; }
        .lead { color: var(--muted); font-size: 16px; line-height: 1.5; margin: 10px 0 0; }
        .hero__cta { display: flex; gap: 10px; margin-top: 18px; flex-wrap: wrap; }
        .hero__trust { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 10px; margin-top: 18px; }
        .trust__item { border: 1px solid var(--border); background: rgba(255,255,255,0.03); padding: 10px 12px; border-radius: var(--radius2); }
        .trust__label { color: var(--muted); font-size: 12px; }
        .trust__value { font-weight: 700; margin-top: 6px; }
        .hero__card { width: 100%; border: 1px solid rgba(255,255,255,0.14); background: rgba(0,0,0,0.25); border-radius: var(--radius2); padding: 14px; }
        .hero__cardTitle { font-weight: 700; }
        .hero__cardText { color: var(--muted); margin-top: 6px; }
        .hero__cardLink { display: inline-block; margin-top: 10px; color: var(--primary); font-weight: 600; }
        .grid, .featured, .process, .story { margin-top: 28px; padding: 18px 0; }
        .cards { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; }
        .card { border: 1px solid var(--border); background: rgba(255,255,255,0.03); border-radius: var(--radius); padding: 18px; }
        .card--highlight { background: linear-gradient(180deg, rgba(63, 208, 139, 0.12), rgba(255,255,255,0.02)); border-color: rgba(63, 208, 139, 0.22); }
        .card__title { margin: 0; font-size: 18px; }
        .card__text { margin: 10px 0; color: var(--muted); }
        .card__bullets { margin: 0 0 14px; padding-left: 16px; color: var(--muted); }
        .card__bullets li { margin: 6px 0; }
        .featured__grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
        .panel { border: 1px solid var(--border); background: rgba(255,255,255,0.03); border-radius: var(--radius); padding: 16px; }
        .panel--accent { background: linear-gradient(180deg, rgba(43, 140, 255, 0.14), rgba(255,255,255,0.02)); border-color: rgba(43, 140, 255, 0.26); }
        .panel__head { display: flex; align-items: baseline; justify-content: space-between; gap: 12px; }
        .panel__title { margin: 0; font-size: 18px; }
        .miniList { list-style: none; margin: 12px 0 0; padding: 0; display: grid; gap: 10px; }
        .miniItem { border: 1px solid var(--border); background: rgba(0,0,0,0.18); padding: 10px 12px; border-radius: var(--radius2); }
        .miniItem__title { font-weight: 700; display: inline-block; }
        .miniItem__meta { color: var(--muted); margin-top: 6px; font-size: 13px; }
        .steps { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px; padding-left: 0; list-style: none; }
        .step { border: 1px solid var(--border); background: rgba(255,255,255,0.03); border-radius: var(--radius); padding: 14px; }
        .step__title { font-weight: 700; }
        .step__text { color: var(--muted); margin-top: 8px; }
        .process__cta { margin-top: 16px; display: flex; gap: 10px; flex-wrap: wrap; }
        .timeline { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
        .timeline__item { border: 1px solid var(--border); background: rgba(255,255,255,0.03); border-radius: var(--radius); padding: 14px; }
        .timeline__title { font-weight: 700; }
        .timeline__text { color: var(--muted); margin-top: 8px; }
        @media (max-width: 980px) {
            .hero { grid-template-columns: 1fr; }
            .cards { grid-template-columns: 1fr; }
            .featured__grid { grid-template-columns: 1fr; }
            .steps { grid-template-columns: 1fr; }
            .timeline { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<header class="topbar">
    <div class="topbar__inner container">
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
