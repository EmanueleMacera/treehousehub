@extends('layouts.public')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ __('legal.cookies.title') }}</h1>
    <p class="text-body-secondary">{{ __('legal.cookies.updated_at') }}</p>

    <p>{{ __('legal.cookies.intro') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.cookies.what_are_title') }}</h2>
    <p>{{ __('legal.cookies.what_are_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.cookies.types_title') }}</h2>
    <p>{{ __('legal.cookies.types_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.cookies.manage_title') }}</h2>
    <p>{{ __('legal.cookies.manage_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.cookies.contact_title') }}</h2>
    <p>{{ __('legal.cookies.contact_text') }}</p>
</div>
@endsection
