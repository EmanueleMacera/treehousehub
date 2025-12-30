@extends('layouts.admin')

@section('title', __('admin.sales.edit_title', ['title' => $property->title]))

@section('content')
    <h1>{{ __('admin.sales.edit_title', ['title' => $property->title]) }}</h1>

    <form method="POST" action="{{ route('admin.sales.update', ['sale' => $property]) }}">
        @csrf
        @method('PUT')
        @include('admin.sales.partials.form', ['property' => $property])
        <button type="submit">{{ __('admin.actions.save') }}</button>
    </form>
@endsection
