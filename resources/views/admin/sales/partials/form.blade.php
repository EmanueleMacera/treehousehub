@php
    $status = old('status', $property?->status ?? ($property?->active ?? true ? 'publish' : 'draft'));
    $existingImages = $property?->media ?? collect();
    $existingPdfs = $property?->documentFiles() ?? [];
    $existingVideos = $property?->videoFiles() ?? [];
@endphp

@once
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        <style>
            .quill-box { min-height:340px; background:#fff; }
            .ql-toolbar.ql-snow { border-radius:10px 10px 0 0; border-color:#cbd5e1; }
            .ql-container.ql-snow { border-radius:0 0 10px 10px; border-color:#cbd5e1; font-size:1rem; }
            .sale-form-section { border:1px solid #e2e8f0; border-radius:14px; padding:1rem; background:#fff; }
            .sale-form-section h2 { font-size:1rem; margin:0 0 .75rem; font-weight:800; }
            .media-preview-grid { display:flex; flex-wrap:wrap; gap:.5rem; }
            .media-preview-grid img { width:86px; height:86px; border-radius:10px; object-fit:cover; border:1px solid #e2e8f0; }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[data-quill-editor]').forEach(function (editor) {
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

                const previewImages = function (inputId, previewId) {
                    const input = document.getElementById(inputId);
                    const preview = document.getElementById(previewId);
                    if (!input || !preview) return;

                    input.addEventListener('change', function () {
                        preview.innerHTML = '';
                        Array.from(input.files || []).forEach(function (file) {
                            const image = document.createElement('img');
                            const reader = new FileReader();
                            reader.onload = function (event) {
                                image.src = event.target.result;
                            };
                            reader.readAsDataURL(file);
                            preview.appendChild(image);
                        });
                    });
                };

                previewImages('sale-thumbnail', 'sale-thumbnail-preview');
                previewImages('sale-photos', 'sale-photos-preview');
            });
        </script>
    @endpush
@endonce

<div class="col-12">
    <div class="admin-form-intro">
        <h2>Compilazione completa vendita</h2>
        <p>Il form segue la struttura del vecchio gestionale: base, dettagli tecnici, servizi, descrizione e media.</p>
    </div>
</div>

<div class="col-12">
    <div class="sale-form-section">
        <h2>1. Informazioni principali</h2>
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label" for="sale-status">Stato</label>
                <select class="form-select @error('status') is-invalid @enderror" id="sale-status" name="status">
                    <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Bozza</option>
                    <option value="publish" {{ $status === 'publish' ? 'selected' : '' }}>Pubblico</option>
                    <option value="sold" {{ $status === 'sold' ? 'selected' : '' }}>Venduto</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label" for="sale-type">{{ __('admin.sales.fields.property_type') }}</label>
                <select class="form-select @error('property_type') is-invalid @enderror" id="sale-type" name="property_type">
                    <option value="">Seleziona</option>
                    @foreach(['appartamento', 'villa', 'villetta', 'casa_indipendente', 'attico', 'loft', 'rustico', 'terreno'] as $type)
                        <option value="{{ $type }}" {{ old('property_type', $property?->property_type) === $type ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($type)) }}</option>
                    @endforeach
                </select>
                @error('property_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label" for="sale-title">{{ __('admin.sales.fields.title') }}</label>
                <input class="form-control @error('title') is-invalid @enderror" id="sale-title" type="text" name="title" value="{{ old('title', $property?->title) }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label" for="sale-price">{{ __('admin.sales.fields.price') }}</label>
                <div class="input-group">
                    <span class="input-group-text">EUR</span>
                    <input class="form-control @error('price') is-invalid @enderror" id="sale-price" type="number" name="price" min="0" step="0.01" value="{{ old('price', $property?->price) }}">
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="col-md-2">
                <label class="form-label" for="sale-negotiable">Trattabile</label>
                <select class="form-select" id="sale-negotiable" name="negotiable">
                    <option value="0" {{ !old('negotiable', $property?->negotiable ?? false) ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('negotiable', $property?->negotiable ?? false) ? 'selected' : '' }}>Si</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label" for="sale-category">Categoria</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="sale-category" name="category_id">
                    <option value="">Senza categoria</option>
                    @foreach(($categories ?? collect()) as $typeName => $groupCategories)
                        <optgroup label="{{ $typeName }}">
                            @foreach($groupCategories as $category)
                                <option value="{{ $category->id }}" @selected((string) old('category_id', $property?->category_id) === (string) $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label" for="sale-slug">{{ __('admin.sales.fields.slug') }}</label>
                <input class="form-control @error('slug') is-invalid @enderror" id="sale-slug" type="text" name="slug" value="{{ old('slug', $property?->slug) }}" placeholder="automatico se vuoto">
                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="sale-form-section">
        <h2>2. Posizione</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label" for="sale-location">{{ __('admin.sales.fields.location') }}</label>
                <input class="form-control @error('location') is-invalid @enderror" id="sale-location" type="text" name="location" value="{{ old('location', $property?->location) }}">
                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-8">
                <label class="form-label" for="sale-address">{{ __('admin.sales.fields.address') }}</label>
                <input class="form-control @error('address') is-invalid @enderror" id="sale-address" type="text" name="address" value="{{ old('address', $property?->address) }}">
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sale-orientation">Orientamento</label>
                <select class="form-select" id="sale-orientation" name="orientation">
                    <option value="">Seleziona</option>
                    @foreach(['nord','nord-est','est','sud-est','sud','sud-ovest','ovest','nord-ovest'] as $orientation)
                        <option value="{{ $orientation }}" {{ old('orientation', $property?->orientation) === $orientation ? 'selected' : '' }}>{{ ucfirst($orientation) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sale-latitude">Latitudine</label>
                <input class="form-control @error('latitude') is-invalid @enderror" id="sale-latitude" type="text" name="latitude" value="{{ old('latitude', $property?->latitude) }}">
                @error('latitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sale-longitude">Longitudine</label>
                <input class="form-control @error('longitude') is-invalid @enderror" id="sale-longitude" type="text" name="longitude" value="{{ old('longitude', $property?->longitude) }}">
                @error('longitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="sale-form-section">
        <h2>3. Dettagli tecnici</h2>
        <div class="row g-3">
            <div class="col-md-2"><label class="form-label" for="sale-rooms">{{ __('admin.sales.fields.rooms') }}</label><input class="form-control" id="sale-rooms" type="number" min="0" name="rooms" value="{{ old('rooms', $property?->rooms) }}"></div>
            <div class="col-md-2"><label class="form-label" for="sale-bathrooms">{{ __('admin.sales.fields.bathrooms') }}</label><input class="form-control" id="sale-bathrooms" type="number" min="0" name="bathrooms" value="{{ old('bathrooms', $property?->bathrooms) }}"></div>
            <div class="col-md-2"><label class="form-label" for="sale-balcony">Balconi</label><input class="form-control" id="sale-balcony" type="number" min="0" name="balcony" value="{{ old('balcony', $property?->balcony) }}"></div>
            <div class="col-md-2"><label class="form-label" for="sale-floor">Piano</label><input class="form-control" id="sale-floor" type="text" name="floor" value="{{ old('floor', $property?->floor) }}"></div>
            <div class="col-md-2"><label class="form-label" for="sale-year">Anno</label><input class="form-control" id="sale-year" type="number" name="construction_year" value="{{ old('construction_year', $property?->construction_year) }}"></div>
            <div class="col-md-2"><label class="form-label" for="sale-order">{{ __('admin.sales.fields.order') }}</label><input class="form-control" id="sale-order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $property?->sort_order ?? 0) }}"></div>

            <div class="col-md-3"><label class="form-label" for="sale-surface">{{ __('admin.sales.fields.surface') }}</label><input class="form-control" id="sale-surface" type="number" min="0" step="0.01" name="surface_commercial" value="{{ old('surface_commercial', $property?->surface_commercial) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-residential">Mq residenziali</label><input class="form-control" id="sale-residential" type="number" min="0" step="0.01" name="surface_residential" value="{{ old('surface_residential', $property?->surface_residential) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-balcony-surface">Mq balconi/terrazzi</label><input class="form-control" id="sale-balcony-surface" type="number" min="0" step="0.01" name="surface_balcony" value="{{ old('surface_balcony', $property?->surface_balcony) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-garden">Mq giardino</label><input class="form-control" id="sale-garden" type="number" min="0" step="0.01" name="garden_surface" value="{{ old('garden_surface', $property?->garden_surface) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-common">Mq parti comuni</label><input class="form-control" id="sale-common" type="number" min="0" step="0.01" name="surface_common_parts" value="{{ old('surface_common_parts', $property?->surface_common_parts) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-thousandths">Millesimi</label><input class="form-control" id="sale-thousandths" type="number" min="0" step="0.01" name="thousandths" value="{{ old('thousandths', $property?->thousandths) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-energy">{{ __('admin.sales.fields.energy_class') }}</label><input class="form-control" id="sale-energy" type="text" name="energy_class" value="{{ old('energy_class', $property?->energy_class) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-condition">{{ __('admin.sales.fields.condition') }}</label><input class="form-control" id="sale-condition" type="text" name="condition" value="{{ old('condition', $property?->condition) }}"></div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="sale-form-section">
        <h2>4. Servizi e costi</h2>
        <div class="row g-3">
            @foreach(['has_parking' => 'Parcheggio', 'has_garage' => 'Garage', 'has_pool' => 'Piscina', 'has_spa' => 'SPA', 'has_park' => 'Parco'] as $field => $label)
                <div class="col-md-2">
                    <input type="hidden" name="{{ $field }}" value="0">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="sale-{{ $field }}" name="{{ $field }}" value="1" {{ old($field, $property?->{$field} ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="sale-{{ $field }}">{{ $label }}</label>
                    </div>
                </div>
            @endforeach
            <div class="col-md-2"><label class="form-label" for="sale-parking-spaces">Posti auto</label><input class="form-control" id="sale-parking-spaces" type="number" min="0" name="parking_spaces" value="{{ old('parking_spaces', $property?->parking_spaces) }}"></div>
            <div class="col-md-4"><label class="form-label" for="sale-amenities">Altri servizi</label><input class="form-control" id="sale-amenities" type="text" name="other_amenities" value="{{ old('other_amenities', $property?->other_amenities) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-annual">Spese annue</label><input class="form-control" id="sale-annual" type="number" min="0" step="0.01" name="annual_fee" value="{{ old('annual_fee', $property?->annual_fee) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-monthly">Spese mensili</label><input class="form-control" id="sale-monthly" type="number" min="0" step="0.01" name="monthly_expenses" value="{{ old('monthly_expenses', $property?->monthly_expenses) }}"></div>
            <div class="col-md-3"><label class="form-label" for="sale-imu">IMU</label><input class="form-control" id="sale-imu" type="number" min="0" step="0.01" name="imu_tax" value="{{ old('imu_tax', $property?->imu_tax) }}"></div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="sale-form-section">
        <h2>5. Descrizioni</h2>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label" for="sale-short">{{ __('admin.sales.fields.description_short') }}</label>
                <textarea class="form-control @error('description_short') is-invalid @enderror" id="sale-short" name="description_short" rows="3" maxlength="500">{{ old('description_short', $property?->description_short) }}</textarea>
                @error('description_short')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label" for="sale-long">{{ __('admin.sales.fields.description_long') }}</label>
                <input id="sale-long" type="hidden" name="description_long" value="{{ old('description_long', $property?->description_long) }}">
                <div class="quill-box @error('description_long') border border-danger @enderror" data-quill-editor data-target="sale-long"></div>
                @error('description_long')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6"><label class="form-label" for="sale-nearby">Nelle vicinanze</label><textarea class="form-control" id="sale-nearby" name="nearby" rows="3">{{ old('nearby', $property?->nearby) }}</textarea></div>
            <div class="col-md-6"><label class="form-label" for="sale-external">Link esterno</label><input class="form-control" id="sale-external" type="url" name="external_link" value="{{ old('external_link', $property?->external_link) }}"></div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="sale-form-section">
        <h2>6. Media e contatti</h2>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="sale-thumbnail">Copertina</label>
                <input class="form-control @error('thumbnail') is-invalid @enderror" id="sale-thumbnail" type="file" name="thumbnail" accept="image/*">
                <div id="sale-thumbnail-preview" class="media-preview-grid mt-2"></div>
                @if($existingImages->firstWhere('type', 'thumbnail'))
                    <div class="form-text">Copertina gia presente. Caricane una nuova solo se vuoi sostituirla.</div>
                @endif
                @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="sale-photos">Foto aggiuntive</label>
                <input class="form-control @error('photos.*') is-invalid @enderror" id="sale-photos" type="file" name="photos[]" accept="image/*" multiple>
                <div id="sale-photos-preview" class="media-preview-grid mt-2"></div>
                @if($existingImages->count())
                    <div class="media-preview-grid mt-2">
                        @foreach($existingImages->take(8) as $image)
                            @if($image->url())
                                <img src="{{ $image->url() }}" alt="{{ $property?->title }}">
                            @endif
                        @endforeach
                    </div>
                    <div class="form-text">{{ $existingImages->count() }} immagini gia presenti.</div>
                @endif
                @error('photos.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="sale-pdf">PDF</label>
                <input class="form-control @error('pdf_files_upload.*') is-invalid @enderror" id="sale-pdf" type="file" name="pdf_files_upload[]" accept="application/pdf" multiple>
                @if(count($existingPdfs))
                    <div class="form-text">{{ count($existingPdfs) }} PDF gia presenti.</div>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label" for="sale-videos">Video</label>
                <input class="form-control @error('videos_upload.*') is-invalid @enderror" id="sale-videos" type="file" name="videos_upload[]" accept="video/*" multiple>
                @if(count($existingVideos))
                    <div class="form-text">{{ count($existingVideos) }} video gia presenti.</div>
                @endif
            </div>
            <div class="col-md-6"><label class="form-label" for="sale-contact-name">Referente</label><input class="form-control" id="sale-contact-name" type="text" name="contact_name" value="{{ old('contact_name', $property?->contact_name) }}"></div>
            <div class="col-md-6"><label class="form-label" for="sale-contact-phone">Telefono referente</label><input class="form-control" id="sale-contact-phone" type="text" name="contact_phone" value="{{ old('contact_phone', $property?->contact_phone) }}"></div>
        </div>
    </div>
</div>
