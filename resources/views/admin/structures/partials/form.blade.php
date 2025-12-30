<div>
    <label>
        {{ __('admin.structures.fields.name') }}
        <input type="text" name="name" value="{{ old('name', $structure?->name) }}">
    </label>
    @error('name')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.structures.fields.slug') }}
        <input type="text" name="slug" value="{{ old('slug', $structure?->slug) }}">
    </label>
    @error('slug')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.structures.fields.location') }}
        <input type="text" name="location" value="{{ old('location', $structure?->location) }}">
    </label>
    @error('location')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.structures.fields.external_url') }}
        <input type="url" name="external_url" value="{{ old('external_url', $structure?->external_url) }}">
    </label>
    @error('external_url')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.structures.fields.description_short') }}
        <textarea name="description_short" rows="3">{{ old('description_short', $structure?->description_short) }}</textarea>
    </label>
    @error('description_short')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.structures.fields.description_long') }}
        <textarea name="description_long" rows="12">{{ old('description_long', $structure?->description_long) }}</textarea>
    </label>
    @error('description_long')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        {{ __('admin.structures.fields.order') }}
        <input type="number" name="sort_order" value="{{ old('sort_order', $structure?->sort_order ?? 0) }}">
    </label>
    @error('sort_order')<div>{{ $message }}</div>@enderror
</div>

<div>
    <label>
        <input type="checkbox" name="active" value="1" {{ old('active', $structure?->active ?? true) ? 'checked' : '' }}>
        {{ __('admin.structures.fields.active') }}
    </label>
</div>
