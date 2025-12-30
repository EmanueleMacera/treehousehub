@extends('layouts.public')

@section('title', $property->title)

@section('content')
    <h1>{{ $property->title }}</h1>

    @if($property->location)
        <p><strong>{{ __('sales.fields.location') }}:</strong> {{ $property->location }}</p>
    @endif

    @if(!is_null($property->price))
        <p><strong>{{ __('sales.fields.price') }}:</strong> {{ number_format($property->price, 0, ',', '.') }}</p>
    @endif

    @if($property->description_long)
        <p>{{ $property->description_long }}</p>
    @elseif($property->description_short)
        <p>{{ $property->description_short }}</p>
    @endif

    <p><a href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">{{ __('sales.actions.back') }}</a></p>
@endsection
