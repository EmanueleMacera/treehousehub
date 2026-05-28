@extends('layouts.public')

@section('title', $property->title)

@section('content')
    @php
        $photos = $property->photos;
        $documents = $property->documentFiles();
        $videos = $property->videoFiles();
    @endphp

    <section class="sale-detail-hero">
        @if($property->property_type)
            <p class="sale-detail-hero__kicker">{{ str_replace('_', ' ', $property->property_type) }}</p>
        @endif
        <h1>{{ $property->title }}</h1>
        @if($property->category)
            <p>{{ $property->category->type?->name ? $property->category->type->name . ' / ' : '' }}{{ $property->category->name }}</p>
        @endif
        @if($property->address || $property->location)
            <p>{{ $property->address ?: $property->location }}</p>
        @endif
    </section>

    <section class="sale-detail-layout">
        <article class="sale-detail-main">
            @if($photos->count())
                <div class="sale-gallery">
                    <div class="sale-gallery__main">
                        <img src="{{ $photos->first()->url() }}" alt="{{ $property->title }}">
                    </div>
                    @if($photos->count() > 1)
                        <div class="sale-gallery__thumbs">
                            @foreach($photos->skip(1)->take(8) as $photo)
                                <a href="{{ $photo->url() }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ $photo->url() }}" alt="{{ $property->title }}">
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
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

            <div class="sale-detail-copy">
                @if($property->localizedDescription())
                    {!! $property->localizedDescription() !!}
                @elseif($property->description_short)
                    <p>{{ $property->description_short }}</p>
                @endif
            </div>
        </article>

        <aside class="sale-detail-side">
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

            @if($property->contact_name || $property->contact_phone)
                <div class="sale-detail-box">
                    <h2>{{ __('sales.detail.contact') }}</h2>
                    @if($property->contact_name)<p>{{ $property->contact_name }}</p>@endif
                    @if($property->contact_phone)<a class="sale-detail-cta" href="tel:{{ preg_replace('/\s+/', '', $property->contact_phone) }}">{{ $property->contact_phone }}</a>@endif
                </div>
            @endif

            <a class="sale-detail-back" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">{{ __('sales.actions.back') }}</a>
        </aside>
    </section>
@endsection
