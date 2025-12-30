@extends('layouts.public')

@section('title', __('about.meta.title'))

@section('content')
    <h1>{{ __('about.hero.title') }}</h1>
    <p>{{ __('about.hero.subtitle') }}</p>

    <p>{{ __('about.body') }}</p>
@endsection
