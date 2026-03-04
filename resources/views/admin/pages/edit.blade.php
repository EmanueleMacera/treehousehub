@extends('layouts.admin')

@section('title', __('admin.pages.edit_title', ['title' => $page->title]))

@section('content')
    <h1 class="h3 mb-4">{{ __('admin.pages.edit_title', ['title' => $page->title]) }}</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.update', ['key' => $page->key]) }}" class="row g-3">
                @csrf

                <div class="col-12">
                    <label class="form-label" for="page-title">{{ __('admin.pages.fields.title') }}</label>
                    <input class="form-control @error('title') is-invalid @enderror" id="page-title" type="text" name="title" value="{{ old('title', $page->title) }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label" for="page-content">{{ __('admin.pages.fields.content') }}</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="page-content" name="content" rows="18">{{ old('content', $page->content) }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div>
                    <button class="btn btn-primary" type="submit">{{ __('admin.pages.actions.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
