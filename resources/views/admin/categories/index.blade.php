@extends('layouts.admin')

@section('title', 'Categorie vendite')
@section('page_title', 'Categorie vendite')
@section('page_subtitle', 'Gestisci macro-categorie e categorie: gli immobili restano separati per area/progetto.')

@section('page_actions')
    <a class="btn btn-light border btn-icon" href="{{ route('admin.category-types.create') }}">
        <i data-lucide="folder-plus" class="admin-icon" aria-hidden="true"></i>
        Nuova macro
    </a>
    <a class="btn btn-primary btn-icon" href="{{ route('admin.categories.create') }}">
        <i data-lucide="plus" class="admin-icon" aria-hidden="true"></i>
        Nuova categoria
    </a>
@endsection

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-3"><div class="admin-stat-card"><span>Categorie</span><strong>{{ $stats['total_categories'] }}</strong></div></div>
        <div class="col-md-3"><div class="admin-stat-card"><span>Macro</span><strong>{{ $stats['total_types'] }}</strong></div></div>
        <div class="col-md-3"><div class="admin-stat-card"><span>Pubbliche</span><strong>{{ $stats['public_categories'] }}</strong></div></div>
        <div class="col-md-3"><div class="admin-stat-card"><span>Bozze</span><strong>{{ $stats['draft_categories'] }}</strong></div></div>
    </div>

    <div class="card admin-card mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end" method="GET" action="{{ route('admin.categories.index') }}">
                <div class="col-md-5">
                    <label class="form-label" for="category-search">Cerca</label>
                    <input class="form-control" id="category-search" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Nome categoria">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="category-type-filter">Macro-categoria</label>
                    <select class="form-select" id="category-type-filter" name="type_id">
                        <option value="">Tutte</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" @selected((string)($filters['type_id'] ?? '') === (string)$type->id)>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="category-status-filter">Stato</label>
                    <select class="form-select" id="category-status-filter" name="status">
                        <option value="">Tutti</option>
                        <option value="public" @selected(($filters['status'] ?? '') === 'public')>Pubblica</option>
                        <option value="draft" @selected(($filters['status'] ?? '') === 'draft')>Bozza</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary" type="submit">Filtra</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card admin-card mb-4">
        <div class="card-body">
            <div class="admin-section-head">
                <div>
                    <h2>Macro-categorie</h2>
                    <p>Contenitori principali, come Liguria, Piemonte o singoli progetti immobiliari.</p>
                </div>
            </div>
            <div class="row g-3">
                @forelse($types as $type)
                    <div class="col-lg-6">
                        <article class="admin-card-light">
                            <div class="d-flex justify-content-between gap-3">
                                <div>
                                    <h3>{{ $type->name }}</h3>
                                    <p>{{ $type->categories_count }} categorie, {{ $type->sale_properties_count }} immobili collegati</p>
                                </div>
                                <div class="admin-row-actions">
                                    <a class="btn btn-sm btn-outline-primary btn-icon" href="{{ route('admin.category-types.edit', $type) }}">
                                        <i data-lucide="pencil" class="admin-icon" aria-hidden="true"></i>Modifica
                                    </a>
                                    <form method="POST" action="{{ route('admin.category-types.destroy', $type) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger btn-icon" type="submit" onclick="return confirm('{{ __('admin.actions.confirm_delete') }}')">
                                            <i data-lucide="trash-2" class="admin-icon" aria-hidden="true"></i>Elimina
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12"><div class="admin-empty"><strong>Nessuna macro-categoria.</strong></div></div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card admin-card admin-table-card">
        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Macro</th>
                    <th>Stato</th>
                    <th>Immobili</th>
                    <th class="text-end">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>
                            <div class="admin-title-cell">
                                <strong>{{ $category->name }}</strong>
                                <small>{{ $category->slug }}</small>
                            </div>
                        </td>
                        <td>{{ $category->type?->name ?? '-' }}</td>
                        <td><span class="admin-status {{ $category->status === 'public' ? 'admin-status--on' : 'admin-status--off' }}">{{ $category->status === 'public' ? 'Pubblica' : 'Bozza' }}</span></td>
                        <td>{{ $category->sale_properties_count }}</td>
                        <td class="text-end">
                            <div class="admin-row-actions">
                                <a class="btn btn-sm btn-outline-primary btn-icon" href="{{ route('admin.categories.edit', $category) }}">
                                    <i data-lucide="pencil" class="admin-icon" aria-hidden="true"></i>{{ __('admin.actions.edit') }}
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger btn-icon" type="submit" onclick="return confirm('{{ __('admin.actions.confirm_delete') }}')">
                                        <i data-lucide="trash-2" class="admin-icon" aria-hidden="true"></i>{{ __('admin.actions.delete') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><div class="admin-empty"><strong>Nessuna categoria trovata.</strong></div></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $categories->links() }}</div>
@endsection
