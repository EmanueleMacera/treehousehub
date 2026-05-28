@extends('layouts.admin')

@section('title', __('admin.structures.edit_title', ['name' => $structure->name]))
@section('page_title', __('admin.structures.edit_title', ['name' => $structure->name]))
@section('page_subtitle', 'Aggiorna contenuti, foto, traduzioni e pubblicazione.')

@section('page_actions')
    <a class="btn btn-light border btn-icon" href="{{ route('admin.structures.index') }}">
        <i data-lucide="arrow-left" class="admin-icon" aria-hidden="true"></i>
        {{ __('admin.actions.back') }}
    </a>
@endsection

@section('content')
    <div class="card admin-card admin-form-card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.structures.update', $structure) }}" class="row g-3" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.structures.partials.form', ['structure' => $structure])
                <div class="admin-sticky-actions d-flex gap-2 justify-content-end">
                    <a class="btn btn-light border" href="{{ route('admin.structures.index') }}">{{ __('admin.actions.cancel') }}</a>
                    <button class="btn btn-primary btn-icon" type="submit">
                        <i data-lucide="save" class="admin-icon" aria-hidden="true"></i>
                        {{ __('admin.actions.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
