@extends('layouts.admin')

@section('title', __('admin.structures.create_title'))

@section('content')
    <h1>{{ __('admin.structures.create_title') }}</h1>

    <form method="POST" action="{{ route('admin.structures.store') }}">
        @csrf
        @include('admin.structures.partials.form', ['structure' => null])
        <button type="submit">{{ __('admin.actions.save') }}</button>
    </form>
@endsection
