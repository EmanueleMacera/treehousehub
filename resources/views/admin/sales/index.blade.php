@extends('layouts.admin')

@section('title', __('admin.sales.index_title'))
@section('page_title', __('admin.sales.index_title'))
@section('page_subtitle', 'Gestisci immobili in vendita, prezzi, descrizioni e ordinamento.')

@section('page_actions')
    <a class="btn btn-primary btn-icon" href="{{ route('admin.sales.create') }}">
        <i data-lucide="plus" class="admin-icon" aria-hidden="true"></i>
        {{ __('admin.sales.actions.create') }}
    </a>
@endsection

@section('content')
    <div class="admin-section-head">
        <p>{{ $properties->count() }} immobili ordinati per priorita.</p>
    </div>

    <div class="card admin-card admin-table-card">
        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                <tr>
                    <th>Foto</th>
                    <th>{{ __('admin.sales.fields.title') }}</th>
                    <th>Area</th>
                    <th>Categoria</th>
                    <th>{{ __('admin.sales.fields.location') }}</th>
                    <th>{{ __('admin.sales.fields.price') }}</th>
                    <th>{{ __('admin.sales.fields.active') }}</th>
                    <th>{{ __('admin.sales.fields.order') }}</th>
                    <th class="text-end">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @forelse($properties as $property)
                    @php($thumbnail = $property->thumbnail())
                    <tr>
                        <td>
                            @if($thumbnail?->url())
                                <img class="admin-thumb" src="{{ $thumbnail->url() }}" alt="{{ $property->title }}">
                            @else
                                <span class="admin-thumb admin-thumb--empty"><i data-lucide="image" class="admin-icon" aria-hidden="true"></i></span>
                            @endif
                        </td>
                        <td>
                            <div class="admin-title-cell">
                                <strong>{{ $property->title }}</strong>
                                <small>{{ $property->property_type ?: $property->slug }}</small>
                            </div>
                        </td>
                        <td><span class="admin-status admin-status--off">{{ $property->regionLabel() }}</span></td>
                        <td>
                            <div class="admin-title-cell">
                                <strong>{{ $property->category?->name ?? '-' }}</strong>
                                <small>{{ $property->category?->type?->name ?? '' }}</small>
                            </div>
                        </td>
                        <td>{{ $property->address ?: $property->location ?: '-' }}</td>
                        <td>{{ $property->price ? 'EUR ' . number_format($property->price, 0, ',', '.') : '-' }}</td>
                        <td><span class="admin-status {{ $property->active ? 'admin-status--on' : 'admin-status--off' }}">{{ $property->active ? 'ON' : 'OFF' }}</span></td>
                        <td>{{ $property->sort_order }}</td>
                        <td class="text-end">
                            <div class="admin-row-actions">
                                <a class="btn btn-sm btn-outline-primary btn-icon" href="{{ route('admin.sales.edit', ['sale' => $property]) }}">
                                    <i data-lucide="pencil" class="admin-icon" aria-hidden="true"></i>
                                    {{ __('admin.actions.edit') }}
                                </a>
                                <form method="POST" action="{{ route('admin.sales.destroy', ['sale' => $property]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger btn-icon" type="submit" onclick="return confirm('{{ __('admin.actions.confirm_delete') }}')">
                                        <i data-lucide="trash-2" class="admin-icon" aria-hidden="true"></i>
                                        {{ __('admin.actions.delete') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="admin-empty">
                                <strong>Nessun immobile presente.</strong>
                                <a class="btn btn-primary" href="{{ route('admin.sales.create') }}">{{ __('admin.sales.actions.create') }}</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
