@extends('layouts.public')

@section('title', __('owners.meta.title'))

@section('content')
    <h1>{{ __('owners.hero.title') }}</h1>
    <p>{{ __('owners.hero.subtitle') }}</p>

    @if(isset($page) && $page?->content)
        {!! $page->content !!}
    @endif

    <h2>{{ __('owners.gestiohouse.title') }}</h2>
    <p>{{ __('owners.gestiohouse.text') }}</p>
    <p><a href="https://gestiohouse.com/" target="_blank" rel="noopener noreferrer">{{ __('owners.gestiohouse.cta') }}</a></p>
@endsection
