@extends('layouts.admin')

@section('title', __('admin.structures.create_title'))
@section('page_title', __('admin.structures.create_title'))
@section('page_subtitle', 'Compila prima l\'italiano, poi aggiungi le traduzioni manuali.')

@section('page_actions')
    <a class="btn btn-light border btn-icon" href="{{ route('admin.structures.index') }}">
        <i data-lucide="arrow-left" class="admin-icon" aria-hidden="true"></i>
        {{ __('admin.actions.back') }}
    </a>
@endsection

@section('content')
    <div class="card admin-card admin-form-card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.structures.store') }}" class="row g-3" enctype="multipart/form-data">
                @csrf
                @include('admin.structures.partials.form', ['structure' => null])
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
