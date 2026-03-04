@extends('layouts.public')

@section('title', $structure->name)

@section('content')
    <h1>{{ $structure->name }}</h1>

    @if($structure->image_path)
        <p><img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->name }}" style="max-width:480px;height:auto;"></p>
    @endif

    @if($structure->location || $structure->address)
        <p>
            @if($structure->location)<strong>{{ $structure->location }}</strong>@endif
            @if($structure->address) · {{ $structure->address }} @endif
        </p>
    @endif

    @if($structure->description_long)
        <p>{{ $structure->description_long }}</p>
    @elseif($structure->description_short)
        <p>{{ $structure->description_short }}</p>
    @else
        <p>{{ __('rentals.structure.placeholder_description') }}</p>
    @endif

    @if($structure->external_url)
        <p>
            <a href="{{ $structure->external_url }}" target="_blank" rel="noopener noreferrer">
                {{ __('rentals.actions.visit_official_site') }}
            </a>
        </p>
    @endif

    @if($otherStructures->count())
        <hr>
        <h2>{{ __('rentals.other.title') }}</h2>
        <ul>
            @foreach($otherStructures as $s)
                <li><a href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'slug' => $s->slug]) }}">{{ $s->name }}</a></li>
            @endforeach
        </ul>
    @endif
@endsection
