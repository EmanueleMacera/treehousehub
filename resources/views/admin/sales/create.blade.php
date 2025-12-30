@extends('layouts.admin')

@section('title', __('admin.sales.create_title'))

@section('content')
    <h1>{{ __('admin.sales.create_title') }}</h1>

    <form method="POST" action="{{ route('admin.sales.store') }}">
        @csrf
        @include('admin.sales.partials.form', ['property' => null])
        <button type="submit">{{ __('admin.actions.save') }}</button>
    </form>
@endsection
