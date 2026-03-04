@extends('layouts.admin')

@section('title', __('admin.sales.edit_title', ['title' => $property->title]))
@section('page_title', __('admin.sales.edit_title', ['title' => $property->title]))

@section('content')
    <div class="mb-3">
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.sales.index') }}">← Torna all'elenco</a>
    </div>

    <div class="card admin-card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sales.update', ['sale' => $property]) }}" class="row g-3">
                @csrf
                @method('PUT')
                @include('admin.sales.partials.form', ['property' => $property])
                <div class="d-flex gap-2">
                    <button class="btn btn-primary" type="submit">{{ __('admin.actions.save') }}</button>
                    <a class="btn btn-light border" href="{{ route('admin.sales.index') }}">Annulla</a>
                </div>
            </form>
        </div>
    </div>
@endsection
