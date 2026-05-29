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

    <section class="sales-explorer" aria-label="Esplora immobili in vendita">
        <aside class="sales-browser">
            <div class="sales-browser__head">
                <span>{{ __('sales.categories.kicker') }}</span>
                <h2>{{ __('sales.categories.title') }}</h2>
                <p>{{ __('sales.categories.prompt') }}</p>
            </div>

            @if($showProperties)
                <a class="sales-browser__reset" href="{{ route('sales.index', ['locale' => app()->getLocale(), 'region' => $region]) }}">{{ __('sales.categories.back') }}</a>
            @endif

            <div class="sales-browser__list">
                @foreach($categoryGroups as $type)
                    @php
                        $typeUrl = route('sales.index', ['locale' => app()->getLocale(), 'region' => $region, 'macro' => $type->id]);
                    @endphp
                    <section class="sales-browser-group">
                        <a class="sales-browser-group__title {{ (string) $macro === (string) $type->id ? 'active' : '' }}" href="{{ $typeUrl }}">
                            <span>{{ $type->name }}</span>
                            <strong>{{ $type->visible_sale_properties_count }}</strong>
                        </a>

                        @if($type->visibleCategories->count())
                            <div class="sales-browser-group__items">
                                @foreach($type->visibleCategories as $filterCategory)
                                    <a class="{{ (string) $category === (string) $filterCategory->id ? 'active' : '' }}" href="{{ route('sales.index', ['locale' => app()->getLocale(), 'region' => $region, 'category' => $filterCategory->id]) }}">
                                        <span>{{ $filterCategory->name }}</span>
                                        <small>{{ $filterCategory->visible_sale_properties_count }}</small>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </section>
                @endforeach
            </div>
        </aside>

        <div class="sales-results-panel">
            @if(!$showProperties)
                <div class="sales-guide">
                    <div class="sales-guide__copy">
                        <span>{{ __('sales.guide.kicker') }}</span>
                        <h2>{{ __('sales.guide.title') }}</h2>
                        <p>{{ __('sales.guide.copy') }}</p>
                    </div>

                    <div class="sales-guide__choices">
                        @foreach($categoryGroups->take(4) as $type)
                            @php
                                $typePreview = $type->thumbnail?->url() ?: $type->previewProperty?->thumbnail()?->url();
                                $typeUrl = route('sales.index', ['locale' => app()->getLocale(), 'region' => $region, 'macro' => $type->id]);
                            @endphp
                            <a class="sales-guide-card" href="{{ $typeUrl }}">
                                <span class="sales-guide-card__media">
                                    @if($typePreview)
                                        <img src="{{ $typePreview }}" alt="{{ $type->name }}">
                                    @else
                                        {{ $type->name }}
                                    @endif
                                </span>
                                <span class="sales-guide-card__body">
                                    <strong>{{ $type->name }}</strong>
                                    <small>{{ trans_choice('sales.categories.count', $type->visible_sale_properties_count, ['count' => $type->visible_sale_properties_count]) }}</small>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                @if($properties->count() === 0)
                    <div class="sales-empty">{{ __('sales.empty') }}</div>
                @else
                    <div class="sales-section-head sales-section-head--results">
                        <div>
                            <span>{{ __('sales.results.kicker') }}</span>
                            <h2>{{ $selectedCategory?->name ?? $selectedMacro?->name ?? __('sales.results.title') }}</h2>
                        </div>
                        <p>{{ trans_choice('sales.results.count', $properties->count(), ['count' => $properties->count()]) }}</p>
                    </div>

                    <section class="sales-list">
                        @foreach($properties as $property)
                            @php
                                $thumbnail = $property->thumbnail();
                                $propertyUrl = route('sales.show', ['locale' => app()->getLocale(), 'sale' => $property->publicId()]);
                            @endphp
                            <article class="sale-card">
                                <a class="sale-card__media" href="{{ $propertyUrl }}">
                                    @if($thumbnail?->url())
                                        <img src="{{ $thumbnail->url() }}" alt="{{ $property->title }}">
                                    @else
                                        <span>{{ $property->category?->name ?? $property->regionLabel() }}</span>
                                    @endif
                                </a>
                                <div class="sale-card__body">
                                    <div class="sale-card__head">
                                        <div>
                                            <span class="sale-card__type">{{ $property->category?->name ?? $property->regionLabel() }}</span>
                                            <h2>{{ $property->title }}</h2>
                                            @if($property->address || $property->location)
                                                <small class="sale-card__region">{{ $property->address ?: $property->location }}</small>
                                            @endif
                                        </div>
                                        @if(!is_null($property->price))
                                            <strong class="sale-card__price">EUR {{ number_format($property->price, 0, ',', '.') }}</strong>
                                        @endif
                                    </div>

                                    @if($property->summary())
                                        <p class="sale-card__desc">{{ $property->summary() }}</p>
                                    @endif

                                    <div class="sale-card__facts">
                                        @if($property->rooms)<span>{{ $property->rooms }} {{ __('sales.fields.rooms') }}</span>@endif
                                        @if($property->bathrooms)<span>{{ $property->bathrooms }} {{ __('sales.fields.bathrooms') }}</span>@endif
                                        @if($property->surface_commercial)<span>{{ number_format((float) $property->surface_commercial, 0, ',', '.') }} mq</span>@endif
                                        @if($property->energy_class)<span>{{ __('sales.fields.energy_class') }} {{ $property->energy_class }}</span>@endif
                                    </div>

                                    <div class="sale-card__footer">
                                        @if($property->property_type)
                                            <span>{{ str_replace('_', ' ', $property->property_type) }}</span>
                                        @endif
                                        <a class="sale-card__link" href="{{ $propertyUrl }}">
                                        {{ __('sales.actions.discover') }}
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </section>
                @endif
            @endif
        </div>
    </section>
@endsection
