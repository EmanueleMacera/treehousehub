@extends('layouts.public')

@section('title', __('contact.meta.title'))

@section('meta_description', __('contact.meta.description'))

@section('canonical', route('contact', ['locale' => app()->getLocale()]))

@section('content')
<section class="contact-hero">
<div class="contact-hero__inner">
<p class="contact-hero__kicker">{{ __('contact.hero.kicker') }}</p>
<h1 class="contact-hero__title">{{ __('contact.hero.title') }}</h1>
<p class="contact-hero__lead">{{ __('contact.hero.subtitle') }}</p>
</div>
</section>

<section class="contact-content">
<div class="contact-content__grid">
<div class="contact-info">
@foreach(__('contact.info.blocks') as $block)
<div class="contact-info__block">
<div class="contact-info__icon">{{ $block['icon'] }}</div>
<h3 class="contact-info__title">{{ $block['title'] }}</h3>
@if($block['type'] === 'phone')
<a href="tel:+390198387211" class="contact-info__link">+39 019 8387211</a>
<p class="contact-info__note">{{ $block['note'] }}</p>
@elseif($block['type'] === 'email')
<a href="mailto:info@treehouseitalia.it" class="contact-info__link">info@treehouseitalia.it</a>
<p class="contact-info__note">{{ $block['note'] }}</p>
@elseif($block['type'] === 'address')
<address class="contact-info__address">{!! $block['text'] !!}</address>
@else
@foreach($block['lines'] as $line)
<p class="contact-info__text">{{ $line }}</p>
@endforeach
@endif
</div>
@endforeach
</div>

<div class="contact-form-wrapper">
<div class="contact-form-header">
<h2 class="contact-form-header__title">{{ __('contact.form.title') }}</h2>
<p class="contact-form-header__subtitle">{{ __('contact.form.subtitle') }}</p>
</div>

@if (session('status'))
<div class="contact-alert contact-alert--success">
<span class="contact-alert__icon">✓</span>
<span>{{ session('status') }}</span>
</div>
@endif

<form method="POST" action="{{ route('contact.submit', ['locale' => app()->getLocale()]) }}" class="contact-form">
@csrf

<div class="form-group">
<label for="name" class="form-label">{{ __('contact.form.name') }} *</label>
<input type="text" id="name" name="name" class="form-input @error('name') form-input--error @enderror" value="{{ old('name') }}" required>
@error('name')
<div class="form-error">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label for="email" class="form-label">{{ __('contact.form.email') }} *</label>
<input type="email" id="email" name="email" class="form-input @error('email') form-input--error @enderror" value="{{ old('email') }}" required>
@error('email')
<div class="form-error">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label for="phone" class="form-label">{{ __('contact.form.phone') }}</label>
<input type="tel" id="phone" name="phone" class="form-input" value="{{ old('phone') }}">
</div>

<div class="form-group">
<label for="subject" class="form-label">{{ __('contact.form.subject') }}</label>
<select id="subject" name="subject" class="form-input">
<option value="">{{ __('contact.form.subject_placeholder') }}</option>
@foreach(__('contact.form.subject_options') as $value => $label)
<option value="{{ $value }}" {{ old('subject') == $value ? 'selected' : '' }}>{{ $label }}</option>
@endforeach
</select>
</div>

<div class="form-group">
<label for="message" class="form-label">{{ __('contact.form.message') }} *</label>
<textarea id="message" name="message" class="form-textarea @error('message') form-input--error @enderror" rows="6" required>{{ old('message') }}</textarea>
@error('message')
<div class="form-error">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label class="form-checkbox">
<input type="checkbox" name="privacy" required>
<span class="form-checkbox__text">{!! __('contact.form.privacy', ['url' => route('legal.privacy', ['locale' => app()->getLocale()])]) !!}</span>
</label>
@error('privacy')
<div class="form-error">{{ $message }}</div>
@enderror
</div>

<div class="form-actions">
<button type="submit" class="btn btn--primary btn--large">{{ __('contact.form.submit') }}</button>
</div>
</form>
</div>
</div>
</section>

<section class="contact-faq">
<header class="section-head">
<h2 class="section-title">{{ __('contact.faq.title') }}</h2>
<p class="section-subtitle">{{ __('contact.faq.subtitle') }}</p>
</header>
<div class="contact-faq-grid">
@foreach(__('contact.faq.items') as $item)
<article class="faq-quick">
<h3 class="faq-quick__question">{{ $item['question'] }}</h3>
<p class="faq-quick__answer">{{ $item['answer'] }}</p>
</article>
@endforeach
</div>
</section>

<section class="contact-cta-alt">
<div class="contact-cta-alt__content">
<h2 class="contact-cta-alt__title">{{ __('contact.cta.title') }}</h2>
<p class="contact-cta-alt__text">{{ __('contact.cta.text') }}</p>
<div class="contact-cta-alt__actions">
<a href="tel:+390198387211" class="btn btn--outline btn--large">{{ __('contact.cta.call') }}</a>
<a href="{{ route('owners', ['locale' => app()->getLocale()]) }}" class="btn btn--ghost btn--large">{{ __('contact.cta.owners') }}</a>
</div>
</div>
</section>
@endsection
