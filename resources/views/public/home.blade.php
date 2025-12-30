@extends('layouts.public')

@section('title', __('home.meta.title'))

@section('content')
    <h1>{{ __('home.hero.title') }}</h1>
    <p>{{ __('home.hero.subtitle') }}</p>

    <section>
        <h2>{{ __('home.sections.entrypoints.title') }}</h2>
        <ul>
            <li><a href="{{ route('rentals.index') }}">{{ __('home.sections.entrypoints.rentals') }}</a></li>
            <li><a href="{{ route('sales.index') }}">{{ __('home.sections.entrypoints.sales') }}</a></li>
        </ul>
    </section>
@endsection
