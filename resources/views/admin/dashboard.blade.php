@extends('layouts.admin')

@section('title', __('admin.dashboard.title'))
@section('page_title', __('admin.dashboard.title'))
@section('page_subtitle', __('admin.dashboard.subtitle'))

@section('page_actions')
    <a class="btn btn-primary btn-icon" href="{{ route('admin.structures.create') }}">
        <i data-lucide="plus" class="admin-icon" aria-hidden="true"></i>
        {{ __('admin.structures.actions.create') }}
    </a>
    <a class="btn btn-outline-primary btn-icon" href="{{ route('admin.sales.create') }}">
        <i data-lucide="plus" class="admin-icon" aria-hidden="true"></i>
        {{ __('admin.sales.actions.create') }}
    </a>
@endsection

@section('content')
    <div class="admin-stat-grid">
        <div class="admin-stat">
            <span>{{ __('admin.dashboard.stats.structures_total') }}</span>
            <strong>{{ $stats['structures_total'] }}</strong>
        </div>
        <div class="admin-stat">
            <span>{{ __('admin.dashboard.stats.structures_active') }}</span>
            <strong>{{ $stats['structures_active'] }}</strong>
        </div>
        <div class="admin-stat">
            <span>{{ __('admin.dashboard.stats.sales_total') }}</span>
            <strong>{{ $stats['sales_total'] }}</strong>
        </div>
        <div class="admin-stat">
            <span>{{ __('admin.dashboard.stats.sales_active') }}</span>
            <strong>{{ $stats['sales_active'] }}</strong>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-12 col-xl-5">
            <div class="card admin-card h-100">
                <div class="card-body">
                    <div class="admin-section-head">
                        <h2 class="admin-panel-title h5">{{ __('admin.dashboard.health.title') }}</h2>
                    </div>
                    <div class="admin-list">
                        <div class="admin-list-item">
                            <span>{{ __('admin.dashboard.health.database') }}</span>
                            <span class="admin-status {{ $health['database'] ? 'admin-status--on' : 'admin-status--off' }}">{{ $health['database'] ? __('admin.dashboard.ok') : __('admin.dashboard.ko') }}</span>
                        </div>
                        <div class="admin-list-item">
                            <span>{{ __('admin.dashboard.health.storage_public_writable') }}</span>
                            <span class="admin-status {{ $health['storage_public_writable'] ? 'admin-status--on' : 'admin-status--off' }}">{{ $health['storage_public_writable'] ? __('admin.dashboard.ok') : __('admin.dashboard.ko') }}</span>
                        </div>
                        <div class="admin-list-item">
                            <span>{{ __('admin.dashboard.health.app_key_set') }}</span>
                            <span class="admin-status {{ $health['app_key_set'] ? 'admin-status--on' : 'admin-status--off' }}">{{ $health['app_key_set'] ? __('admin.dashboard.ok') : __('admin.dashboard.ko') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-7">
            <div class="card admin-card h-100">
                <div class="card-body">
                    <div class="admin-section-head">
                        <h2 class="admin-panel-title h5">{{ __('admin.dashboard.quick_actions') }}</h2>
                    </div>
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <a class="btn btn-primary w-100 btn-icon justify-content-center" href="{{ route('admin.structures.create') }}">
                                <i data-lucide="home" class="admin-icon" aria-hidden="true"></i>
                                {{ __('admin.structures.actions.create') }}
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a class="btn btn-outline-primary w-100 btn-icon justify-content-center" href="{{ route('admin.sales.create') }}">
                                <i data-lucide="euro" class="admin-icon" aria-hidden="true"></i>
                                {{ __('admin.sales.actions.create') }}
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a class="btn btn-light border w-100 btn-icon justify-content-center" href="{{ route('admin.structures.index') }}">
                                <i data-lucide="list" class="admin-icon" aria-hidden="true"></i>
                                {{ __('admin.nav.structures') }}
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a class="btn btn-light border w-100 btn-icon justify-content-center" href="{{ route('admin.sales.index') }}">
                                <i data-lucide="list" class="admin-icon" aria-hidden="true"></i>
                                {{ __('admin.nav.sales') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-xl-6">
            <div class="card admin-card h-100">
                <div class="card-body">
                    <div class="admin-section-head">
                        <h2 class="admin-panel-title h5">{{ __('admin.dashboard.latest_structures') }}</h2>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.structures.index') }}">{{ __('admin.nav.structures') }}</a>
                    </div>
                    <div class="admin-list">
                        @forelse($latestStructures as $item)
                            <div class="admin-list-item">
                                <div class="admin-title-cell">
                                    <a href="{{ route('admin.structures.edit', $item) }}" class="text-decoration-none fw-semibold">{{ $item->name }}</a>
                                    <small>{{ $item->updated_at?->format('d/m/Y H:i') }}</small>
                                </div>
                                <span class="admin-status {{ $item->active ? 'admin-status--on' : 'admin-status--off' }}">{{ $item->active ? 'ON' : 'OFF' }}</span>
                            </div>
                        @empty
                            <div class="admin-empty"><strong>Nessun affitto presente.</strong></div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card admin-card h-100">
                <div class="card-body">
                    <div class="admin-section-head">
                        <h2 class="admin-panel-title h5">{{ __('admin.dashboard.latest_sales') }}</h2>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.sales.index') }}">{{ __('admin.nav.sales') }}</a>
                    </div>
                    <div class="admin-list">
                        @forelse($latestSales as $item)
                            <div class="admin-list-item">
                                <div class="admin-title-cell">
                                    <a href="{{ route('admin.sales.edit', ['sale' => $item]) }}" class="text-decoration-none fw-semibold">{{ $item->title }}</a>
                                    <small>{{ $item->updated_at?->format('d/m/Y H:i') }}</small>
                                </div>
                                <span class="admin-status {{ $item->active ? 'admin-status--on' : 'admin-status--off' }}">{{ $item->active ? 'ON' : 'OFF' }}</span>
                            </div>
                        @empty
                            <div class="admin-empty"><strong>Nessuna vendita presente.</strong></div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
