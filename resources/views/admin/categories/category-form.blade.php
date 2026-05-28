@extends('layouts.admin')

@section('title', $category ? 'Modifica categoria' : 'Nuova categoria')
@section('page_title', $category ? 'Modifica categoria' : 'Nuova categoria')
@section('page_subtitle', 'La categoria collega gli immobili alla macro-categoria corretta.')

@section('page_actions')
    <a class="btn btn-light border btn-icon" href="{{ route('admin.categories.index') }}">
        <i data-lucide="arrow-left" class="admin-icon" aria-hidden="true"></i>
        {{ __('admin.actions.back') }}
    </a>
@endsection

@section('content')
    <div class="card admin-card admin-form-card">
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ $category ? route('admin.categories.update', $category) : route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                @if($category) @method('PUT') @endif

                <div class="col-md-6">
                    <label class="form-label" for="category-name">Nome</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="category-name" name="name" value="{{ old('name', $category?->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="category-slug">Slug</label>
                    <input class="form-control @error('slug') is-invalid @enderror" id="category-slug" name="slug" value="{{ old('slug', $category?->slug) }}" placeholder="automatico se vuoto">
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="category-type">Macro-categoria</label>
                    <select class="form-select @error('type_id') is-invalid @enderror" id="category-type" name="type_id">
                        <option value="">Senza macro</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" @selected((string) old('type_id', $category?->type_id) === (string) $type->id)>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="category-status">Stato</label>
                    <select class="form-select" id="category-status" name="status">
                        <option value="public" @selected(old('status', $category?->status ?? 'public') === 'public')>Pubblica</option>
                        <option value="draft" @selected(old('status', $category?->status ?? 'public') === 'draft')>Bozza</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="category-thumbnail">Thumbnail</label>
                    <input class="form-control" id="category-thumbnail" type="file" name="thumbnail" accept="image/*">
                    @if($category?->thumbnailUrl())<div class="form-text">Thumbnail gia presente.</div>@endif
                </div>

                <div class="admin-sticky-actions d-flex gap-2 justify-content-end">
                    <a class="btn btn-light border" href="{{ route('admin.categories.index') }}">{{ __('admin.actions.cancel') }}</a>
                    <button class="btn btn-primary btn-icon" type="submit">
                        <i data-lucide="save" class="admin-icon" aria-hidden="true"></i>
                        {{ __('admin.actions.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
