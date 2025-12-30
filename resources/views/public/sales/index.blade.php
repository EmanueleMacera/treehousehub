@extends('layouts.public')

@section('title', __('sales.meta.title'))

@section('content')
    <h1>{{ __('sales.hero.title') }}</h1>
    <p>{{ __('sales.hero.subtitle') }}</p>

    @if($properties->count() === 0)
        <p>{{ __('sales.empty') }}</p>
    @else
        <ul>
            @foreach($properties as $property)
                <li>
                    <h3>{{ $property->title }}</h3>
                    @if($property->location)
                        <p>{{ $property->location }}</p>
                    @endif
                    @if($property->description_short)
                        <p>{{ $property->description_short }}</p>
                    @endif
                    <a href="{{ route('sales.show', ['locale' => app()->getLocale(), 'slug' => $property->slug]) }}">
                        {{ __('sales.actions.discover') }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
