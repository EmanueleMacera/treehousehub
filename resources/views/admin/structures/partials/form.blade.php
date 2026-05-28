@php
    $locales = [
        'it' => ['label' => 'Italiano', 'hint' => 'Testo principale mostrato sul sito italiano.'],
        'en' => ['label' => 'English', 'hint' => 'Traduzione manuale mostrata sul sito inglese.'],
    ];

    $fieldValue = function (string $field, string $locale) use ($structure) {
        return old($field . '_translations.' . $locale, data_get($structure?->{$field . '_translations'}, $locale, $locale === 'it' ? $structure?->{$field} : null));
    };
@endphp

@once
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        <style>
            .dummy-panel { background:#f8fafc; border:1px solid #e2e8f0; border-radius:14px; padding:1rem; }
            .translation-tabs .nav-link { border-radius:999px; font-weight:700; }
            .translation-pane { border:1px solid #e2e8f0; border-radius:14px; padding:1rem; background:#fff; }
            .translation-pane .form-text { color:#64748b; }
            .quill-box { min-height:260px; background:#fff; }
            .ql-toolbar.ql-snow { border-radius:10px 10px 0 0; border-color:#cbd5e1; }
            .ql-container.ql-snow { border-radius:0 0 10px 10px; border-color:#cbd5e1; font-size:1rem; }
            .admin-help-list { margin:0; padding-left:1.1rem; color:#475569; }
            .admin-help-list li { margin:.25rem 0; }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const editors = document.querySelectorAll('[data-quill-editor]');

                editors.forEach(function (editor) {
                    const target = document.getElementById(editor.dataset.target);
                    const quill = new Quill(editor, {
                        theme: 'snow',
                        modules: {
                            toolbar: [
                                [{ header: [2, 3, false] }],
                                ['bold', 'italic', 'underline'],
                                [{ list: 'ordered' }, { list: 'bullet' }],
                                ['link', 'blockquote'],
                                ['clean']
                            ]
                        }
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

                const primaryName = document.getElementById('structure-name-primary');
                const italianName = document.getElementById('structure-name-it');

                if (primaryName && italianName) {
                    const syncName = function () {
                        primaryName.value = italianName.value;
                    };
                    italianName.addEventListener('input', syncName);
                    syncName();
                }
            });
        </script>
    @endpush
@endonce

<input id="structure-name-primary" type="hidden" name="name" value="{{ old('name', $structure?->name) }}">

<div class="col-12">
    <div class="dummy-panel">
        <div class="row g-3 align-items-center">
            <div class="col-lg-7">
                <h2 class="h5 mb-2">Carica un affitto in 3 passaggi</h2>
                <ol class="admin-help-list">
                    <li>Compila prima la scheda Italiano: e' la versione principale.</li>
                    <li>Apri English e inserisci a mano le traduzioni.</li>
                    <li>Salva: se una traduzione manca, il sito usa il testo italiano.</li>
                </ol>
            </div>
            <div class="col-lg-5">
                <div class="row g-2">
                    <div class="col-md-7">
                        <label class="form-label" for="structure-slug">{{ __('admin.structures.fields.slug') }}</label>
                        <input class="form-control @error('slug') is-invalid @enderror" id="structure-slug" type="text" name="slug" value="{{ old('slug', $structure?->slug) }}" placeholder="automatico se vuoto">
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" for="structure-order">{{ __('admin.structures.fields.order') }}</label>
                        <input class="form-control @error('sort_order') is-invalid @enderror" id="structure-order" type="number" name="sort_order" value="{{ old('sort_order', $structure?->sort_order ?? 0) }}" min="0">
                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <ul class="nav nav-pills translation-tabs gap-2" id="structure-language-tabs" role="tablist">
        @foreach($locales as $locale => $meta)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $locale }}" data-bs-toggle="pill" data-bs-target="#pane-{{ $locale }}" type="button" role="tab" aria-controls="pane-{{ $locale }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $meta['label'] }}
                </button>
            </li>
        @endforeach
    </ul>
</div>

<div class="col-12">
    <div class="tab-content">
        @foreach($locales as $locale => $meta)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $locale }}" role="tabpanel" aria-labelledby="tab-{{ $locale }}" tabindex="0">
                <div class="translation-pane">
                    <p class="form-text mb-3">{{ $meta['hint'] }}</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="structure-name-{{ $locale }}">{{ __('admin.structures.fields.name') }} {{ strtoupper($locale) }}</label>
                            <input class="form-control @error('name_translations.' . $locale) is-invalid @enderror" id="structure-name-{{ $locale }}" type="text" name="name_translations[{{ $locale }}]" value="{{ $fieldValue('name', $locale) }}" {{ $locale === 'it' ? 'required' : '' }}>
                            @error('name_translations.' . $locale)<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="structure-location-{{ $locale }}">{{ __('admin.structures.fields.location') }} {{ strtoupper($locale) }}</label>
                            <input class="form-control @error('location_translations.' . $locale) is-invalid @enderror" id="structure-location-{{ $locale }}" type="text" name="location_translations[{{ $locale }}]" value="{{ $fieldValue('location', $locale) }}">
                            @error('location_translations.' . $locale)<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="structure-address-{{ $locale }}">{{ __('admin.structures.fields.address') }} {{ strtoupper($locale) }}</label>
                            <input class="form-control @error('address_translations.' . $locale) is-invalid @enderror" id="structure-address-{{ $locale }}" type="text" name="address_translations[{{ $locale }}]" value="{{ $fieldValue('address', $locale) }}">
                            @error('address_translations.' . $locale)<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="structure-short-{{ $locale }}">{{ __('admin.structures.fields.description_short') }} {{ strtoupper($locale) }}</label>
                            <textarea class="form-control @error('description_short_translations.' . $locale) is-invalid @enderror" id="structure-short-{{ $locale }}" name="description_short_translations[{{ $locale }}]" rows="3" maxlength="500">{{ $fieldValue('description_short', $locale) }}</textarea>
                            <div class="form-text">Testo breve per schede e anteprime, massimo 500 caratteri.</div>
                            @error('description_short_translations.' . $locale)<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="structure-long-{{ $locale }}">{{ __('admin.structures.fields.description_long') }} {{ strtoupper($locale) }}</label>
                            <input id="structure-long-{{ $locale }}" type="hidden" name="description_long_translations[{{ $locale }}]" value="{{ $fieldValue('description_long', $locale) }}">
                            <div class="quill-box @error('description_long_translations.' . $locale) border border-danger @enderror" data-quill-editor data-target="structure-long-{{ $locale }}"></div>
                            <div class="form-text">Usa titoli, grassetto ed elenchi per rendere la pagina leggibile.</div>
                            @error('description_long_translations.' . $locale)<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="col-md-6">
    <label class="form-label" for="structure-url">{{ __('admin.structures.fields.external_url') }}</label>
    <input class="form-control @error('external_url') is-invalid @enderror" id="structure-url" type="url" name="external_url" value="{{ old('external_url', $structure?->external_url) }}" placeholder="https://...">
    @error('external_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6">
    <label class="form-label" for="structure-image">{{ __('admin.structures.fields.image') }}</label>
    <input class="form-control @error('image') is-invalid @enderror" id="structure-image" type="file" name="image" accept="image/*">
    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror

    @if($structure?->image_path)
        <div class="mt-2 d-flex gap-3 align-items-center">
            <img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->name }}" style="height:72px;width:96px;object-fit:cover;" class="rounded border">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remove-image" name="remove_image" value="1" {{ old('remove_image') ? 'checked' : '' }}>
                <label class="form-check-label" for="remove-image">{{ __('admin.structures.fields.remove_image') }}</label>
            </div>
        </div>
    @endif
</div>

<div class="col-12">
    <input type="hidden" name="active" value="0">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="structure-active" name="active" value="1" {{ old('active', $structure?->active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="structure-active">{{ __('admin.structures.fields.active') }}</label>
    </div>
</div>
