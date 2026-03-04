<div class="col-md-6">
    <label class="form-label" for="sale-title">{{ __('admin.sales.fields.title') }}</label>
    <input class="form-control @error('title') is-invalid @enderror" id="sale-title" type="text" name="title" value="{{ old('title', $property?->title) }}">
    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6">
    <label class="form-label" for="sale-slug">{{ __('admin.sales.fields.slug') }}</label>
    <input class="form-control @error('slug') is-invalid @enderror" id="sale-slug" type="text" name="slug" value="{{ old('slug', $property?->slug) }}">
    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6">
    <label class="form-label" for="sale-location">{{ __('admin.sales.fields.location') }}</label>
    <input class="form-control @error('location') is-invalid @enderror" id="sale-location" type="text" name="location" value="{{ old('location', $property?->location) }}">
    @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6">
    <label class="form-label" for="sale-price">{{ __('admin.sales.fields.price') }}</label>
    <input class="form-control @error('price') is-invalid @enderror" id="sale-price" type="number" name="price" value="{{ old('price', $property?->price) }}">
    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12">
    <label class="form-label" for="sale-short">{{ __('admin.sales.fields.description_short') }}</label>
    <textarea class="form-control @error('description_short') is-invalid @enderror" id="sale-short" name="description_short" rows="3">{{ old('description_short', $property?->description_short) }}</textarea>
    @error('description_short')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12">
    <label class="form-label" for="sale-long">{{ __('admin.sales.fields.description_long') }}</label>
    <textarea class="form-control @error('description_long') is-invalid @enderror" id="sale-long" name="description_long" rows="12">{{ old('description_long', $property?->description_long) }}</textarea>
    @error('description_long')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-3">
    <label class="form-label" for="sale-order">{{ __('admin.sales.fields.order') }}</label>
    <input class="form-control @error('sort_order') is-invalid @enderror" id="sale-order" type="number" name="sort_order" value="{{ old('sort_order', $property?->sort_order ?? 0) }}">
    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12">
    <input type="hidden" name="active" value="0">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="sale-active" name="active" value="1" {{ old('active', $property?->active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="sale-active">{{ __('admin.sales.fields.active') }}</label>
    </div>
</div>
