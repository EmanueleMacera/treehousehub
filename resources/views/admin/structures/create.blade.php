@extends('layouts.admin')

@section('title', __('admin.structures.create_title'))

@section('content')
    <h1 class="h3 mb-4">{{ __('admin.structures.create_title') }}</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.structures.store') }}" class="row g-3" enctype="multipart/form-data">
                @csrf
                @include('admin.structures.partials.form', ['structure' => null])
                <div>
                    <button class="btn btn-primary" type="submit">{{ __('admin.actions.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
