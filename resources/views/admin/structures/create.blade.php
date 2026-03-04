@extends('layouts.admin')

@section('title', __('admin.structures.create_title'))
@section('page_title', __('admin.structures.create_title'))

@section('content')
    <div class="mb-3">
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.structures.index') }}">← Torna all'elenco</a>
    </div>

    <div class="card admin-card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.structures.store') }}" class="row g-3" enctype="multipart/form-data">
                @csrf
                @include('admin.structures.partials.form', ['structure' => null])
                <div class="d-flex gap-2">
                    <button class="btn btn-primary" type="submit">{{ __('admin.actions.save') }}</button>
                    <a class="btn btn-light border" href="{{ route('admin.structures.index') }}">Annulla</a>
                </div>
            </form>
        </div>
    </div>
@endsection
