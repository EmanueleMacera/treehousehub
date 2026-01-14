@extends('layouts.public')

@section('title', 'TreeHouse Italia - Il Piacere di Abitare')

@section('meta_description', 'Immobili esclusivi sulla Riviera Ligure: affitti turistici gestiti, vendite di prestigio e partnership con proprietari. Scenari storici, comfort contemporaneo.')

@section('canonical', url('/' . app()->getLocale()))

@section('content')
<section class="hero-main">
<div class="hero-bg">
<img src="{{ asset('images/hero-riviera-ligure.jpg') }}" alt="Riviera Ligure - TreeHouse Italia" class="hero-bg__image" onerror="this.outerHTML='<div class=hero-bg__image--placeholder>🏛️</div>'">
</div>
<div class="hero-main__wrapper">
<div class="hero-main__inner">
<div class="hero-main__content">
<p class="hero-main__kicker">Hospitality & Real Estate Liguria</p>
<h1 class="hero-main__title">Il Piacere di Abitare</h1>
<p class="hero-main__lead">Tra mare e borghi storici, creiamo esperienze autentiche: <strong>gestione affitti turistici</strong>, <strong>immobili esclusivi in vendita</strong> e <strong>partnership con proprietari</strong>. Tradizione, design e valore nel tempo.</p>
<div class="hero-main__cta">
<a class="btn btn--primary" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Affitti turistici</a>
<a class="btn btn--primary" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Immobili in vendita</a>
<a class="btn btn--ghost" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Diventa partner</a>
</div>
</div>
<div class="hero-main__visual">
<div class="hero-card">
<div class="hero-card__badge">Per Proprietari</div>
<h3 class="hero-card__title">La tua casa,<br>il tuo guadagno</h3>
<p class="hero-card__text">Gestione completa, report trimestrali e assicurazione inclusa. <strong>Senza costi a tuo carico</strong>.</p>
<a class="hero-card__link" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Scopri come &rarr;</a>
</div>
</div>
</div>
</div>
</section>

<section class="trust-bar">
<div class="trust-item">
<div class="trust-item__value">30+ anni</div>
<div class="trust-item__label">Esperienza settore</div>
</div>
<div class="trust-item">
<div class="trust-item__value">4 destinazioni</div>
<div class="trust-item__label">Iconiche in Liguria e Piemonte</div>
</div>
<div class="trust-item">
<div class="trust-item__value">Gestione end-to-end</div>
<div class="trust-item__label">Check-in, pulizie, fiscalità</div>
</div>
<div class="trust-item">
<div class="trust-item__value">Assicurati</div>
<div class="trust-item__label">Ogni soggiorno coperto</div>
</div>
</section>

<section class="pathways">
<header class="section-head">
<h2 class="section-title">Cosa Cerchi?</h2>
<p class="section-subtitle">Tre percorsi chiari per guidarti subito verso ciò che ti serve: ospitalità esclusiva, immobili in vendita, o partnership gestionale.</p>
</header>
<div class="pathway-grid">
<article class="pathway-card">
<div class="pathway-card__icon">🏡</div>
<h3 class="pathway-card__title">Affitti Turistici</h3>
<p class="pathway-card__desc">Scopri le nostre <strong>strutture ricettive curate</strong>: dal primo albergo diffuso della Liguria ai resort sul mare. Prenotazione diretta sui siti ufficiali.</p>
<ul class="pathway-card__features">
<li>Colletta di Castelbianco (borgo diffuso)</li>
<li>Dominio Mare Bergeggi (resort)</li>
<li>Borgo Fantino Limone Piemonte</li>
<li>Castello Borelli Borghetto</li>
</ul>
<a class="btn btn--primary" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Esplora le strutture</a>
</article>

<article class="pathway-card">
<div class="pathway-card__icon">🏛️</div>
<h3 class="pathway-card__title">Immobili in Vendita</h3>
<p class="pathway-card__desc">Immobili di <strong>prestigio in contesti unici</strong>: castelli, ville storiche ed eleganti residenze sulla Riviera Ligure. Consulenza professionale dall'analisi alla proposta.</p>
<ul class="pathway-card__features">
<li>Scenari storici e paesaggi naturali</li>
<li>Efficienza energetica e materiali sostenibili</li>
<li>Project management e direzione lavori</li>
<li>Valore duraturo nel tempo</li>
</ul>
<a class="btn btn--primary" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Scopri le opportunità</a>
</article>

<article class="pathway-card">
<div class="pathway-card__icon">🤝</div>
<h3 class="pathway-card__title">Diventa Proprietario Partner</h3>
<p class="pathway-card__desc">Affida il tuo immobile: gestiamo <strong>prenotazioni, pulizie, fiscalità e assistenza</strong>. Report trimestrali e assicurazione inclusa. <strong>Nessun costo a tuo carico</strong>.</p>
<ul class="pathway-card__features">
<li>Analisi preliminare di redditività</li>
<li>Consulenza per valorizzazione immobile</li>
<li>Mandato di gestione completo</li>
<li>Report dettagliati ogni 3 mesi</li>
</ul>
<a class="btn btn--outline" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Scopri la partnership</a>
</article>
</div>
</section>

@if($featuredStructures->count() > 0 || $featuredSales->count() > 0)
<section class="featured">
<header class="section-head">
<h2 class="section-title">In Primo Piano</h2>
<p class="section-subtitle">Selezione rapida per esplorare subito strutture e immobili disponibili.</p>
</header>
<div class="featured-grid">
@if($featuredStructures->count() > 0)
<article class="featured-panel">
<div class="featured-panel__head">
<h3>Strutture Ricettive</h3>
<a class="link-arrow" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Vedi tutte &rarr;</a>
</div>
<ul class="mini-list">
@foreach($featuredStructures as $s)
<li class="mini-card">
<a class="mini-card__title" href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'slug' => $s->slug]) }}">{{ $s->name }}</a>
<div class="mini-card__meta">{{ $s->location }}</div>
@if($s->description_short)
<p class="mini-card__desc">{{ Str::limit($s->description_short, 80) }}</p>
@endif
</a>
</li>
@endforeach
</ul>
</article>
@endif

@if($featuredSales->count() > 0)
<article class="featured-panel featured-panel--accent">
<div class="featured-panel__head">
<h3>Immobili in Vendita</h3>
<a class="link-arrow" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Vedi tutti &rarr;</a>
</div>
<ul class="mini-list">
@foreach($featuredSales as $p)
<li class="mini-card">
<a class="mini-card__title" href="{{ route('sales.show', ['locale' => app()->getLocale(), 'slug' => $p->slug]) }}">{{ $p->title }}</a>
<div class="mini-card__meta">{{ $p->location }}@if($p->price) • {{ number_format($p->price, 0, ',', '.') }} €@endif</div>
@if($p->description_short)
<p class="mini-card__desc">{{ Str::limit($p->description_short, 80) }}</p>
@endif
</a>
</li>
@endforeach
</ul>
</article>
@endif
</div>
</section>
@endif

<section class="process">
<header class="section-head">
<h2 class="section-title">Come Lavoriamo con i Proprietari</h2>
<p class="section-subtitle">Un percorso chiaro, senza sorprese: dalla valutazione iniziale ai report periodici.</p>
</header>
<ol class="process-steps">
<li class="process-step">
<div class="process-step__num">1</div>
<h3 class="process-step__title">Analisi Preliminare</h3>
<p class="process-step__text">Visioniamo il tuo immobile di persona e facciamo un'analisi sulla redditività e potenziale turistico.</p>
</li>
<li class="process-step">
<div class="process-step__num">2</div>
<h3 class="process-step__title">Valorizzazione</h3>
<p class="process-step__text">Offriamo consulenza gratuita per valorizzare il tuo immobile, rendendolo adatto al mercato degli affitti brevi.</p>
</li>
<li class="process-step">
<div class="process-step__num">3</div>
<h3 class="process-step__title">Gestione Completa</h3>
<p class="process-step__text">Gestiamo tutto: prenotazioni, check-in/out, pulizie, manutenzione e adempimenti fiscali. Senza costi a tuo carico.</p>
</li>
<li class="process-step">
<div class="process-step__num">4</div>
<h3 class="process-step__title">Assicurazione</h3>
<p class="process-step__text">Ogni soggiorno è coperto da una garanzia assicurativa per proteggere il tuo immobile da danni.</p>
</li>
<li class="process-step">
<div class="process-step__num">5</div>
<h3 class="process-step__title">Report Trimestrali</h3>
<p class="process-step__text">Ti inviamo un report dettagliato sull'andamento delle prenotazioni, occupazione e guadagni.</p>
</li>
</ol>
<div class="process-cta">
<a class="btn btn--large btn--primary" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Richiedi una valutazione gratuita</a>
<a class="btn btn--large btn--ghost" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">Contattaci</a>
</div>
</section>

<section class="values">
<header class="section-head">
<h2 class="section-title">La Nostra Filosofia</h2>
<p class="section-subtitle">Valori che guidano ogni progetto, ogni ristrutturazione, ogni relazione con proprietari e ospiti.</p>
</header>
<div class="values-grid">
<article class="value-card">
<h3 class="value-card__title">Prestigio, Sicurezza e Contesto</h3>
<p class="value-card__text">Ogni nostro progetto nasce da questi valori essenziali, che assicurano qualità duratura e un autentico valore nel tempo.</p>
</article>
<article class="value-card">
<h3 class="value-card__title">Forma, Funzionalità e Comfort</h3>
<p class="value-card__text">Guidano costantemente il nostro lavoro per dare vita a spazi che coniugano bellezza ed efficienza nella vita quotidiana.</p>
</article>
<article class="value-card">
<h3 class="value-card__title">Luce, Colore ed Emozioni</h3>
<p class="value-card__text">Gli elementi immateriali che trasformano gli ambienti in esperienze capaci di toccare chi li abita.</p>
</article>
<article class="value-card">
<h3 class="value-card__title">Il Piacere di Abitare</h3>
<p class="value-card__text">Proponiamo un'esperienza abitativa di livello superiore, dove ogni dettaglio è studiato per offrire benessere e armonia.</p>
</article>
</div>
</section>

<section class="story">
<header class="section-head">
<h2 class="section-title">La Nostra Storia</h2>
<p class="section-subtitle">Un percorso di eccellenza: dai borghi storici liguri ai resort contemporanei, sempre con lo stesso impegno verso la qualità.</p>
</header>
<div class="timeline-wrapper">
<div class="timeline-line"></div>
<div class="timeline">
<article class="timeline-item">
<div class="timeline-dot"></div>
<div class="timeline-content">
<img src="{{ asset('images/colletta-castelbianco.jpg') }}" alt="Colletta di Castelbianco" class="timeline-image" onerror="this.outerHTML='<div class=timeline-image--placeholder>🏔️</div>'">
<div class="timeline-body">
<span class="timeline-year">1995 - Prima in Liguria</span>
<h3 class="timeline-title">Colletta di Castelbianco</h3>
<p class="timeline-text">Primo albergo diffuso della Regione Liguria: un borgo medievale restaurato con rispetto della storia e comfort contemporaneo.</p>
</div>
</div>
</article>

<article class="timeline-item">
<div class="timeline-dot"></div>
<div class="timeline-content">
<img src="{{ asset('images/dominio-mare.jpg') }}" alt="Dominio Mare Bergeggi" class="timeline-image" onerror="this.outerHTML='<div class=timeline-image--placeholder>🌊</div>'">
<div class="timeline-body">
<span class="timeline-year">2010 - Mare & Design</span>
<h3 class="timeline-title">Resort Dominio Mare</h3>
<p class="timeline-text">San Sebastiano Bergeggi (SV): resort esclusivo affacciato sul mare, dove design contemporaneo incontra la tradizione ligure.</p>
</div>
</div>
</article>

<article class="timeline-item">
<div class="timeline-dot"></div>
<div class="timeline-content">
<img src="{{ asset('images/borgo-fantino.jpg') }}" alt="Borgo Fantino Limone" class="timeline-image" onerror="this.outerHTML='<div class=timeline-image--placeholder>⛰️</div>'">
<div class="timeline-body">
<span class="timeline-year">2018 - Montagna</span>
<h3 class="timeline-title">Borgo Fantino</h3>
<p class="timeline-text">Limone Piemonte (CN): ospitalità montana di livello, per chi cerca relax e natura senza rinunciare ai servizi.</p>
</div>
</div>
</article>

<article class="timeline-item">
<div class="timeline-dot"></div>
<div class="timeline-content">
<img src="{{ asset('images/castello-borelli.jpg') }}" alt="Castello Borelli" class="timeline-image" onerror="this.outerHTML='<div class=timeline-image--placeholder>🏰</div>'">
<div class="timeline-body">
<span class="timeline-year">2022 - Storia & Vista Mare</span>
<h3 class="timeline-title">Castello Borelli</h3>
<p class="timeline-text">Borghetto S.Spirito (SV): castello storico con panorama sul mare, simbolo della nostra capacità di valorizzare il patrimonio.</p>
</div>
</div>
</article>
</div>
</div>
</section>

<section class="final-cta">
<div class="final-cta__content">
<h2 class="final-cta__title">Pronto a Valorizzare il Tuo Immobile?</h2>
<p class="final-cta__text">Che tu stia cercando una casa vacanza, un immobile di prestigio o una gestione professionale per il tuo patrimonio, siamo qui per guidarti.</p>
<div class="final-cta__actions">
<a class="btn btn--large btn--primary" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Richiedi una valutazione</a>
<a class="btn btn--large btn--ghost" href="{{ route('about', ['locale' => app()->getLocale()]) }}">Chi siamo</a>
</div>
</div>
</section>

<script>
document.addEventListener('DOMContentLoaded',function(){
const timelineItems=document.querySelectorAll('.timeline-item');
const observer=new IntersectionObserver((entries)=>{
entries.forEach(entry=>{
if(entry.isIntersecting){
entry.target.classList.add('visible');
}
});
},{threshold:0.2});
timelineItems.forEach(item=>observer.observe(item));
});
</script>
@endsection
