@extends('layouts.admin')

@section('title', __('admin.structures.edit_title', ['name' => $structure->name]))

@section('content')
    <h1>{{ __('admin.structures.edit_title', ['name' => $structure->name])) }}</h1>

    <form method="POST" action="{{ route('admin.structures.update', $structure) }}">
        @csrf
        @method('PUT')
        @include('admin.structures.partials.form', ['structure' => $structure])
        <button type="submit">{{ __('admin.actions.save') }}</button>
    </form>
@endsection
