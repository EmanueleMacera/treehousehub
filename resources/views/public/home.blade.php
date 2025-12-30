@extends('layouts.public')

@section('title', 'TreeHouse Italia - Hub')

@section('canonical', url('/' . app()->getLocale()))

@section('content')
<section class="hero">
<div class="hero__content">
<p class="kicker">Hospitality & Real Estate</p>
<h1>Un hub unico per affitti, vendite e proprietari</h1>
<p class="lead">Scopri le nostre strutture, esplora opportunità immobiliari e collabora con TreeHouse Italia per valorizzare il tuo patrimonio.</p>
<div class="hero__cta">
<a class="btn btn--primary" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Scopri le strutture</a>
<a class="btn btn--ghost" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Esplora le vendite</a>
<a class="btn btn--ghost" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Sei un proprietario?</a>
</div>
</div>
</section>

<section class="grid">
<h2>Scegli il tuo percorso</h2>
<p class="sub">Tre esperienze pensate per guidarti subito alla sezione giusta.</p>
<div class="cards">
<article class="card">
<h3>Affitti (Strutture)</h3>
<p>Presentiamo le nostre strutture e ti indirizziamo ai siti ufficiali per prenotare.</p>
<a class="btn btn--primary" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Vai agli affitti</a>
</article>
<article class="card">
<h3>Vendite</h3>
<p>Immobili selezionati e consulenza dedicata: dalla visita alla proposta.</p>
<a class="btn btn--ghost" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Vai alle vendite</a>
</article>
<article class="card card--accent">
<h3>Diventa proprietario partner</h3>
<p>Affida il tuo immobile: gestione operativa completa e monitoraggio trasparente.</p>
<a class="btn btn--ghost" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Scopri la partnership</a>
</article>
</div>
</section>

@if($featuredStructures->count() > 0 || $featuredSales->count() > 0)
<section class="featured">
<h2>In primo piano</h2>
<div class="featured__grid">
@if($featuredStructures->count() > 0)
<article class="panel">
<div class="panel__head">
<h3>Strutture</h3>
<a class="link" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Vedi tutte</a>
</div>
<ul class="miniList">
@foreach($featuredStructures as $s)
<li class="miniItem">
<a class="miniItem__title" href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'slug' => $s->slug]) }}">{{ $s->name }}</a>
<div class="miniItem__meta">{{ $s->location }}</div>
</li>
@endforeach
</ul>
</article>
@endif
@if($featuredSales->count() > 0)
<article class="panel panel--accent">
<div class="panel__head">
<h3>Immobili in vendita</h3>
<a class="link" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Vedi tutti</a>
</div>
<ul class="miniList">
@foreach($featuredSales as $p)
<li class="miniItem">
<a class="miniItem__title" href="{{ route('sales.show', ['locale' => app()->getLocale(), 'slug' => $p->slug]) }}">{{ $p->title }}</a>
<div class="miniItem__meta">{{ $p->location }}</div>
</li>
@endforeach
</ul>
</article>
@endif
</div>
</section>
@endif

<section class="cta-bar">
<h2>Come lavoriamo</h2>
<p>Un processo chiaro per creare valore: analisi, valorizzazione, gestione e report trasparenti.</p>
<div class="cta-bar__actions">
<a class="btn btn--primary" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Diventa partner</a>
<a class="btn btn--ghost" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">Contattaci</a>
</div>
</section>
@endsection
