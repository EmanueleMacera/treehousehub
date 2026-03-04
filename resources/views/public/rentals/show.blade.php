@extends('layouts.public')

@section('title', $structure->name)

@section('content')
    <section class="rental-detail-hero">
        <p class="rental-detail-hero__kicker">{{ __('rentals.detail.kicker') }}</p>
        <h1>{{ $structure->name }}</h1>
        @if($structure->location || $structure->address)
            <p class="rental-detail-hero__meta">
                @if($structure->location)<strong>{{ $structure->location }}</strong>@endif
                @if($structure->address) · {{ $structure->address }} @endif
            </p>
        @endif
    </section>

    <section class="rental-detail-layout">
        <article class="rental-detail-main">
            <div class="rental-detail-media">
                @if($structure->image_path)
                    <img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->name }}">
                @else
                    <div class="rental-detail-media__placeholder">{{ mb_strtoupper(mb_substr($structure->name, 0, 1)) }}</div>
                @endif
            </div>

            <div class="rental-detail-copy">
                @if($structure->description_long)
                    <p>{{ $structure->description_long }}</p>
                @elseif($structure->description_short)
                    <p>{{ $structure->description_short }}</p>
                @else
                    <p>{{ __('rentals.structure.placeholder_description') }}</p>
                @endif
            </div>
        </article>

        <aside class="rental-detail-side">
            <div class="rental-detail-box">
                <h2>{{ __('rentals.detail.info_title') }}</h2>
                <ul>
                    @if($structure->location)
                        <li><span>{{ __('rentals.detail.location') }}</span><strong>{{ $structure->location }}</strong></li>
                    @endif
                    @if($structure->address)
                        <li><span>{{ __('rentals.detail.address') }}</span><strong>{{ $structure->address }}</strong></li>
                    @endif
                </ul>

                @if($structure->external_url)
                    <a class="rental-detail-box__cta" href="{{ $structure->external_url }}" target="_blank" rel="noopener noreferrer">
                        {{ __('rentals.actions.visit_official_site') }}
                    </a>
                @endif
            </div>
        </aside>
    </section>

    @if($otherStructures->count())
        <section class="rental-related">
            <h2>{{ __('rentals.other.title') }}</h2>
            <div class="rental-related-grid">
                @foreach($otherStructures as $s)
                    <article class="rental-related-card">
                        <a href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'structure' => $s->slug]) }}">{{ $s->name }}</a>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection
