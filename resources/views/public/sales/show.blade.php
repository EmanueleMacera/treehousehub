@extends('layouts.public')

@section('title', __('sales.meta.detail_title', ['slug' => $slug]))

@section('content')
    <h1>{{ __('sales.detail.title') }}</h1>
    <p>{{ __('sales.detail.placeholder', ['slug' => $slug]) }}</p>
@endsection
