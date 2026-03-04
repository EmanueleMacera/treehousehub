@extends('layouts.admin')

@section('title', __('admin.sales.index_title'))
@section('page_title', __('admin.sales.index_title'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted mb-0">Gestisci immobili in vendita, visibilità e ordinamento.</p>
        <a class="btn btn-primary" href="{{ route('admin.sales.create') }}">{{ __('admin.sales.actions.create') }}</a>
    </div>

    <div class="card admin-card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>{{ __('admin.sales.fields.title') }}</th>
                    <th>{{ __('admin.sales.fields.location') }}</th>
                    <th>{{ __('admin.sales.fields.price') }}</th>
                    <th>{{ __('admin.sales.fields.active') }}</th>
                    <th>{{ __('admin.sales.fields.order') }}</th>
                    <th class="text-end">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @forelse($properties as $property)
                    <tr>
                        <td>{{ $property->id }}</td>
                        <td>
                            <div class="fw-semibold">{{ $property->title }}</div>
                            <div class="small text-muted"><code>{{ $property->slug }}</code></div>
                        </td>
                        <td>{{ $property->location ?: '—' }}</td>
                        <td>{{ $property->price ? '€ '.number_format($property->price, 0, ',', '.') : '—' }}</td>
                        <td><span class="badge {{ $property->active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $property->active ? 'ON' : 'OFF' }}</span></td>
                        <td>{{ $property->sort_order }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.sales.edit', ['sale' => $property]) }}">{{ __('admin.actions.edit') }}</a>
                            <form method="POST" action="{{ route('admin.sales.destroy', ['sale' => $property]) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('{{ __('admin.actions.confirm_delete') }}')">{{ __('admin.actions.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-4 text-muted">Nessun immobile presente.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
