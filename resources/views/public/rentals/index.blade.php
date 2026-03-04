@extends('layouts.public')

@section('title', __('rentals.meta.title'))

@section('content')
    <h1>{{ __('rentals.hero.title') }}</h1>
    <p>{{ __('rentals.hero.subtitle') }}</p>

    <section>
        <h2>{{ __('rentals.list.title') }}</h2>

        <ul>
            @foreach ($structures as $structure)
                <li>
                    @if($structure->image_path)
                        <p><img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->name }}" style="max-width:220px;height:auto;"></p>
                    @endif
                    <h3>{{ $structure->name }}</h3>
                    @if($structure->location)
                        <p><strong>{{ $structure->location }}</strong>@if($structure->address) · {{ $structure->address }} @endif</p>
                    @endif
                    @if($structure->description_short)
                        <p>{{ $structure->description_short }}</p>
                    @endif
                    <a href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'slug' => $structure->slug]) }}">{{ __('rentals.actions.discover') }}</a>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
