@extends('layouts.admin')

@section('title', __('admin.structures.index_title'))
@section('page_title', __('admin.structures.index_title'))
@section('page_subtitle', 'Gestisci affitti, foto, descrizioni multilingua e visibilita sul sito.')

@section('page_actions')
    <a class="btn btn-primary btn-icon" href="{{ route('admin.structures.create') }}">
        <i data-lucide="plus" class="admin-icon" aria-hidden="true"></i>
        {{ __('admin.structures.actions.create') }}
    </a>
@endsection

@section('content')
    <div class="admin-section-head">
        <p>{{ $structures->count() }} elementi ordinati per priorita.</p>
    </div>

    <div class="card admin-card admin-table-card">
        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                <tr>
                    <th>Affitto</th>
                    <th>{{ __('admin.structures.fields.location') }}</th>
                    <th>{{ __('admin.structures.fields.active') }}</th>
                    <th>{{ __('admin.structures.fields.order') }}</th>
                    <th class="text-end">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @forelse($structures as $structure)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($structure->image_path)
                                    <img class="admin-thumb" src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->name }}">
                                @else
                                    <span class="admin-thumb admin-thumb--empty"><i data-lucide="image" class="admin-icon" aria-hidden="true"></i></span>
                                @endif
                                <div class="admin-title-cell">
                                    <strong>{{ $structure->name }}</strong>
                                    <small>{{ $structure->address ?: $structure->slug }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $structure->location ?: '-' }}</td>
                        <td><span class="admin-status {{ $structure->active ? 'admin-status--on' : 'admin-status--off' }}">{{ $structure->active ? 'ON' : 'OFF' }}</span></td>
                        <td>{{ $structure->sort_order }}</td>
                        <td class="text-end">
                            <div class="admin-row-actions">
                                <a class="btn btn-sm btn-outline-primary btn-icon" href="{{ route('admin.structures.edit', $structure) }}">
                                    <i data-lucide="pencil" class="admin-icon" aria-hidden="true"></i>
                                    {{ __('admin.actions.edit') }}
                                </a>
                                <form method="POST" action="{{ route('admin.structures.destroy', $structure) }}">
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
                        <td colspan="5">
                            <div class="admin-empty">
                                <strong>Nessun affitto presente.</strong>
                                <a class="btn btn-primary" href="{{ route('admin.structures.create') }}">{{ __('admin.structures.actions.create') }}</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
