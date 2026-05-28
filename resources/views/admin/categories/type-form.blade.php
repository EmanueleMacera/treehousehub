@extends('layouts.admin')

@php
    $translations = fn ($field, $locale) => old($field . '.' . $locale, $type?->{$field}[$locale] ?? '');
    $photos = $type?->media?->where('type', 'photo') ?? collect();
@endphp

@section('title', $type ? 'Modifica macro-categoria' : 'Nuova macro-categoria')
@section('page_title', $type ? 'Modifica macro-categoria' : 'Nuova macro-categoria')
@section('page_subtitle', 'Contenitore principale per separare aree, regioni e progetti immobiliari.')

@section('page_actions')
    <a class="btn btn-light border btn-icon" href="{{ route('admin.categories.index') }}">
        <i data-lucide="arrow-left" class="admin-icon" aria-hidden="true"></i>
        {{ __('admin.actions.back') }}
    </a>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <style>
        .category-tabs { gap:.5rem; border-bottom:0; overflow-x:auto; flex-wrap:nowrap; }
        .category-tabs .nav-link { border:1px solid #dbe7f3; border-radius:10px; color:#334155; min-width:150px; }
        .category-tabs .nav-link.active { background:#0f4c81; color:#fff; border-color:#0f4c81; }
        .category-panel { border:1px solid #dbe7f3; border-radius:14px; padding:1rem; background:#fff; }
        .quill-box { min-height:160px; background:#fff; }
        .ql-toolbar.ql-snow { border-radius:10px 10px 0 0; border-color:#cbd5e1; }
        .ql-container.ql-snow { border-radius:0 0 10px 10px; border-color:#cbd5e1; }
        .category-media-grid { display:flex; flex-wrap:wrap; gap:.6rem; }
        .category-media-card { position:relative; width:110px; }
        .category-media-card img { width:110px; height:88px; object-fit:cover; border-radius:10px; border:1px solid #dbe7f3; }
        .category-media-card form { position:absolute; top:4px; right:4px; }
    </style>
@endpush

@section('content')
    <form method="POST" action="{{ $type ? route('admin.category-types.update', $type) : route('admin.category-types.store') }}" enctype="multipart/form-data">
        @csrf
        @if($type) @method('PUT') @endif

        <div class="card admin-card admin-form-card mb-4">
            <div class="card-body">
                <div class="admin-form-intro">
                    <h2>{{ $type ? 'Aggiorna macro-categoria' : 'Crea macro-categoria' }}</h2>
                    <p>Compila solo quello che serve. Base e media sono i campi fondamentali; progetto, tempi e organigramma sono opzionali.</p>
                </div>

                <ul class="nav nav-tabs category-tabs mb-3" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#base" type="button">Base</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#media" type="button">Media</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#project" type="button">Progetto</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#timing" type="button">Tempi</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#people" type="button">Organigramma</button></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active category-panel" id="base">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="type-name">Nome</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="type-name" name="name" value="{{ old('name', $type?->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="type-slug">Slug</label>
                                <input class="form-control @error('slug') is-invalid @enderror" id="type-slug" name="slug" value="{{ old('slug', $type?->slug) }}" placeholder="automatico se vuoto">
                                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            @foreach(['it' => 'Italiano', 'en' => 'English'] as $locale => $label)
                                <div class="col-md-6">
                                    <label class="form-label">Macrodescrizione {{ $label }}</label>
                                    <input id="macrodescription-{{ $locale }}" type="hidden" name="macrodescription[{{ $locale }}]" value="{{ $translations('macrodescription', $locale) }}">
                                    <div class="quill-box" data-quill-editor data-target="macrodescription-{{ $locale }}"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Microdescrizione {{ $label }}</label>
                                    <input id="microdescription-{{ $locale }}" type="hidden" name="microdescription[{{ $locale }}]" value="{{ $translations('microdescription', $locale) }}">
                                    <div class="quill-box" data-quill-editor data-target="microdescription-{{ $locale }}"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane fade category-panel" id="media">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="type-thumbnail">Thumbnail</label>
                                <input class="form-control" id="type-thumbnail" type="file" name="thumbnail" accept="image/*">
                                @if($type?->thumbnail)<div class="form-text">Thumbnail gia presente.</div>@endif
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="type-photos">Foto galleria</label>
                                <input class="form-control" id="type-photos" type="file" name="photos[]" accept="image/*" multiple>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="type-pdf">PDF</label>
                                <input class="form-control" id="type-pdf" type="file" name="pdf" accept="application/pdf">
                                @if($type?->pdf)<div class="form-text">PDF gia presente.</div>@endif
                            </div>
                            @if($photos->count())
                                <div class="col-12">
                                    <label class="form-label">Foto presenti</label>
                                    <div class="category-media-grid">
                                        @foreach($photos as $photo)
                                            <div class="category-media-card">
                                                <img src="{{ $photo->url() }}" alt="{{ $type->name }}">
                                                <form method="POST" action="{{ route('admin.category-type-media.destroy', $photo) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('{{ __('admin.actions.confirm_delete') }}')">x</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade category-panel" id="project">
                        <div class="row g-3">
                            @foreach(['iniziativa_immobiliare' => 'Iniziativa immobiliare', 'stato_iniziativa' => 'Stato iniziativa', 'progetto' => 'Progetto', 'area_intervento' => 'Area intervento'] as $field => $label)
                                <div class="col-md-6">
                                    <label class="form-label">{{ $label }}</label>
                                    <textarea class="form-control" name="{{ $field }}" rows="3">{{ old($field, $type?->{$field}) }}</textarea>
                                </div>
                            @endforeach
                            <div class="col-md-3"><label class="form-label">Superficie edifici</label><input class="form-control" type="number" min="0" step="0.01" name="superficie_edifici" value="{{ old('superficie_edifici', $type?->superficie_edifici) }}"></div>
                            <div class="col-md-3"><label class="form-label">Volume edifici</label><input class="form-control" type="number" min="0" step="0.01" name="volume_edifici" value="{{ old('volume_edifici', $type?->volume_edifici) }}"></div>
                            <div class="col-md-3"><label class="form-label">Unita immobiliari</label><input class="form-control" type="number" min="0" name="unita_immobiliari" value="{{ old('unita_immobiliari', $type?->unita_immobiliari) }}"></div>
                            <div class="col-md-3"><label class="form-label">Box e posti auto</label><input class="form-control" type="number" min="0" name="box_posti_auto" value="{{ old('box_posti_auto', $type?->box_posti_auto) }}"></div>
                        </div>
                    </div>

                    <div class="tab-pane fade category-panel" id="timing">
                        <div class="row g-3">
                            @foreach(['tempi_concessioni' => 'Tempi concessioni edilizie', 'tempi_acquisizione' => 'Tempi acquisizione', 'tempi_realizzazione' => 'Tempi realizzazione'] as $field => $label)
                                <div class="col-md-4">
                                    <label class="form-label">{{ $label }}</label>
                                    <textarea class="form-control" name="{{ $field }}" rows="4">{{ old($field, $type?->{$field}) }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane fade category-panel" id="people">
                        <div class="row g-3">
                            @foreach(['promotori' => 'Promotori', 'compagine_sociale' => 'Compagine sociale', 'amministratore_unico' => 'Amministratore unico', 'consiglieri_soci' => 'Consiglieri e soci', 'collaboratori' => 'Collaboratori', 'gestione_generale_iniziativa' => 'Gestione generale iniziativa', 'consulente_vendite' => 'Consulente vendite'] as $field => $label)
                                <div class="col-md-6">
                                    <label class="form-label">{{ $label }}</label>
                                    <textarea class="form-control" name="{{ $field }}" rows="3">{{ old($field, $type?->{$field}) }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="admin-sticky-actions d-flex gap-2 justify-content-end mt-4">
                    <a class="btn btn-light border" href="{{ route('admin.categories.index') }}">{{ __('admin.actions.cancel') }}</a>
                    <button class="btn btn-primary btn-icon" type="submit">
                        <i data-lucide="save" class="admin-icon" aria-hidden="true"></i>
                        {{ __('admin.actions.save') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-quill-editor]').forEach(function (editor) {
                const target = document.getElementById(editor.dataset.target);
                const quill = new Quill(editor, {
                    theme: 'snow',
                    modules: { toolbar: [['bold', 'italic', 'underline'], [{ list: 'ordered' }, { list: 'bullet' }], ['link'], ['clean']] }
                });

                if (target.value) {
                    quill.root.innerHTML = target.value;
                }

                quill.on('text-change', function () {
                    target.value = quill.root.innerHTML;
                });

                editor.closest('form').addEventListener('submit', function () {
                    target.value = quill.root.innerHTML;
                });
            });
        });
    </script>
@endpush
