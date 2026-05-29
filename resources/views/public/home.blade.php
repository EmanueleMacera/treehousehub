@extends('layouts.public')

@section('title', __('home.meta.title'))

@section('meta_description', __('home.meta.description'))

@section('canonical', url('/' . app()->getLocale()))

@section('content')
<section class="hero-main">
    <div class="hero-bg">
        <img src="{{ asset('images/hero-riviera-ligure.jpg') }}" alt="{{ __('home.hero.bg_alt') }}" class="hero-bg__image" onerror="this.outerHTML='<div class=hero-bg__image--placeholder></div>'">
    </div>
    <div class="hero-main__wrapper">
        <div class="hero-main__inner">
            <div class="hero-main__content">
                <p class="hero-main__kicker">{{ __('home.hero.kicker') }}</p>
                <h1 class="hero-main__title">{{ __('home.hero.title') }}</h1>
                <p class="hero-main__lead">{!! __('home.hero.lead') !!}</p>
                <div class="hero-main__cta">
                    <a class="btn btn--primary" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">{{ __('home.hero.cta_owners') }}</a>
                    <a class="btn btn--outline" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">{{ __('home.hero.cta_rentals') }}</a>
                    <a class="btn btn--ghost" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">{{ __('home.hero.cta_sales') }}</a>
                </div>
            </div>
            <div class="hero-main__visual">
                <div class="hero-card">
                    <div class="hero-card__badge">{{ __('home.hero.card.badge') }}</div>
                    <h3 class="hero-card__title">{!! __('home.hero.card.title') !!}</h3>
                    <p class="hero-card__text">{!! __('home.hero.card.text') !!}</p>
                    <a class="hero-card__link" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">{!! __('home.hero.card.link') !!}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-modern">
    <div class="hm-metrics">
        @foreach(__('home.metrics') as $metric)
            <article class="hm-metric-card">
                <span class="hm-metric-value">{{ $metric['value'] }}</span>
                <p>{{ $metric['text'] }}</p>
            </article>
        @endforeach
    </div>

    <section class="hm-section">
        <header class="hm-section-head">
            <h2>{{ __('home.search.title') }}</h2>
            <p>{{ __('home.search.subtitle') }}</p>
        </header>

        <div class="hm-offers-grid">
            @foreach(['rentals', 'sales', 'owners'] as $offer)
                <article class="hm-offer-card {{ $offer === 'owners' ? 'hm-offer-card--accent' : '' }}">
                    <h3>{{ __("home.offers.$offer.title") }}</h3>
                    <p>{!! __("home.offers.$offer.text") !!}</p>
                    <ul>
                        @foreach(__("home.offers.$offer.items") as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a class="btn {{ $offer === 'owners' ? 'btn--primary' : 'btn--outline' }}" href="{{ $offer === 'rentals' ? route('rentals.index', ['locale' => app()->getLocale()]) : ($offer === 'sales' ? route('sales.index', ['locale' => app()->getLocale()]) : route('owners', ['locale' => app()->getLocale()])) }}">{{ __("home.offers.$offer.cta") }}</a>
                </article>
            @endforeach
        </div>
    </section>

    @if($featuredStructures->count() > 0 || $featuredSales->count() > 0)
        <section class="hm-section hm-featured">
            <header class="hm-section-head">
                <h2>{{ __('home.featured.title') }}</h2>
                <p>{{ __('home.featured.subtitle') }}</p>
            </header>
            <div class="hm-featured-grid">
                <article class="hm-featured-panel">
                    <div class="hm-featured-head">
                        <h3>{{ __('home.featured.rentals.title') }}</h3>
                        <a href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">{!! __('home.featured.rentals.cta') !!}</a>
                    </div>
                    @if($featuredStructures->count() > 0)
                        <ul>
                            @foreach($featuredStructures as $s)
                                <li>
                                    <a class="hm-featured-item" href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'structure' => ($s->slug ?: \Illuminate\Support\Str::slug($s->name))]) }}">
                                        @if($s->image_path)
                                            <img class="hm-thumb" src="{{ asset('storage/' . $s->image_path) }}" alt="{{ $s->name }}">
                                        @else
                                            <span class="hm-thumb hm-thumb--placeholder">{{ mb_strtoupper(mb_substr($s->name, 0, 1)) }}</span>
                                        @endif
                                        <span class="hm-featured-copy">
                                            <strong>{{ $s->name }}</strong>
                                            @if($s->location)<small>{{ $s->location }}</small>@endif
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('home.featured.rentals.empty') }}</p>
                    @endif
                </article>

                <article class="hm-featured-panel">
                    <div class="hm-featured-head">
                        <h3>{{ __('home.featured.sales.title') }}</h3>
                        <a href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">{!! __('home.featured.sales.cta') !!}</a>
                    </div>
                    @if($featuredSales->count() > 0)
                        <ul>
                            @foreach($featuredSales as $p)
                                <li>
                                    <a class="hm-featured-item" href="{{ route('sales.show', ['locale' => app()->getLocale(), 'sale' => $p->publicId()]) }}">
                                        <span class="hm-thumb hm-thumb--placeholder">{{ mb_strtoupper(mb_substr($p->title, 0, 1)) }}</span>
                                        <span class="hm-featured-copy">
                                            <strong>{{ $p->title }}</strong>
                                            @if($p->price)<small>€ {{ number_format($p->price, 0, ',', '.') }}</small>@endif
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('home.featured.sales.empty') }}</p>
                    @endif
                </article>
            </div>
        </section>
    @endif

    <section class="hm-section hm-process">
        <header class="hm-section-head">
            <h2>{{ __('home.owner_process.title') }}</h2>
            <p>{{ __('home.owner_process.subtitle') }}</p>
        </header>
        <ol>
            @foreach(__('home.owner_process.steps') as $step)
                <li><strong>{{ $step['title'] }}:</strong> {{ $step['text'] }}</li>
            @endforeach
        </ol>
        <div class="hm-actions">
            <a class="btn btn--large btn--primary" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">{{ __('home.owner_process.cta_owners') }}</a>
            <a class="btn btn--large btn--ghost" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('home.owner_process.cta_contact') }}</a>
        </div>
    </section>

    <section class="hm-section hm-values">
        <header class="hm-section-head">
            <h2>{{ __('home.values.title') }}</h2>
            <p>{{ __('home.values.subtitle') }}</p>
        </header>
        <div class="hm-values-grid">
            @foreach(__('home.values.items') as $item)
                <article><h3>{{ $item['title'] }}</h3><p>{{ $item['text'] }}</p></article>
            @endforeach
        </div>
    </section>
</section>

<section class="story">
    <header class="section-head">
        <h2 class="section-title">{{ __('home.story_full.title') }}</h2>
        <p class="section-subtitle">{{ __('home.story_full.subtitle') }}</p>
    </header>
    <div class="timeline-wrapper">
        <div class="timeline-line"></div>
        <div class="timeline">
            @foreach(__('home.story_full.items') as $item)
                <article class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['alt'] }}" class="timeline-image" onerror="this.outerHTML='<div class=timeline-image--placeholder></div>'">
                        <div class="timeline-body">
                            <span class="timeline-year">{{ $item['year'] }}</span>
                            <h3 class="timeline-title">{{ $item['title'] }}</h3>
                            <p class="timeline-text">{{ $item['text'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="final-cta">
    <div class="final-cta__content">
        <h2 class="final-cta__title">{{ __('home.final_cta.title') }}</h2>
        <p class="final-cta__text">{{ __('home.final_cta.text') }}</p>
        <div class="final-cta__actions">
            <a class="btn btn--large btn--primary" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">{{ __('home.final_cta.primary') }}</a>
            <a class="btn btn--large btn--ghost" href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('home.final_cta.secondary') }}</a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded',function(){
const timelineItems=document.querySelectorAll('.timeline-item');
const observer=new IntersectionObserver((entries)=>{
entries.forEach(entry=>{
if(entry.isIntersecting){
entry.target.classList.add('visible');
}
});
},{threshold:0.2});
timelineItems.forEach(item=>observer.observe(item));
});
</script>
@endsection
