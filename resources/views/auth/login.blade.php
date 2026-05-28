@extends('layouts.public')

@section('title', __('auth.login.title'))

@section('content')
    <section class="admin-login">
        <div class="admin-login__panel">
            <div class="admin-login__intro">
                <p class="admin-login__kicker">TreeHouse Admin</p>
                <h1>{{ __('auth.login.title') }}</h1>
                <p>Accedi per caricare e aggiornare affitti, vendite, foto e traduzioni del sito.</p>
            </div>

            <form class="admin-login__form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="admin-login__field">
                    <label for="email">{{ __('auth.login.email') }}</label>
                    <input id="email" class="@error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@example.com">
                    @error('email')<div class="admin-login__error">{{ $message }}</div>@enderror
                </div>

                <div class="admin-login__field">
                    <label for="password">{{ __('auth.login.password') }}</label>
                    <input id="password" class="@error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')<div class="admin-login__error">{{ $message }}</div>@enderror
                </div>

                <label class="admin-login__remember">
                    <input type="checkbox" name="remember" value="1">
                    <span>{{ __('auth.login.remember') }}</span>
                </label>

                <button class="admin-login__submit" type="submit">{{ __('auth.login.submit') }}</button>
            </form>
        </div>
    </section>
@endsection
