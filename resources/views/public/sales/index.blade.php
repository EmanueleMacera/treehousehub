@extends('layouts.public')

@section('title', __('sales.meta.title'))

@section('content')
    <section class="sales-hero">
        <p class="sales-hero__kicker">TreeHouse Collection</p>
        <h1>{{ __('sales.hero.title') }}</h1>
        <p>{{ __('sales.hero.subtitle') }}</p>
    </section>

    <nav class="sales-filter" aria-label="{{ __('sales.filters.label') }}">
        <a class="{{ !$region ? 'active' : '' }}" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">
            {{ __('sales.filters.all') }}
            <span>{{ $regionCounts->sum() }}</span>
        </a>
        <a class="{{ $region === 'liguria' ? 'active' : '' }}" href="{{ route('sales.index', ['locale' => app()->getLocale(), 'region' => 'liguria']) }}">
            Liguria
            <span>{{ $regionCounts->get('liguria', 0) }}</span>
        </a>
        <a class="{{ $region === 'piemonte' ? 'active' : '' }}" href="{{ route('sales.index', ['locale' => app()->getLocale(), 'region' => 'piemonte']) }}">
            Piemonte
            <span>{{ $regionCounts->get('piemonte', 0) }}</span>
        </a>
    </nav>

    @if($categoryTypes->count())
        <nav class="sales-filter sales-filter--categories" aria-label="Categorie vendite">
            <a class="{{ !$macro && !$category ? 'active' : '' }}" href="{{ route('sales.index', ['locale' => app()->getLocale(), 'region' => $region]) }}">
                Tutte le categorie
            </a>
            @foreach($categoryTypes as $type)
                <a class="{{ (string) $macro === (string) $type->id ? 'active' : '' }}" href="{{ route('sales.index', ['locale' => app()->getLocale(), 'region' => $region, 'macro' => $type->id]) }}">
                    {{ $type->name }}
                    <span>{{ $type->sale_properties_count }}</span>
                </a>
                @foreach($type->categories as $filterCategory)
                    <a class="sales-filter__child {{ (string) $category === (string) $filterCategory->id ? 'active' : '' }}" href="{{ route('sales.index', ['locale' => app()->getLocale(), 'region' => $region, 'category' => $filterCategory->id]) }}">
                        {{ $filterCategory->name }}
                    </a>
                @endforeach
            @endforeach
        </nav>
    @endif

    @if($properties->count() === 0)
        <div class="sales-empty">{{ __('sales.empty') }}</div>
    @else
        <section class="sales-grid">
            @foreach($properties as $property)
                @php($thumbnail = $property->thumbnail())
                <article class="sale-card">
                    @if($thumbnail?->url())
                        <a class="sale-card__media" href="{{ route('sales.show', ['locale' => app()->getLocale(), 'slug' => $property->slug]) }}">
                            <img src="{{ $thumbnail->url() }}" alt="{{ $property->title }}">
                        </a>
                    @endif
                    <div class="sale-card__body">
                        <div class="sale-card__head">
                            <div>
                                @if($property->property_type)
                                    <span class="sale-card__type">{{ str_replace('_', ' ', $property->property_type) }}</span>
                                @endif
                                <h2>{{ $property->title }}</h2>
                                <small class="sale-card__region">{{ $property->category?->name ?? $property->regionLabel() }}</small>
                            </div>
                            @if(!is_null($property->price))
                                <strong class="sale-card__price">EUR {{ number_format($property->price, 0, ',', '.') }}</strong>
                            @endif
                        </div>

                        @if($property->address || $property->location)
                            <p class="sale-card__meta">{{ $property->address ?: $property->location }}</p>
                        @endif

                        <p class="sale-card__desc">{{ $property->summary() }}</p>

                        <div class="sale-card__facts">
                            @if($property->rooms)<span>{{ $property->rooms }} {{ __('sales.fields.rooms') }}</span>@endif
                            @if($property->bathrooms)<span>{{ $property->bathrooms }} {{ __('sales.fields.bathrooms') }}</span>@endif
                            @if($property->surface_commercial)<span>{{ number_format((float) $property->surface_commercial, 0, ',', '.') }} mq</span>@endif
                            @if($property->energy_class)<span>{{ __('sales.fields.energy_class') }} {{ $property->energy_class }}</span>@endif
                        </div>

                        <a class="sale-card__link" href="{{ route('sales.show', ['locale' => app()->getLocale(), 'slug' => $property->slug]) }}">
                            {{ __('sales.actions.discover') }}
                        </a>
                    </div>
                </article>
            @endforeach
        </section>
    @endif
@endsection
