@extends('layouts.public')

@section('title', 'Chi Siamo - TreeHouse Italia')

@section('meta_description', 'TreeHouse Italia: oltre 30 anni di esperienza nella gestione immobiliare e promozione turistica. Dal primo albergo diffuso della Liguria a progetti innovativi di sviluppo sostenibile.')

@section('canonical', route('about', ['locale' => app()->getLocale()]))

@section('content')
<!-- Hero Chi Siamo -->
<section class="about-hero">
<div class="about-hero__inner">
<p class="about-hero__kicker">La Nostra Storia</p>
<h1 class="about-hero__title">Chi Siamo</h1>
<div class="about-hero__lead">
<p>Siamo una <strong>società di servizi</strong> specializzata nella <strong>gestione immobiliare</strong> e nella <strong>promozione turistica</strong> e <strong>territoriale</strong>. Selezioniamo <strong>strutture ricettive</strong> e le promuoviamo attraverso i principali <strong>canali di vendita</strong> con l'obiettivo di valorizzarle e proporre un'offerta <strong>sostenibile</strong> e <strong>moderna</strong>.</p>
<p>Offriamo <strong>opportunità di investimento immobiliare</strong>, occupandoci dell'organizzazione e della <strong>gestione completa degli affitti di case vacanze</strong>. Collaboriamo attivamente con <strong>enti locali</strong> per promuovere il <strong>territorio</strong>.</p>
<p>Possiamo vantarci di aver realizzato il primo <strong>albergo diffuso</strong> nell'ormai lontano <strong>2000</strong> nel <strong>Borgo di Colletta di Castelbianco</strong>. Da allora non ci siamo più fermati, migliorando continuamente il servizio per i <strong>proprietari</strong> e per gli <strong>ospiti</strong>.</p>
</div>
<div class="about-hero__mission">
<h2>La nostra missione</h2>
<p>Creare valore attraverso <strong>competenza</strong>, <strong>innovazione</strong> e <strong>dedizione</strong></p>
</div>
</div>
</section>

<!-- Timeline Milestones -->
<section class="milestones">
<header class="section-head">
<h2 class="section-title">I Nostri Traguardi</h2>
<p class="section-subtitle">Un percorso di crescita continua nel settore immobiliare e turistico</p>
</header>
<div class="milestones-grid">
<article class="milestone-card">
<div class="milestone-card__year">2000</div>
<h3 class="milestone-card__title">Primo Albergo Diffuso della Liguria</h3>
<p class="milestone-card__text">Realizziamo il primo albergo diffuso della regione nel Borgo di Colletta di Castelbianco, pionieri dell'ospitalità diffusa.</p>
</article>
<article class="milestone-card">
<div class="milestone-card__year">2010</div>
<h3 class="milestone-card__title">Espansione Riviera Ligure</h3>
<p class="milestone-card__text">Apertura del Resort Dominio Mare a Bergeggi, portando l'eccellenza dell'ospitalità sulla costa ligure.</p>
</article>
<article class="milestone-card">
<div class="milestone-card__year">2018</div>
<h3 class="milestone-card__title">Montagna e Borghi</h3>
<p class="milestone-card__text">Lancio di Borgo Fantino a Limone Piemonte e acquisizione di progetti immobiliari storici.</p>
</article>
<article class="milestone-card">
<div class="milestone-card__year">2022</div>
<h3 class="milestone-card__title">Castello Borelli</h3>
<p class="milestone-card__text">Valorizzazione del Castello Borelli a Borghetto Santo Spirito, simbolo del nostro impegno nel patrimonio storico.</p>
</article>
</div>
</section>

<!-- Team Section -->
<section class="team-section">
<header class="section-head">
<h2 class="section-title">Il Nostro Team</h2>
<p class="section-subtitle">Professionisti con oltre 30 anni di esperienza al vostro servizio</p>
</header>

<div class="team-grid">
<article class="team-member">
<div class="team-member__photo">
<div class="team-member__photo-placeholder">👤</div>
</div>
<div class="team-member__content">
<div class="team-member__role">Founder & CEO</div>
<h3 class="team-member__name">Carlo Pampirio</h3>
<p class="team-member__title">Amministratore Unico</p>
<div class="team-member__bio">
<p><strong>Esperto in commercializzazione, gestione e marketing immobiliare</strong></p>
<p>Con una solida esperienza nel settore immobiliare, si è specializzato nella commercializzazione, gestione e strategie di marketing per valorizzare e promuovere operazioni immobiliari.</p>
<ul>
<li><strong>Socio Fondatore di Re-anima</strong> – Crowdfunding immobiliare con impatto sociale</li>
<li><strong>Presidente e Socio Fondatore di Dolidays Srl</strong> – Piattaforma di booking pet friendly</li>
</ul>
</div>
</div>
</article>

<article class="team-member">
<div class="team-member__photo">
<div class="team-member__photo-placeholder">👤</div>
</div>
<div class="team-member__content">
<div class="team-member__role">Chief Operations Officer</div>
<h3 class="team-member__name">Alessandro Pampirio</h3>
<p class="team-member__title">COO</p>
<div class="team-member__bio">
<p><strong>Imprenditore con oltre 30 anni di esperienza nello sviluppo immobiliare</strong></p>
<p>Da più di tre decenni, opera con successo nel settore dello sviluppo immobiliare, con un'attenzione particolare al recupero e alla valorizzazione del patrimonio storico italiano.</p>
<ul>
<li><strong>Socio e Fondatore di Treehouse Italia Srl</strong></li>
<li><strong>CFO e Board Member di Dolidays Srl</strong> – Specialisti nel turismo pet friendly</li>
</ul>
</div>
</div>
</article>

<article class="team-member">
<div class="team-member__photo">
<div class="team-member__photo-placeholder">👤</div>
</div>
<div class="team-member__content">
<div class="team-member__role">Financial Director</div>
<h3 class="team-member__name">Franco Riccardi</h3>
<p class="team-member__title">Direttore Finanziario</p>
<div class="team-member__bio">
<p><strong>Imprenditore specializzato nello sviluppo immobiliare</strong></p>
<p>Professionista con esperienza nel settore dello sviluppo immobiliare, impegnato nella realizzazione di progetti innovativi e sostenibili.</p>
<ul>
<li><strong>Socio fondatore e responsabile area tecnico-edilizia di Treehouse Italia Srl</strong></li>
<li><strong>COO e Direttore Amministrativo di Dolidays Srl</strong> – Turismo Pet Friendly</li>
</ul>
</div>
</div>
</article>

<article class="team-member">
<div class="team-member__photo">
<div class="team-member__photo-placeholder">👥</div>
</div>
<div class="team-member__content">
<div class="team-member__role">Marketing Manager</div>
<h3 class="team-member__name">Roberta Nattino</h3>
<p class="team-member__title">Responsabile Marketing</p>
<div class="team-member__bio">
<p><strong>Esperta in prenotazioni e customer care con oltre 20 anni di esperienza</strong></p>
<p>Professionista dedicata da più di 20 anni alla gestione delle prenotazioni e al customer care, offrendo un servizio di eccellenza per soddisfare le esigenze di proprietari e clienti.</p>
</div>
</div>
</article>

<article class="team-member">
<div class="team-member__photo">
<div class="team-member__photo-placeholder">👥</div>
</div>
<div class="team-member__content">
<div class="team-member__role">Customer Relations</div>
<h3 class="team-member__name">Stefania Vigorita</h3>
<p class="team-member__title">Relazioni Clienti</p>
<div class="team-member__bio">
<p><strong>Oltre 20 anni di esperienza nella gestione immobiliare con Treehouse Italia Srl</strong></p>
<p>Professionista con un'esperienza ventennale, specializzata nella gestione degli aspetti fiscali e burocratici legati agli immobili, garantendo efficienza e conformità in ogni progetto immobiliare.</p>
</div>
</div>
</article>
</div>
</section>

<!-- Values Section -->
<section class="company-values">
<header class="section-head">
<h2 class="section-title">I Valori che ci Guidano</h2>
<p class="section-subtitle">Principi fondamentali che ispirano il nostro lavoro quotidiano</p>
</header>
<div class="values-showcase">
<article class="value-showcase">
<div class="value-showcase__icon">🤝</div>
<h3 class="value-showcase__title">Fiducia</h3>
<p class="value-showcase__text">Costruiamo relazioni basate sulla trasparenza e l'integrità. La fiducia dei nostri clienti e partner è il nostro bene più prezioso.</p>
</article>
<article class="value-showcase">
<div class="value-showcase__icon">💡</div>
<h3 class="value-showcase__title">Innovazione</h3>
<p class="value-showcase__text">Cerchiamo costantemente nuove soluzioni creative per offrire servizi all'avanguardia nel settore immobiliare e turistico.</p>
</article>
<article class="value-showcase">
<div class="value-showcase__icon">⭐</div>
<h3 class="value-showcase__title">Eccellenza</h3>
<p class="value-showcase__text">Ci impegniamo per raggiungere i più alti standard di qualità in ogni aspetto del nostro lavoro, dalla consulenza alla gestione operativa.</p>
</article>
</div>
</section>

<!-- CTA Finale -->
<section class="about-cta">
<div class="about-cta__content">
<h2 class="about-cta__title">Vuoi Saperne di Più?</h2>
<p class="about-cta__text">Scopri come possiamo aiutarti a valorizzare il tuo immobile o trovare la proprietà perfetta per te.</p>
<div class="about-cta__actions">
<a class="btn btn--large btn--primary" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">Contattaci</a>
<a class="btn btn--large btn--ghost" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Diventa partner</a>
</div>
</div>
</section>
@endsection
