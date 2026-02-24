@extends('layouts.admin')

@section('title', __('admin.structures.index_title'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ __('admin.structures.index_title') }}</h1>
        <a class="btn btn-primary" href="{{ route('admin.structures.create') }}">{{ __('admin.structures.actions.create') }}</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>{{ __('admin.structures.fields.name') }}</th>
                    <th>{{ __('admin.structures.fields.location') }}</th>
                    <th>{{ __('admin.structures.fields.active') }}</th>
                    <th>{{ __('admin.structures.fields.order') }}</th>
                    <th class="text-end">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @forelse($structures as $structure)
                    <tr>
                        <td>{{ $structure->id }}</td>
                        <td>
                            @if($structure->image_path)
                                <img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->name }}" style="height:48px;width:48px;object-fit:cover;" class="rounded border">
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $structure->name }}</strong>
                            <div class="small text-muted">{{ $structure->address ?? $structure->slug }}</div>
                        </td>
                        <td>{{ $structure->location }}</td>
                        <td>
                            <span class="badge {{ $structure->active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                {{ $structure->active ? 'ON' : 'OFF' }}
                            </span>
                        </td>
                        <td>{{ $structure->sort_order }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.structures.edit', $structure) }}">{{ __('admin.actions.edit') }}</a>
                            <form method="POST" action="{{ route('admin.structures.destroy', $structure) }}" class="d-inline">
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
                        <td colspan="7" class="text-center py-4 text-muted">Nessuna struttura presente.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
