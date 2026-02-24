@extends('layouts.admin')

@section('title', __('admin.structures.edit_title', ['name' => $structure->name]))
@section('page_title', __('admin.structures.edit_title', ['name' => $structure->name]))

@section('content')
    <h1 class="h3 mb-4">{{ __('admin.structures.edit_title', ['name' => $structure->name]) }}</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.structures.update', $structure) }}" class="row g-3" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.structures.partials.form', ['structure' => $structure])
                <div>
                    <button class="btn btn-primary" type="submit">{{ __('admin.actions.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
