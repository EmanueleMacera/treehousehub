@extends('layouts.public')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ __('legal.terms.title') }}</h1>
    <p class="text-body-secondary">{{ __('legal.terms.updated_at') }}</p>

    <p>{{ __('legal.terms.intro') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.terms.use_title') }}</h2>
    <p>{{ __('legal.terms.use_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.terms.liability_title') }}</h2>
    <p>{{ __('legal.terms.liability_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.terms.changes_title') }}</h2>
    <p>{{ __('legal.terms.changes_text') }}</p>
</div>
@endsection
