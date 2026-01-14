@extends('layouts.public')

@section('title', 'Diventa Proprietario Partner - TreeHouse Italia')

@section('meta_description', 'Affitti brevi gestiti in modo professionale: analisi, marketing, prenotazioni, check-in, pulizie, fiscalità. Massimizza i tuoi guadagni senza costi aggiuntivi.')

@section('canonical', route('owners', ['locale' => app()->getLocale()]))

@section('content')
<!-- Hero Proprietari -->
<section class="hero-owners">
<div class="hero-owners__inner">
<div class="hero-owners__content">
<p class="hero-owners__kicker">Affitti Brevi Gestiti</p>
<h1 class="hero-owners__title">Nel 2025 c'è un modo per guadagnare molto di più.</h1>
<p class="hero-owners__lead">Grazie alla nostra innovativa modalità di gestione, puoi <strong>massimizzare i tuoi profitti</strong> dagli affitti brevi senza rinunciare alla <strong>libertà di utilizzare il tuo immobile</strong> quando vuoi. Una soluzione flessibile e redditizia pensata da TreeHouse per i proprietari.</p>
<div class="hero-owners__cta">
<a class="btn btn--primary btn--large" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">Richiedi valutazione gratuita</a>
</div>
</div>
<div class="hero-owners__visual">
<div class="stat-card">
<div class="stat-card__value">+36%</div>
<div class="stat-card__label">Guadagno medio per 7 notti rispetto al mercato</div>
</div>
<div class="stat-card">
<div class="stat-card__value">24/7</div>
<div class="stat-card__label">Supporto ospiti sempre disponibile</div>
</div>
<div class="stat-card">
<div class="stat-card__value">0€</div>
<div class="stat-card__label">Costi di gestione a tuo carico</div>
</div>
</div>
</div>
</section>

<!-- Perché Sceglierci -->
<section class="why-us">
<header class="section-head">
<h2 class="section-title">Perché Scegliere TreeHouse</h2>
<p class="section-subtitle">Gestiamo ogni aspetto di persona: check-in, check-out, supporto ospiti, pulizie e gestione burocratica. Tutto senza alcuna spesa extra per te.</p>
</header>
<div class="benefits-grid">
<article class="benefit-card">
<div class="benefit-card__icon">💰</div>
<h3 class="benefit-card__title">Canone Fisso Garantito</h3>
<p class="benefit-card__text">Canone fisso giornaliero in base alla stagionalità: aumenti dal <strong>12% per una notte al 36% per sette notti</strong> rispetto alle medie di mercato. Nessun costo di gestione a tuo carico.</p>
</article>
<article class="benefit-card">
<div class="benefit-card__icon">🔓</div>
<h3 class="benefit-card__title">Libertà di Utilizzo</h3>
<p class="benefit-card__text">Disponi del tuo appartamento in tempi rapidi, senza scadenze pluriennali. Puoi utilizzarlo quando rimane disponibile, comunicandoci le tue esigenze con anticipo.</p>
</article>
<article class="benefit-card">
<div class="benefit-card__icon">📊</div>
<h3 class="benefit-card__title">Report Trimestrali</h3>
<p class="benefit-card__text">Report dettagliato delle prenotazioni ogni tre mesi, con pagamento entro 60 giorni dalla fine del trimestre. Gestione trasparente e regolare.</p>
</article>
<article class="benefit-card">
<div class="benefit-card__icon">🛡️</div>
<h3 class="benefit-card__title">Zero Rischio Morosità</h3>
<p class="benefit-card__text">L'ospite paga l'intero importo prima del check-in. Il rischio di morosità è nullo, garantendoti serenità e sicurezza economica.</p>
</article>
</div>
</section>

<!-- Servizi Offerti -->
<section class="services-offered">
<header class="section-head">
<h2 class="section-title">Siamo al Tuo Fianco con Professionalità</h2>
<p class="section-subtitle">Soluzioni dedicate per massimizzare il valore del tuo immobile e garantirti un reddito sicuro.</p>
</header>

<div class="service-blocks">
<article class="service-block">
<div class="service-block__icon">🔍</div>
<h3 class="service-block__title">Analisi Preliminare</h3>
<ul class="service-block__list">
<li>Sopralluogo gratuito del tuo immobile</li>
<li>Analisi di mercato e individuazione delle migliori tariffe</li>
<li>Consulenza di homestaging con architetto per valorizzare gli ambienti</li>
</ul>
</article>

<article class="service-block">
<div class="service-block__icon">📸</div>
<h3 class="service-block__title">Visibilità Ottimale e Massimo Rendimento</h3>
<ul class="service-block__list">
<li>Servizio fotografico professionale</li>
<li>Profilo digitale con testi dettagliati e precisi</li>
<li>Canone fisso giornaliero per massimizzare il rendimento</li>
<li>Pubblicazione sui principali portali online (Airbnb, Booking, Expedia, etc.)</li>
</ul>
</article>

<article class="service-block">
<div class="service-block__icon">📅</div>
<h3 class="service-block__title">Gestione delle Prenotazioni</h3>
<ul class="service-block__list">
<li>Sincronizzazione automatica dei calendari su tutti i portali</li>
<li>Risposta rapida alle richieste e conferma immediata</li>
<li>Verifica pagamenti prima dell'arrivo</li>
<li>Controllo costante delle condizioni e coordinamento manutenzione</li>
</ul>
</article>

<article class="service-block">
<div class="service-block__icon">🤝</div>
<h3 class="service-block__title">Accoglienza Ospiti</h3>
<ul class="service-block__list">
<li>Ricevimento ospiti presso la proprietà e consegna chiavi</li>
<li>Supporto disponibile 24/7 per tutta la durata del soggiorno</li>
<li>Gestione check-out con controllo finale</li>
</ul>
</article>

<article class="service-block">
<div class="service-block__icon">🧹</div>
<h3 class="service-block__title">Biancheria e Pulizia</h3>
<ul class="service-block__list">
<li>Fornitura kit di benvenuto</li>
<li>Pulizia meticolosa dopo ogni check-out</li>
<li>Sanificazioni approfondite periodiche</li>
<li>Gestione completa biancheria con sostituzione e lavaggio</li>
</ul>
</article>

<article class="service-block">
<div class="service-block__icon">📋</div>
<h3 class="service-block__title">Gestione Burocratica</h3>
<ul class="service-block__list">
<li>Assistenza apertura attività presso comune o regione (SUAP/CAV)</li>
<li>Invio report dettagliati e gestione versamenti canoni</li>
<li>Sostituto d'imposta per cedolare secca</li>
<li>Invio dati ospiti alla Polizia di Stato e gestione imposta di soggiorno</li>
</ul>
</article>
</div>
</section>

<!-- FAQ Sezione -->
<section class="faq-section">
<header class="section-head">
<h2 class="section-title">Hai delle Domande?</h2>
<p class="section-subtitle">Ecco alcune risposte alle domande più frequenti</p>
</header>

<div class="faq-grid">
<article class="faq-item">
<h3 class="faq-item__question">Come funziona il canone fisso?</h3>
<p class="faq-item__answer">Massimizza i tuoi guadagni grazie al nostro modello di <strong>canone fisso</strong>, stabilito in base alla stagionalità e alla durata del soggiorno. Gli <strong>aumenti rispetto alle medie del mercato</strong> variano dal <strong>12% per una notte al 36% per sette notti</strong>. Non avrai più costi di gestione: ci assumiamo noi tutti gli oneri.</p>
</article>

<article class="faq-item">
<h3 class="faq-item__question">Posso usare il mio appartamento quando voglio?</h3>
<p class="faq-item__answer">Il vantaggio degli affitti brevi è la <strong>possibilità di disporre del tuo appartamento in tempi rapidi</strong>, senza scadenze pluriennali. Puoi monitorare in tempo reale le occupazioni e verificare quando è libero. Se desideri riservarla, comunicacelo entro <strong>settembre dell'anno precedente</strong>. In ogni caso, <strong>potrai utilizzare l'immobile ogni volta che rimane disponibile</strong>.</p>
</article>

<article class="faq-item">
<h3 class="faq-item__question">Quando ricevo i pagamenti?</h3>
<p class="faq-item__answer">Il <strong>report delle prenotazioni viene inviato trimestralmente</strong>, con <strong>pagamento effettuato entro 60 giorni dalla fine del trimestre</strong> di riferimento. Questa modalità garantisce una <strong>gestione trasparente e regolare</strong> delle transazioni.</p>
</article>

<article class="faq-item">
<h3 class="faq-item__question">C'è rischio di morosità?</h3>
<p class="faq-item__answer">L'<strong>ospite paga l'intero importo del soggiorno prima del check-in</strong>. Perciò, il <strong>rischio di morosità è nullo</strong>.</p>
</article>

<article class="faq-item">
<h3 class="faq-item__question">Chi gestisce la burocrazia?</h3>
<p class="faq-item__answer">Il <strong>processo burocratico è gestito da TreeHouse Italia</strong>. L'appartamento non viene pubblicato online fino a che non siano completati tutti gli adempimenti. Iniziamo questa fase subito dopo la firma del contratto di gestione.</p>
</article>

<article class="faq-item">
<h3 class="faq-item__question">Come vengono gestite le foto del mio immobile?</h3>
<p class="faq-item__answer">Offriamo un <strong>servizio fotografico professionale</strong> per il tuo immobile, creando un <strong>profilo online curato e conforme ai più alti standard del settore</strong>.</p>
</article>

<article class="faq-item">
<h3 class="faq-item__question">Come funziona la tassazione?</h3>
<p class="faq-item__answer">Durante la nostra collaborazione, agendo in rappresentanza del proprietario, <strong>paghiamo per nome e conto suo la cedolare secca</strong>. Se il proprietario è una <strong>persona fisica, può scegliere</strong> tra la <strong>cedolare secca</strong> (21%) o il <strong>regime ordinario</strong> (progressivo). Se è una società, si applicano le norme fiscali del reddito d'impresa.</p>
</article>

<article class="faq-item">
<h3 class="faq-item__question">Come monitoro le prenotazioni?</h3>
<p class="faq-item__answer">Puoi <strong>monitorare in tempo reale le occupazioni</strong> e verificare quando la tua proprietà è libera. Con il nostro sistema, uniamo la <strong>massima trasparenza alla flessibilità</strong>, permettendoti di <strong>ottimizzare l'uso della tua proprietà</strong> in base alle tue esigenze.</p>
</article>
</div>
</section>

<!-- CTA Finale -->
<section class="owners-cta">
<div class="owners-cta__content">
<h2 class="owners-cta__title">Fai il Primo Passo per Far Rendere di Più il Tuo Immobile</h2>
<p class="owners-cta__text">Richiedi ora senza impegno una <strong>valutazione gratuita</strong> e ti forniremo una proiezione accurata dei guadagni futuri.</p>
<div class="owners-cta__actions">
<a class="btn btn--large btn--primary" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">Richiedi una valutazione gratuita</a>
<a class="btn btn--large btn--ghost" href="{{ route('about', ['locale' => app()->getLocale()]) }}">Scopri chi siamo</a>
</div>
</div>
</section>
@endsection
