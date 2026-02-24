@extends('layouts.admin')

@section('title', __('admin.dashboard.title'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ __('admin.dashboard.title') }}</h1>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">{{ __('admin.dashboard.stats.structures_total') }}</div>
                    <div class="h4 mb-0">{{ $stats['structures_total'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">{{ __('admin.dashboard.stats.structures_active') }}</div>
                    <div class="h4 mb-0">{{ $stats['structures_active'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">{{ __('admin.dashboard.stats.sales_total') }}</div>
                    <div class="h4 mb-0">{{ $stats['sales_total'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">{{ __('admin.dashboard.stats.admins_total') }}</div>
                    <div class="h4 mb-0">{{ $stats['admins_total'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <strong>{{ __('admin.dashboard.health.title') }}</strong>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ __('admin.dashboard.health.database') }}</span>
                <span class="badge {{ $health['database'] ? 'text-bg-success' : 'text-bg-danger' }}">{{ $health['database'] ? __('admin.dashboard.ok') : __('admin.dashboard.ko') }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ __('admin.dashboard.health.storage_public_writable') }}</span>
                <span class="badge {{ $health['storage_public_writable'] ? 'text-bg-success' : 'text-bg-danger' }}">{{ $health['storage_public_writable'] ? __('admin.dashboard.ok') : __('admin.dashboard.ko') }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ __('admin.dashboard.health.app_key_set') }}</span>
                <span class="badge {{ $health['app_key_set'] ? 'text-bg-success' : 'text-bg-danger' }}">{{ $health['app_key_set'] ? __('admin.dashboard.ok') : __('admin.dashboard.ko') }}</span>
            </li>
        </ul>
    </div>
@endsection
