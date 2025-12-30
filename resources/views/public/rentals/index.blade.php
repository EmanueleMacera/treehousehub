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
                    <h3>{{ $structure->name }}</h3>
                    @if($structure->description_short)
                        <p>{{ $structure->description_short }}</p>
                    @endif
                    <a href="{{ route('rentals.show', $structure->slug) }}">{{ __('rentals.actions.discover') }}</a>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
