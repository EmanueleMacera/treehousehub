@extends('layouts.public')

@section('title', __('owners.meta.title'))

@section('meta_description', __('owners.meta.description'))

@section('canonical', route('owners', ['locale' => app()->getLocale()]))

@section('content')
<section class="hero-owners">
<div class="hero-owners__inner">
<div class="hero-owners__content">
<p class="hero-owners__kicker">{{ __('owners.hero.kicker') }}</p>
<h1 class="hero-owners__title">{{ __('owners.hero.title') }}</h1>
<p class="hero-owners__lead">{!! __('owners.hero.lead') !!}</p>
<div class="hero-owners__cta">
<a class="btn btn--primary btn--large" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('owners.hero.cta') }}</a>
</div>
</div>
<div class="hero-owners__visual">
@foreach(__('owners.hero.stats') as $stat)
<div class="stat-card">
<div class="stat-card__value">{{ $stat['value'] }}</div>
<div class="stat-card__label">{{ $stat['label'] }}</div>
</div>
@endforeach
</div>
</div>
</section>

<section class="why-us">
<header class="section-head">
<h2 class="section-title">{{ __('owners.benefits.title') }}</h2>
<p class="section-subtitle">{{ __('owners.benefits.subtitle') }}</p>
</header>
<div class="benefits-grid">
@foreach(__('owners.benefits.items') as $item)
<article class="benefit-card">
<div class="benefit-card__icon">{{ $item['icon'] }}</div>
<h3 class="benefit-card__title">{{ $item['title'] }}</h3>
<p class="benefit-card__text">{!! $item['text'] !!}</p>
</article>
@endforeach
</div>
</section>

<section class="services-offered">
<header class="section-head">
<h2 class="section-title">{{ __('owners.services.title') }}</h2>
<p class="section-subtitle">{{ __('owners.services.subtitle') }}</p>
</header>

<div class="service-blocks">
@foreach(__('owners.services.items') as $item)
<article class="service-block">
<div class="service-block__icon">{{ $item['icon'] }}</div>
<h3 class="service-block__title">{{ $item['title'] }}</h3>
<ul class="service-block__list">
@foreach($item['items'] as $line)
<li>{{ $line }}</li>
@endforeach
</ul>
</article>
@endforeach
</div>
</section>

<section class="faq-section">
<header class="section-head">
<h2 class="section-title">{{ __('owners.faq.title') }}</h2>
<p class="section-subtitle">{{ __('owners.faq.subtitle') }}</p>
</header>

<div class="faq-grid">
@foreach(__('owners.faq.items') as $item)
<article class="faq-item">
<h3 class="faq-item__question">{{ $item['question'] }}</h3>
<p class="faq-item__answer">{!! $item['answer'] !!}</p>
</article>
@endforeach
</div>
</section>

<section class="owners-cta">
<div class="owners-cta__content">
<h2 class="owners-cta__title">{{ __('owners.cta.title') }}</h2>
<p class="owners-cta__text">{!! __('owners.cta.text') !!}</p>
<div class="owners-cta__actions">
<a class="btn btn--large btn--primary" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('owners.cta.primary') }}</a>
<a class="btn btn--large btn--ghost" href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('owners.cta.secondary') }}</a>
</div>
</div>
</section>
@endsection
