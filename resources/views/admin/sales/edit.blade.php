@extends('layouts.admin')

@section('title', __('admin.sales.edit_title', ['title' => $property->title]))
@section('page_title', __('admin.sales.edit_title', ['title' => $property->title]))

@section('content')
    <h1 class="h3 mb-4">{{ __('admin.sales.edit_title', ['title' => $property->title]) }}</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sales.update', ['sale' => $property]) }}" class="row g-3">
                @csrf
                @method('PUT')
                @include('admin.sales.partials.form', ['property' => $property])
                <div>
                    <button class="btn btn-primary" type="submit">{{ __('admin.actions.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
