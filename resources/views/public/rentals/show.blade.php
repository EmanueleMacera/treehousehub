@extends('layouts.public')

@php
    $structureName = $structure->localized('name') ?? $structure->name;
    $structureLocation = $structure->localized('location');
    $structureAddress = $structure->localized('address');
    $structureLong = $structure->localized('description_long');
    $structureShort = $structure->localized('description_short');
@endphp

@section('title', $structureName)

@section('content')
    <section class="rental-detail-hero">
        <p class="rental-detail-hero__kicker">{{ __('rentals.detail.kicker') }}</p>
        <h1>{{ $structureName }}</h1>
        @if($structureLocation || $structureAddress)
            <p class="rental-detail-hero__meta">
                @if($structureLocation)<strong>{{ $structureLocation }}</strong>@endif
                @if($structureAddress) &middot; {{ $structureAddress }} @endif
            </p>
        @endif
    </section>

    <section class="rental-detail-layout">
        <article class="rental-detail-main">
            <div class="rental-detail-media">
                @if($structure->image_path)
                    <img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structureName }}">
                @else
                    <div class="rental-detail-media__placeholder">{{ mb_strtoupper(mb_substr($structureName, 0, 1)) }}</div>
                @endif
            </div>

            <div class="rental-detail-copy">
                @if($structureLong)
                    {!! $structureLong !!}
                @elseif($structureShort)
                    <p>{{ $structureShort }}</p>
                @else
                    <p>{{ __('rentals.structure.placeholder_description') }}</p>
                @endif
            </div>
        </article>

        <aside class="rental-detail-side">
            <div class="rental-detail-box">
                <h2>{{ __('rentals.detail.info_title') }}</h2>
                <ul>
                    @if($structureLocation)
                        <li><span>{{ __('rentals.detail.location') }}</span><strong>{{ $structureLocation }}</strong></li>
                    @endif
                    @if($structureAddress)
                        <li><span>{{ __('rentals.detail.address') }}</span><strong>{{ $structureAddress }}</strong></li>
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
                    @php($relatedName = $s->localized('name') ?? $s->name)
                    <article class="rental-related-card">
                        <a href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'structure' => ($s->slug ?: \Illuminate\Support\Str::slug($s->name))]) }}">{{ $relatedName }}</a>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection
