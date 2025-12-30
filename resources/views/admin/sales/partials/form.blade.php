<div>
    <label>
        {{ __('admin.sales.fields.title') }}
        <input type="text" name="title" value="{{ old('title', $property?->title) }}">
    </label>
    @error('title')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.sales.fields.slug') }}
        <input type="text" name="slug" value="{{ old('slug', $property?->slug) }}">
    </label>
    @error('slug')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.sales.fields.location') }}
        <input type="text" name="location" value="{{ old('location', $property?->location) }}">
    </label>
    @error('location')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.sales.fields.price') }}
        <input type="number" name="price" value="{{ old('price', $property?->price) }}">
    </label>
    @error('price')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.sales.fields.description_short') }}
        <textarea name="description_short" rows="3">{{ old('description_short', $property?->description_short) }}</textarea>
    </label>
    @error('description_short')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.sales.fields.description_long') }}
        <textarea name="description_long" rows="12">{{ old('description_long', $property?->description_long) }}</textarea>
    </label>
    @error('description_long')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.sales.fields.order') }}
        <input type="number" name="sort_order" value="{{ old('sort_order', $property?->sort_order ?? 0) }}">
    </label>
    @error('sort_order')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        <input type="checkbox" name="active" value="1" {{ old('active', $property?->active ?? true) ? 'checked' : '' }}>
        {{ __('admin.sales.fields.active') }}
    </label>
</div>
