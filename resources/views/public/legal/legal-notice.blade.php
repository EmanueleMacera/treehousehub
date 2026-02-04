@extends('layouts.public')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ __('legal.notice.title') }}</h1>
    <p class="text-body-secondary">{{ __('legal.notice.updated_at') }}</p>

    <p>{{ __('legal.notice.intro') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.notice.company_title') }}</h2>
    <p>{{ __('legal.notice.company_text') }}</p>

    <h2 class="h5 mt-4">{{ __('legal.notice.contacts_title') }}</h2>
    <p>{{ __('legal.notice.contacts_text') }}</p>
</div>
@endsection
