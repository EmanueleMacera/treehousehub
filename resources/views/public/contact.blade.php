@extends('layouts.public')

@section('title', 'Contattaci - TreeHouse Italia')

@section('meta_description', 'Contatta TreeHouse Italia per informazioni su affitti brevi, vendite immobiliari o gestione proprietà. Telefono: +39 019 8387211 | Email: info@treehouseitalia.it')

@section('canonical', route('contact', ['locale' => app()->getLocale()]))

@section('content')
<!-- Contact Hero -->
<section class="contact-hero">
<div class="contact-hero__inner">
<p class="contact-hero__kicker">Parliamone</p>
<h1 class="contact-hero__title">Contattaci</h1>
<p class="contact-hero__lead">Hai domande sui nostri servizi? Vuoi una valutazione gratuita del tuo immobile? Il nostro team è pronto ad aiutarti.</p>
</div>
</section>

<!-- Contact Content Grid -->
<section class="contact-content">
<div class="contact-content__grid">
<!-- Contact Info -->
<div class="contact-info">
<div class="contact-info__block">
<div class="contact-info__icon">📞</div>
<h3 class="contact-info__title">Telefono</h3>
<a href="tel:+390198387211" class="contact-info__link">+39 019 8387211</a>
<p class="contact-info__note">Lun-Ven 9:00-18:00</p>
</div>

<div class="contact-info__block">
<div class="contact-info__icon">✉️</div>
<h3 class="contact-info__title">Email</h3>
<a href="mailto:info@treehouseitalia.it" class="contact-info__link">info@treehouseitalia.it</a>
<p class="contact-info__note">Ti risponderemo entro 24h</p>
</div>

<div class="contact-info__block">
<div class="contact-info__icon">📍</div>
<h3 class="contact-info__title">Sede Legale</h3>
<address class="contact-info__address">
Via Agostino Chiodo 6<br>
17100 Savona (SV)<br>
Italia
</address>
</div>

<div class="contact-info__block">
<div class="contact-info__icon">🏢</div>
<h3 class="contact-info__title">Dati Aziendali</h3>
<p class="contact-info__text">TreeHouse Italia Srl</p>
<p class="contact-info__text">P.IVA: IT01581160098</p>
</div>
</div>

<!-- Contact Form -->
<div class="contact-form-wrapper">
<div class="contact-form-header">
<h2 class="contact-form-header__title">Invia un Messaggio</h2>
<p class="contact-form-header__subtitle">Compila il form e ti contatteremo al più presto</p>
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
<label for="name" class="form-label">Nome e Cognome *</label>
<input 
type="text" 
id="name"
name="name" 
class="form-input @error('name') form-input--error @enderror" 
value="{{ old('name') }}"
required
>
@error('name')
<div class="form-error">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label for="email" class="form-label">Email *</label>
<input 
type="email" 
id="email"
name="email" 
class="form-input @error('email') form-input--error @enderror" 
value="{{ old('email') }}"
required
>
@error('email')
<div class="form-error">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label for="phone" class="form-label">Telefono</label>
<input 
type="tel" 
id="phone"
name="phone" 
class="form-input" 
value="{{ old('phone') }}"
>
</div>

<div class="form-group">
<label for="subject" class="form-label">Oggetto</label>
<select id="subject" name="subject" class="form-input">
<option value="">Seleziona un'opzione...</option>
<option value="valutazione" {{ old('subject') == 'valutazione' ? 'selected' : '' }}>Valutazione immobile</option>
<option value="affitto" {{ old('subject') == 'affitto' ? 'selected' : '' }}>Affitto breve - Proprietario</option>
<option value="prenotazione" {{ old('subject') == 'prenotazione' ? 'selected' : '' }}>Prenotazione struttura</option>
<option value="vendita" {{ old('subject') == 'vendita' ? 'selected' : '' }}>Vendita immobile</option>
<option value="informazioni" {{ old('subject') == 'informazioni' ? 'selected' : '' }}>Informazioni generali</option>
<option value="altro" {{ old('subject') == 'altro' ? 'selected' : '' }}>Altro</option>
</select>
</div>

<div class="form-group">
<label for="message" class="form-label">Messaggio *</label>
<textarea 
id="message"
name="message" 
class="form-textarea @error('message') form-input--error @enderror" 
rows="6"
required
>{{ old('message') }}</textarea>
@error('message')
<div class="form-error">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<label class="form-checkbox">
<input type="checkbox" name="privacy" required>
<span class="form-checkbox__text">Accetto la <a href="#" class="form-link">privacy policy</a> e acconsento al trattamento dei miei dati personali *</span>
</label>
@error('privacy')
<div class="form-error">{{ $message }}</div>
@enderror
</div>

<div class="form-actions">
<button type="submit" class="btn btn--primary btn--large">Invia Messaggio</button>
</div>
</form>
</div>
</div>
</section>

<!-- FAQ Quick Section -->
<section class="contact-faq">
<header class="section-head">
<h2 class="section-title">Domande Frequenti</h2>
<p class="section-subtitle">Le risposte alle domande più comuni</p>
</header>
<div class="contact-faq-grid">
<article class="faq-quick">
<h3 class="faq-quick__question">Come funziona la valutazione gratuita?</h3>
<p class="faq-quick__answer">Contattaci per fissare un sopralluogo gratuito. I nostri esperti valuteranno il tuo immobile e ti forniranno una proiezione accurata dei potenziali guadagni da affitti brevi.</p>
</article>
<article class="faq-quick">
<h3 class="faq-quick__question">Quanto tempo ci vuole per una risposta?</h3>
<p class="faq-quick__answer">Il nostro team risponde entro 24 ore lavorative a tutte le richieste via email o form. Per urgenze, chiamaci direttamente al numero +39 019 8387211.</p>
</article>
<article class="faq-quick">
<h3 class="faq-quick__question">Posso visitare la vostra sede?</h3>
<p class="faq-quick__answer">Certamente! La nostra sede è a Savona in Via Agostino Chiodo 6. Ti consigliamo di contattarci prima per fissare un appuntamento e garantirti la disponibilità di un consulente.</p>
</article>
</div>
</section>

<!-- CTA Alternative -->
<section class="contact-cta-alt">
<div class="contact-cta-alt__content">
<h2 class="contact-cta-alt__title">Preferisci Parlare Direttamente?</h2>
<p class="contact-cta-alt__text">Il nostro team è a disposizione per rispondere a tutte le tue domande</p>
<div class="contact-cta-alt__actions">
<a href="tel:+390198387211" class="btn btn--primary btn--large">📞 Chiamaci Ora</a>
<a href="{{ route('owners', ['locale' => app()->getLocale()]) }}" class="btn btn--ghost btn--large">Info Proprietari</a>
</div>
</div>
</section>
@endsection
