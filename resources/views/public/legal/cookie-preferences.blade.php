@extends('layouts.public')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ __('legal.cookie_preferences.title') }}</h1>
    <p class="text-body-secondary">{{ __('legal.cookie_preferences.updated_at') }}</p>

    <p>{{ __('legal.cookie_preferences.intro') }}</p>
    <p class="text-body-secondary">{{ __('legal.cookie_preferences.note') }}</p>
</div>
@endsection
