@extends('layouts.public')

@section('title', $property->title)

@section('content')
    @php
        $photos = $property->photos;
        $documents = $property->documentFiles();
        $videos = $property->videoFiles();
    @endphp

    <section class="sale-detail-hero">
        <a class="sale-detail-backlink" href="{{ route('sales.index', ['locale' => app()->getLocale(), 'category' => $property->category_id]) }}">{{ __('sales.actions.back') }}</a>
        <p class="sale-detail-hero__kicker">{{ $property->category?->name ?? ($property->property_type ? str_replace('_', ' ', $property->property_type) : $property->regionLabel()) }}</p>
        <h1>{{ $property->title }}</h1>
        <div class="sale-detail-hero__meta">
            @if($property->category?->type)<span>{{ $property->category->type->name }}</span>@endif
            @if($property->address || $property->location)<span>{{ $property->address ?: $property->location }}</span>@endif
            @if(!is_null($property->price))<strong>EUR {{ number_format($property->price, 0, ',', '.') }}</strong>@endif
        </div>
    </section>

    <section class="sale-detail-layout">
        <article class="sale-detail-main">
            @if($photos->count())
                <div class="sale-gallery">
                    <a class="sale-gallery__main" href="{{ $photos->first()->url() }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ $photos->first()->url() }}" alt="{{ $property->title }}">
                    </a>
                    @if($photos->count() > 1)
                        <div class="sale-gallery__thumbs">
                            @foreach($photos->skip(1)->take(10) as $photo)
                                <a href="{{ $photo->url() }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ $photo->url() }}" alt="{{ $property->title }}">
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            @if($property->summary())
                <p class="sale-detail-lead">{{ $property->summary() }}</p>
            @endif

            <div class="sale-detail-summary">
                @if(!is_null($property->price))
                    <div>
                        <span>{{ __('sales.fields.price') }}</span>
                        <strong>EUR {{ number_format($property->price, 0, ',', '.') }}</strong>
                    </div>
                @endif
                @if($property->surface_commercial)
                    <div>
                        <span>{{ __('sales.fields.surface') }}</span>
                        <strong>{{ number_format((float) $property->surface_commercial, 0, ',', '.') }} mq</strong>
                    </div>
                @endif
                @if($property->rooms)
                    <div>
                        <span>{{ __('sales.fields.rooms') }}</span>
                        <strong>{{ $property->rooms }}</strong>
                    </div>
                @endif
                @if($property->bathrooms)
                    <div>
                        <span>{{ __('sales.fields.bathrooms') }}</span>
                        <strong>{{ $property->bathrooms }}</strong>
                    </div>
                @endif
            </div>

            @if($property->localizedDescription() || $property->description_short)
                <div class="sale-detail-copy">
                    <h2>{{ __('sales.detail.description') }}</h2>
                    @if($property->localizedDescription())
                    {!! $property->localizedDescription() !!}
                    @elseif($property->description_short)
                        <p>{{ $property->description_short }}</p>
                    @endif
                </div>
            @endif

            @if($property->nearby)
                <div class="sale-detail-copy sale-detail-copy--muted">
                    <h2>{{ __('sales.detail.nearby') }}</h2>
                    <p>{{ $property->nearby }}</p>
                </div>
            @endif
        </article>

        <aside class="sale-detail-side">
            <div class="sale-detail-box sale-detail-box--cta">
                <span>{{ __('sales.detail.interest') }}</span>
                <h2>{{ __('sales.detail.visit_title') }}</h2>
                <a class="sale-detail-cta" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('sales.actions.contact') }}</a>
                @if($property->contact_phone)
                    <a class="sale-detail-phone" href="tel:{{ preg_replace('/\s+/', '', $property->contact_phone) }}">{{ $property->contact_phone }}</a>
                @endif
            </div>

            <div class="sale-detail-box">
                <h2>{{ __('sales.detail.features') }}</h2>
                <ul>
                    @if($property->property_type)<li><span>{{ __('sales.fields.property_type') }}</span><strong>{{ str_replace('_', ' ', $property->property_type) }}</strong></li>@endif
                    @if($property->floor)<li><span>{{ __('sales.fields.floor') }}</span><strong>{{ $property->floor }}</strong></li>@endif
                    @if($property->construction_year)<li><span>{{ __('sales.fields.construction_year') }}</span><strong>{{ $property->construction_year }}</strong></li>@endif
                    @if($property->surface_residential)<li><span>Mq residenziali</span><strong>{{ number_format((float) $property->surface_residential, 0, ',', '.') }} mq</strong></li>@endif
                    @if($property->surface_balcony)<li><span>Mq balconi/terrazzi</span><strong>{{ number_format((float) $property->surface_balcony, 0, ',', '.') }} mq</strong></li>@endif
                    @if($property->garden_surface)<li><span>Mq giardino</span><strong>{{ number_format((float) $property->garden_surface, 0, ',', '.') }} mq</strong></li>@endif
                    @if($property->surface_common_parts)<li><span>Mq parti comuni</span><strong>{{ number_format((float) $property->surface_common_parts, 0, ',', '.') }} mq</strong></li>@endif
                    @if($property->thousandths)<li><span>Millesimi</span><strong>{{ number_format((float) $property->thousandths, 2, ',', '.') }}</strong></li>@endif
                    @if($property->balcony)<li><span>Balconi</span><strong>{{ $property->balcony }}</strong></li>@endif
                    @if($property->energy_class)<li><span>{{ __('sales.fields.energy_class') }}</span><strong>{{ $property->energy_class }}</strong></li>@endif
                    @if($property->condition)<li><span>{{ __('sales.fields.condition') }}</span><strong>{{ $property->condition }}</strong></li>@endif
                    @if($property->annual_fee)<li><span>{{ __('sales.fields.annual_fee') }}</span><strong>EUR {{ number_format((float) $property->annual_fee, 0, ',', '.') }}</strong></li>@endif
                    @if($property->monthly_expenses)<li><span>Spese mensili</span><strong>EUR {{ number_format((float) $property->monthly_expenses, 0, ',', '.') }}</strong></li>@endif
                    @if($property->imu_tax)<li><span>IMU</span><strong>EUR {{ number_format((float) $property->imu_tax, 0, ',', '.') }}</strong></li>@endif
                </ul>
            </div>

            @if(count($property->amenityList()))
                <div class="sale-detail-box">
                    <h2>{{ __('sales.detail.amenities') }}</h2>
                    <div class="sale-amenities">
                        @foreach($property->amenityList() as $amenity)
                            <span>{{ $amenity }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(count($documents) || count($videos))
                <div class="sale-detail-box">
                    <h2>Allegati</h2>
                    <div class="sale-attachments">
                        @foreach($documents as $document)
                            <a href="{{ $document['url'] }}" target="_blank" rel="noopener noreferrer">{{ $document['name'] }}</a>
                        @endforeach
                        @foreach($videos as $video)
                            <a href="{{ $video['url'] }}" target="_blank" rel="noopener noreferrer">{{ $video['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($property->contact_name)
                <div class="sale-detail-box">
                    <h2>{{ __('sales.detail.contact') }}</h2>
                    <p>{{ $property->contact_name }}</p>
                </div>
            @endif
        </aside>
    </section>
@endsection
