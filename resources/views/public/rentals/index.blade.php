@extends('layouts.public')

@section('title', __('rentals.meta.title'))

@section('content')
    <section class="rentals-hero">
        <p class="rentals-hero__kicker">TreeHouse Collection</p>
        <h1>{{ __('rentals.hero.title') }}</h1>
        <p>{{ __('rentals.hero.subtitle') }}</p>
    </section>

    <section class="rentals-list-section">
        <div class="rentals-list-head">
            <h2>{{ __('rentals.list.title') }}</h2>
            <span class="rentals-list-count">{{ $structures->count() }}</span>
        </div>

        @if($structures->count())
            <div class="rentals-grid">
                @foreach ($structures as $structure)
                    <article class="rental-card">
                        <a class="rental-card__media" href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'structure' => $structure->slug]) }}">
                            @if($structure->image_path)
                                <img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->name }}">
                            @else
                                <span class="rental-card__placeholder">{{ mb_strtoupper(mb_substr($structure->name, 0, 1)) }}</span>
                            @endif
                        </a>

                        <div class="rental-card__body">
                            <h3>{{ $structure->name }}</h3>

                            @if($structure->location || $structure->address)
                                <p class="rental-card__meta">
                                    @if($structure->location)<strong>{{ $structure->location }}</strong>@endif
                                    @if($structure->address) · {{ $structure->address }} @endif
                                </p>
                            @endif

                            <p class="rental-card__desc">{{ $structure->description_short ?: __('rentals.structure.placeholder_description') }}</p>

                            <a class="rental-card__link" href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'structure' => $structure->slug]) }}">
                                {{ __('rentals.actions.discover') }}
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="rentals-empty">{{ __('rentals.structure.placeholder_description') }}</div>
        @endif
    </section>
@endsection
