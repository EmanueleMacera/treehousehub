@extends('layouts.public')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ __('legal.privacy.title') }}</h1>
    <p class="text-body-secondary">{{ __('legal.privacy.updated_at') }}</p>

    <p>{{ __('legal.privacy.intro') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.privacy.data_controller_title') }}</h2>
    <p>{{ __('legal.privacy.data_controller_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.privacy.data_processed_title') }}</h2>
    <p>{{ __('legal.privacy.data_processed_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.privacy.purposes_title') }}</h2>
    <p>{{ __('legal.privacy.purposes_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.privacy.rights_title') }}</h2>
    <p>{{ __('legal.privacy.rights_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.privacy.contact_title') }}</h2>
    <p>{{ __('legal.privacy.contact_text') }}</p>
</div>
@endsection
