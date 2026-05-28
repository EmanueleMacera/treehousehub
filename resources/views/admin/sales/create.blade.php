@extends('layouts.admin')

@section('title', __('admin.sales.create_title'))
@section('page_title', __('admin.sales.create_title'))
@section('page_subtitle', 'Inserisci i dati principali dell\'immobile e la descrizione per la scheda pubblica.')

@section('page_actions')
    <a class="btn btn-light border btn-icon" href="{{ route('admin.sales.index') }}">
        <i data-lucide="arrow-left" class="admin-icon" aria-hidden="true"></i>
        {{ __('admin.actions.back') }}
    </a>
@endsection

@section('content')
    <div class="card admin-card admin-form-card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sales.store') }}" class="row g-3" enctype="multipart/form-data">
                @csrf
                @include('admin.sales.partials.form', ['property' => null])
                <div class="admin-sticky-actions d-flex gap-2 justify-content-end">
                    <a class="btn btn-light border" href="{{ route('admin.sales.index') }}">{{ __('admin.actions.cancel') }}</a>
                    <button class="btn btn-primary btn-icon" type="submit">
                        <i data-lucide="save" class="admin-icon" aria-hidden="true"></i>
                        {{ __('admin.actions.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
