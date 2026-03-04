@extends('layouts.admin')

@section('title', __('admin.structures.edit_title', ['name' => $structure->name]))
@section('page_title', __('admin.structures.edit_title', ['name' => $structure->name]))

@section('content')
    <div class="mb-3">
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.structures.index') }}">← Torna all'elenco</a>
    </div>

    <div class="card admin-card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.structures.update', $structure) }}" class="row g-3" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.structures.partials.form', ['structure' => $structure])
                <div class="d-flex gap-2">
                    <button class="btn btn-primary" type="submit">{{ __('admin.actions.save') }}</button>
                    <a class="btn btn-light border" href="{{ route('admin.structures.index') }}">Annulla</a>
                </div>
            </form>
        </div>
    </div>
@endsection
