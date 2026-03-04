<div class="col-md-6">
    <label class="form-label" for="structure-name">{{ __('admin.structures.fields.name') }}</label>
    <input class="form-control @error('name') is-invalid @enderror" id="structure-name" type="text" name="name" value="{{ old('name', $structure?->name) }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6">
    <label class="form-label" for="structure-slug">{{ __('admin.structures.fields.slug') }}</label>
    <input class="form-control @error('slug') is-invalid @enderror" id="structure-slug" type="text" name="slug" value="{{ old('slug', $structure?->slug) }}">
    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-4">
    <label class="form-label" for="structure-location">{{ __('admin.structures.fields.location') }}</label>
    <input class="form-control @error('location') is-invalid @enderror" id="structure-location" type="text" name="location" value="{{ old('location', $structure?->location) }}">
    @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-8">
    <label class="form-label" for="structure-address">{{ __('admin.structures.fields.address') }}</label>
    <input class="form-control @error('address') is-invalid @enderror" id="structure-address" type="text" name="address" value="{{ old('address', $structure?->address) }}">
    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6">
    <label class="form-label" for="structure-url">{{ __('admin.structures.fields.external_url') }}</label>
    <input class="form-control @error('external_url') is-invalid @enderror" id="structure-url" type="url" name="external_url" value="{{ old('external_url', $structure?->external_url) }}">
    @error('external_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6">
    <label class="form-label" for="structure-image">{{ __('admin.structures.fields.image') }}</label>
    <input class="form-control @error('image') is-invalid @enderror" id="structure-image" type="file" name="image" accept="image/*">
    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror

    @if($structure?->image_path)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $structure->image_path) }}" alt="{{ $structure->name }}" style="max-height: 120px;" class="rounded border">
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" id="remove-image" name="remove_image" value="1" {{ old('remove_image') ? 'checked' : '' }}>
            <label class="form-check-label" for="remove-image">{{ __('admin.structures.fields.remove_image') }}</label>
        </div>
    @endif
</div>

<div class="col-12">
    <label class="form-label" for="structure-short">{{ __('admin.structures.fields.description_short') }}</label>
    <textarea class="form-control @error('description_short') is-invalid @enderror" id="structure-short" name="description_short" rows="3">{{ old('description_short', $structure?->description_short) }}</textarea>
    @error('description_short')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12">
    <label class="form-label" for="structure-long">{{ __('admin.structures.fields.description_long') }}</label>
    <textarea class="form-control @error('description_long') is-invalid @enderror" id="structure-long" name="description_long" rows="8">{{ old('description_long', $structure?->description_long) }}</textarea>
    @error('description_long')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-3">
    <label class="form-label" for="structure-order">{{ __('admin.structures.fields.order') }}</label>
    <input class="form-control @error('sort_order') is-invalid @enderror" id="structure-order" type="number" name="sort_order" value="{{ old('sort_order', $structure?->sort_order ?? 0) }}">
    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12">
    <input type="hidden" name="active" value="0">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="structure-active" name="active" value="1" {{ old('active', $structure?->active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="structure-active">{{ __('admin.structures.fields.active') }}</label>
    </div>
</div>
