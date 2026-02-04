@extends('layouts.public')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ __('legal.accessibility.title') }}</h1>
    <p class="text-body-secondary">{{ __('legal.accessibility.updated_at') }}</p>

    <p>{{ __('legal.accessibility.intro') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.accessibility.status_title') }}</h2>
    <p>{{ __('legal.accessibility.status_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.accessibility.feedback_title') }}</h2>
    <p>{{ __('legal.accessibility.feedback_text') }}</p>
</div>
@endsection
