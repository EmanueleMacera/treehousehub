@extends('layouts.admin')

@section('title', __('admin.dashboard.title'))
@section('page_title', __('admin.dashboard.title'))

@section('content')
    <div class="row g-3 mb-3">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card admin-card h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ __('admin.dashboard.stats.structures_total') }}</div>
                    <div class="display-6 fw-semibold">{{ $stats['structures_total'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card admin-card h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ __('admin.dashboard.stats.structures_active') }}</div>
                    <div class="display-6 fw-semibold">{{ $stats['structures_active'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card admin-card h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ __('admin.dashboard.stats.sales_total') }}</div>
                    <div class="display-6 fw-semibold">{{ $stats['sales_total'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card admin-card h-100">
                <div class="card-body">
                    <div class="text-muted small">{{ __('admin.dashboard.stats.sales_active') }}</div>
                    <div class="display-6 fw-semibold">{{ $stats['sales_active'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-12 col-xl-6">
            <div class="card admin-card h-100">
                <div class="card-header bg-white border-0 pb-0"><strong>{{ __('admin.dashboard.health.title') }}</strong></div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between px-0"><span>{{ __('admin.dashboard.health.database') }}</span><span class="badge {{ $health['database'] ? 'text-bg-success' : 'text-bg-danger' }}">{{ $health['database'] ? __('admin.dashboard.ok') : __('admin.dashboard.ko') }}</span></li>
                        <li class="list-group-item d-flex justify-content-between px-0"><span>{{ __('admin.dashboard.health.storage_public_writable') }}</span><span class="badge {{ $health['storage_public_writable'] ? 'text-bg-success' : 'text-bg-danger' }}">{{ $health['storage_public_writable'] ? __('admin.dashboard.ok') : __('admin.dashboard.ko') }}</span></li>
                        <li class="list-group-item d-flex justify-content-between px-0"><span>{{ __('admin.dashboard.health.app_key_set') }}</span><span class="badge {{ $health['app_key_set'] ? 'text-bg-success' : 'text-bg-danger' }}">{{ $health['app_key_set'] ? __('admin.dashboard.ok') : __('admin.dashboard.ko') }}</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card admin-card h-100">
                <div class="card-header bg-white border-0 pb-0"><strong>{{ __('admin.dashboard.quick_actions') }}</strong></div>
                <div class="card-body d-grid gap-2">
                    <a class="btn btn-primary" href="{{ route('admin.structures.create') }}">+ {{ __('admin.structures.actions.create') }}</a>
                    <a class="btn btn-outline-primary" href="{{ route('admin.sales.create') }}">+ {{ __('admin.sales.actions.create') }}</a>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.structures.index') }}">{{ __('admin.nav.structures') }}</a>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.sales.index') }}">{{ __('admin.nav.sales') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-xl-6">
            <div class="card admin-card h-100">
                <div class="card-header bg-white border-0 pb-0"><strong>{{ __('admin.dashboard.latest_structures') }}</strong></div>
                <div class="card-body">
                    @forelse($latestStructures as $item)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <a href="{{ route('admin.structures.edit', $item) }}" class="text-decoration-none fw-semibold">{{ $item->name }}</a>
                                <div class="small text-muted">{{ $item->updated_at?->format('d/m/Y H:i') }}</div>
                            </div>
                            <span class="badge {{ $item->active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->active ? 'ON' : 'OFF' }}</span>
                        </div>
                    @empty
                        <div class="text-muted">Nessuna struttura presente.</div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card admin-card h-100">
                <div class="card-header bg-white border-0 pb-0"><strong>{{ __('admin.dashboard.latest_sales') }}</strong></div>
                <div class="card-body">
                    @forelse($latestSales as $item)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <a href="{{ route('admin.sales.edit', ['sale' => $item]) }}" class="text-decoration-none fw-semibold">{{ $item->title }}</a>
                                <div class="small text-muted">{{ $item->updated_at?->format('d/m/Y H:i') }}</div>
                            </div>
                            <span class="badge {{ $item->active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->active ? 'ON' : 'OFF' }}</span>
                        </div>
                    @empty
                        <div class="text-muted">Nessuna vendita presente.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
