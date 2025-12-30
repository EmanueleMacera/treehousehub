@extends('layouts.public')

@section('title', __('home.meta.title'))

@section('canonical', url('/' . app()->getLocale()))

@section('content')
    <section class="hero">
        <div class="hero__content">
            <p class="kicker">{{ __('home.hero.kicker') }}</p>
            <h1>{{ __('home.hero.title') }}</h1>
            <p class="lead">{{ __('home.hero.subtitle') }}</p>

            <div class="hero__cta">
                <a class="btn btn--primary" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">{{ __('home.hero.cta_rentals') }}</a>
                <a class="btn btn--ghost" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">{{ __('home.hero.cta_sales') }}</a>
            </div>

            <div class="hero__trust">
                <div class="trust__item">
                    <div class="trust__label">{{ __('home.trust.item_1.label') }}</div>
                    <div class="trust__value">{{ __('home.trust.item_1.value') }}</div>
                </div>
                <div class="trust__item">
                    <div class="trust__label">{{ __('home.trust.item_2.label') }}</div>
                    <div class="trust__value">{{ __('home.trust.item_2.value') }}</div>
                </div>
                <div class="trust__item">
                    <div class="trust__label">{{ __('home.trust.item_3.label') }}</div>
                    <div class="trust__value">{{ __('home.trust.item_3.value') }}</div>
                </div>
            </div>
        </div>
        <div class="hero__visual" aria-hidden="true">
            <div class="hero__card">
                <div class="hero__cardTitle">{{ __('home.hero.card.title') }}</div>
                <div class="hero__cardText">{{ __('home.hero.card.text') }}</div>
                <a class="hero__cardLink" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">{{ __('home.hero.card.link') }}</a>
            </div>
        </div>
    </section>

    <section class="grid">
        <h2 class="sectionTitle">{{ __('home.entrypoints.title') }}</h2>
        <p class="sectionSubtitle">{{ __('home.entrypoints.subtitle') }}</p>

        <div class="cards">
            <article class="card">
                <h3 class="card__title">{{ __('home.entrypoints.rentals.title') }}</h3>
                <p class="card__text">{{ __('home.entrypoints.rentals.text') }}</p>
                <ul class="card__bullets">
                    <li>{{ __('home.entrypoints.rentals.b1') }}</li>
                    <li>{{ __('home.entrypoints.rentals.b2') }}</li>
                    <li>{{ __('home.entrypoints.rentals.b3') }}</li>
                </ul>
                <a class="btn btn--primary" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">{{ __('home.entrypoints.rentals.cta') }}</a>
            </article>

            <article class="card">
                <h3 class="card__title">{{ __('home.entrypoints.sales.title') }}</h3>
                <p class="card__text">{{ __('home.entrypoints.sales.text') }}</p>
                <ul class="card__bullets">
                    <li>{{ __('home.entrypoints.sales.b1') }}</li>
                    <li>{{ __('home.entrypoints.sales.b2') }}</li>
                    <li>{{ __('home.entrypoints.sales.b3') }}</li>
                </ul>
                <a class="btn btn--ghost" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">{{ __('home.entrypoints.sales.cta') }}</a>
            </article>

            <article class="card card--highlight">
                <h3 class="card__title">{{ __('home.entrypoints.owners.title') }}</h3>
                <p class="card__text">{{ __('home.entrypoints.owners.text') }}</p>
                <ul class="card__bullets">
                    <li>{{ __('home.entrypoints.owners.b1') }}</li>
                    <li>{{ __('home.entrypoints.owners.b2') }}</li>
                    <li>{{ __('home.entrypoints.owners.b3') }}</li>
                </ul>
                <a class="btn btn--primary" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">{{ __('home.entrypoints.owners.cta') }}</a>
            </article>
        </div>
    </section>

    <section class="process">
        <h2 class="sectionTitle">{{ __('home.process.title') }}</h2>
        <p class="sectionSubtitle">{{ __('home.process.subtitle') }}</p>

        <ol class="steps">
            <li class="step">
                <div class="step__title">{{ __('home.process.s1.title') }}</div>
                <div class="step__text">{{ __('home.process.s1.text') }}</div>
            </li>
            <li class="step">
                <div class="step__title">{{ __('home.process.s2.title') }}</div>
                <div class="step__text">{{ __('home.process.s2.text') }}</div>
            </li>
            <li class="step">
                <div class="step__title">{{ __('home.process.s3.title') }}</div>
                <div class="step__text">{{ __('home.process.s3.text') }}</div>
            </li>
            <li class="step">
                <div class="step__title">{{ __('home.process.s4.title') }}</div>
                <div class="step__text">{{ __('home.process.s4.text') }}</div>
            </li>
        </ol>

        <div class="process__cta">
            <a class="btn btn--primary" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('home.process.cta') }}</a>
        </div>
    </section>

    <section class="story">
        <h2 class="sectionTitle">{{ __('home.story.title') }}</h2>
        <p class="sectionSubtitle">{{ __('home.story.subtitle') }}</p>

        <div class="timeline">
            <div class="timeline__item">
                <div class="timeline__title">{{ __('home.story.t1.title') }}</div>
                <div class="timeline__text">{{ __('home.story.t1.text') }}</div>
            </div>
            <div class="timeline__item">
                <div class="timeline__title">{{ __('home.story.t2.title') }}</div>
                <div class="timeline__text">{{ __('home.story.t2.text') }}</div>
            </div>
            <div class="timeline__item">
                <div class="timeline__title">{{ __('home.story.t3.title') }}</div>
                <div class="timeline__text">{{ __('home.story.t3.text') }}</div>
            </div>
            <div class="timeline__item">
                <div class="timeline__title">{{ __('home.story.t4.title') }}</div>
                <div class="timeline__text">{{ __('home.story.t4.text') }}</div>
            </div>
        </div>

        <p>
            <a class="link" href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('home.story.cta') }}</a>
        </p>
    </section>
@endsection
