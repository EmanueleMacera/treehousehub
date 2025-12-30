@extends('layouts.admin')

@section('title', __('admin.pages.edit_title', ['title' => $page->title]))

@section('content')
    <h1>{{ __('admin.pages.edit_title', ['title' => $page->title]) }}</h1>

    <form method="POST" action="{{ route('admin.pages.update', ['key' => $page->key]) }}">
        @csrf

        <div>
            <label>
                {{ __('admin.pages.fields.title') }}
                <input type="text" name="title" value="{{ old('title', $page->title) }}">
            </label>
            @error('title')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label>
                {{ __('admin.pages.fields.content') }}
                <textarea name="content" rows="18">{{ old('content', $page->content) }}</textarea>
            </label>
            @error('content')<div>{{ $message }}</div>@enderror
        </div>

        <button type="submit">{{ __('admin.pages.actions.save') }}</button>
    </form>
@endsection
