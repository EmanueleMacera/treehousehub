@extends('layouts.public')

@section('title', __('auth.login.title'))

@section('content')
    <h1>{{ __('auth.login.title') }}</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label>
                {{ __('auth.login.email') }}
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </label>
            @error('email')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label>
                {{ __('auth.login.password') }}
                <input type="password" name="password" required>
            </label>
            @error('password')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember" value="1">
                {{ __('auth.login.remember') }}
            </label>
        </div>

        <button type="submit">{{ __('auth.login.submit') }}</button>
    </form>
@endsection
