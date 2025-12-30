@extends('layouts.public')

@section('title', __('contact.meta.title'))

@section('content')
    <h1>{{ __('contact.hero.title') }}</h1>
    <p>{{ __('contact.hero.subtitle') }}</p>

    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf

        <div>
            <label>
                {{ __('contact.form.name') }}
                <input type="text" name="name" value="{{ old('name') }}">
            </label>
            @error('name')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label>
                {{ __('contact.form.email') }}
                <input type="email" name="email" value="{{ old('email') }}">
            </label>
            @error('email')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label>
                {{ __('contact.form.message') }}
                <textarea name="message">{{ old('message') }}</textarea>
            </label>
            @error('message')<div>{{ $message }}</div>@enderror
        </div>

        <button type="submit">{{ __('contact.form.submit') }}</button>
    </form>
@endsection
