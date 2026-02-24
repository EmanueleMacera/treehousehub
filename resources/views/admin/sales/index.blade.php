@extends('layouts.admin')

@section('title', __('admin.sales.index_title'))
@section('page_title', __('admin.sales.index_title'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ __('admin.sales.index_title') }}</h1>
        <a class="btn btn-primary" href="{{ route('admin.sales.create') }}">{{ __('admin.sales.actions.create') }}</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>{{ __('admin.sales.fields.title') }}</th>
                    <th>{{ __('admin.sales.fields.slug') }}</th>
                    <th>{{ __('admin.sales.fields.active') }}</th>
                    <th>{{ __('admin.sales.fields.order') }}</th>
                    <th class="text-end">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @forelse($properties as $property)
                    <tr>
                        <td>{{ $property->id }}</td>
                        <td>{{ $property->title }}</td>
                        <td><code>{{ $property->slug }}</code></td>
                        <td>
                            <span class="badge {{ $property->active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                {{ $property->active ? 'ON' : 'OFF' }}
                            </span>
                        </td>
                        <td>{{ $property->sort_order }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.sales.edit', ['sale' => $property]) }}">{{ __('admin.actions.edit') }}</a>
                            <form method="POST" action="{{ route('admin.sales.destroy', ['sale' => $property]) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('{{ __('admin.actions.confirm_delete') }}')">
                                    {{ __('admin.actions.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Nessun immobile presente.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
