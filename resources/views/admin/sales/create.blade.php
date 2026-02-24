@extends('layouts.admin')

@section('title', __('admin.sales.create_title'))

@section('content')
    <h1 class="h3 mb-4">{{ __('admin.sales.create_title') }}</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sales.store') }}" class="row g-3">
                @csrf
                @include('admin.sales.partials.form', ['property' => null])
                <div>
                    <button class="btn btn-primary" type="submit">{{ __('admin.actions.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
