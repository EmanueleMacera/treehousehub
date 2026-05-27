@extends('layouts.public')

@section('title', __('about.meta.title'))

@section('meta_description', __('about.meta.description'))

@section('canonical', route('about', ['locale' => app()->getLocale()]))

@section('content')
<section class="about-hero">
<div class="about-hero__inner">
<p class="about-hero__kicker">{{ __('about.hero.kicker') }}</p>
<h1 class="about-hero__title">{{ __('about.hero.title') }}</h1>
<div class="about-hero__lead">
@foreach(__('about.hero.paragraphs') as $paragraph)
<p>{!! $paragraph !!}</p>
@endforeach
</div>
<div class="about-hero__mission">
<h2>{{ __('about.mission.title') }}</h2>
<p>{!! __('about.mission.text') !!}</p>
</div>
</div>
</section>

<section class="milestones">
<header class="section-head">
<h2 class="section-title">{{ __('about.milestones.title') }}</h2>
<p class="section-subtitle">{{ __('about.milestones.subtitle') }}</p>
</header>
<div class="milestones-grid">
@foreach(__('about.milestones.items') as $item)
<article class="milestone-card">
<div class="milestone-card__year">{{ $item['year'] }}</div>
<h3 class="milestone-card__title">{{ $item['title'] }}</h3>
<p class="milestone-card__text">{{ $item['text'] }}</p>
</article>
@endforeach
</div>
</section>

<section class="team-section">
<header class="section-head">
<h2 class="section-title">{{ __('about.team.title') }}</h2>
<p class="section-subtitle">{{ __('about.team.subtitle') }}</p>
</header>

<div class="team-grid">
@foreach(__('about.team.members') as $member)
<article class="team-member">
<div class="team-member__photo">
@if(file_exists(public_path($member['image'])))
<img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}" class="team-member__photo-img">
@else
<div class="team-member__photo-placeholder"></div>
@endif
</div>
<div class="team-member__content">
<div class="team-member__role">{{ $member['role'] }}</div>
<h3 class="team-member__name">{{ $member['name'] }}</h3>
<p class="team-member__title">{{ $member['title'] }}</p>
<div class="team-member__bio">
@foreach($member['bio'] as $paragraph)
<p>{!! $paragraph !!}</p>
@endforeach
@if(!empty($member['items']))
<ul>
@foreach($member['items'] as $item)
<li>{!! $item !!}</li>
@endforeach
</ul>
@endif
</div>
</div>
</article>
@endforeach
</div>
</section>

<section class="company-values">
<header class="section-head">
<h2 class="section-title">{{ __('about.values.title') }}</h2>
<p class="section-subtitle">{{ __('about.values.subtitle') }}</p>
</header>
<div class="values-showcase">
@foreach(__('about.values.items') as $item)
<article class="value-showcase">
<div class="value-showcase__icon">{{ $item['icon'] }}</div>
<h3 class="value-showcase__title">{{ $item['title'] }}</h3>
<p class="value-showcase__text">{{ $item['text'] }}</p>
</article>
@endforeach
</div>
</section>

<section class="about-cta">
<div class="about-cta__content">
<h2 class="about-cta__title">{{ __('about.cta.title') }}</h2>
<p class="about-cta__text">{{ __('about.cta.text') }}</p>
<div class="about-cta__actions">
<a class="btn btn--large btn--primary" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('about.cta.contact') }}</a>
<a class="btn btn--large btn--ghost" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">{{ __('about.cta.owners') }}</a>
</div>
</div>
</section>
@endsection
