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
                <p class="hero-main__kicker">Hospitality & Real Estate</p>
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

<section class="home-modern">
    <div class="hm-metrics">
        <article class="hm-metric-card">
            <span class="hm-metric-value">30+ anni</span>
            <p>Esperienza nel settore immobiliare e hospitality.</p>
        </article>
        <article class="hm-metric-card">
            <span class="hm-metric-value">4 destinazioni</span>
            <p>Location iconiche tra Liguria e Piemonte.</p>
        </article>
        <article class="hm-metric-card">
            <span class="hm-metric-value">End-to-end</span>
            <p>Gestione completa: check-in, pulizie, manutenzione e fiscalità.</p>
        </article>
        <article class="hm-metric-card">
            <span class="hm-metric-value">100% protetti</span>
            <p>Ogni soggiorno coperto da garanzia assicurativa.</p>
        </article>
    </div>

    <section class="hm-section">
        <header class="hm-section-head">
            <h2>Cosa Cerchi?</h2>
            <p>Tre percorsi chiari per guidarti subito verso ciò che ti serve.</p>
        </header>

        <div class="hm-offers-grid">
            <article class="hm-offer-card">
                <h3>Affitti Turistici</h3>
                <p>Scopri le nostre <strong>strutture ricettive curate</strong>: dal primo albergo diffuso della Liguria ai resort sul mare.</p>
                <ul>
                    <li>Colletta di Castelbianco</li>
                    <li>Dominio Mare Bergeggi</li>
                    <li>Borgo Fantino Limone Piemonte</li>
                    <li>Castello Borelli Borghetto</li>
                </ul>
                <a class="btn btn--primary" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Esplora le strutture</a>
            </article>

            <article class="hm-offer-card">
                <h3>Immobili in Vendita</h3>
                <p>Immobili di <strong>prestigio in contesti unici</strong>: castelli, ville storiche ed eleganti residenze sulla Riviera Ligure.</p>
                <ul>
                    <li>Scenari storici e paesaggi naturali</li>
                    <li>Materiali sostenibili</li>
                    <li>Project management e direzione lavori</li>
                    <li>Valore duraturo nel tempo</li>
                </ul>
                <a class="btn btn--primary" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Scopri le opportunità</a>
            </article>

            <article class="hm-offer-card hm-offer-card--accent">
                <h3>Diventa Proprietario Partner</h3>
                <p>Affida il tuo immobile: gestiamo <strong>prenotazioni, pulizie, fiscalità e assistenza</strong> con report trimestrali.</p>
                <ul>
                    <li>Analisi preliminare di redditività</li>
                    <li>Valorizzazione immobile</li>
                    <li>Mandato di gestione completo</li>
                    <li>Nessun costo a tuo carico</li>
                </ul>
                <a class="btn btn--outline" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Scopri la partnership</a>
            </article>
        </div>
    </section>

    @if($featuredStructures->count() > 0 || $featuredSales->count() > 0)
        <section class="hm-section hm-featured">
            <header class="hm-section-head">
                <h2>In Primo Piano</h2>
                <p>Una selezione rapida per esplorare subito strutture e immobili disponibili.</p>
            </header>
            <div class="hm-featured-grid">
                <article class="hm-featured-panel">
                    <div class="hm-featured-head">
                        <h3>Strutture Ricettive</h3>
                        <a href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Vedi tutte →</a>
                    </div>
                    @if($featuredStructures->count() > 0)
                        <ul>
                            @foreach($featuredStructures as $s)
                                <li>
                                    <a href="{{ route('rentals.show', ['locale' => app()->getLocale(), 'slug' => $s->slug]) }}">{{ $s->name }}</a>
                                    @if($s->location)<span>{{ $s->location }}</span>@endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Nessuna struttura attiva al momento.</p>
                    @endif
                </article>

                <article class="hm-featured-panel">
                    <div class="hm-featured-head">
                        <h3>Immobili in Vendita</h3>
                        <a href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Vedi tutti →</a>
                    </div>
                    @if($featuredSales->count() > 0)
                        <ul>
                            @foreach($featuredSales as $p)
                                <li>
                                    <a href="{{ route('sales.show', ['locale' => app()->getLocale(), 'slug' => $p->slug]) }}">{{ $p->title }}</a>
                                    @if($p->price)<span>€ {{ number_format($p->price, 0, ',', '.') }}</span>@endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Nessun immobile attivo al momento.</p>
                    @endif
                </article>
            </div>
        </section>
    @endif

    <section class="hm-section hm-process">
        <header class="hm-section-head">
            <h2>Come funziona per i proprietari</h2>
            <p>Un processo semplice e trasparente, dalla prima analisi ai risultati.</p>
        </header>
        <ol>
            <li><strong>Analisi preliminare:</strong> valutiamo redditività e potenziale dell'immobile.</li>
            <li><strong>Valorizzazione:</strong> prepariamo posizionamento, servizi e strategia.</li>
            <li><strong>Gestione operativa:</strong> prenotazioni, check-in/out, pulizie e fiscalità.</li>
            <li><strong>Assicurazione:</strong> copertura inclusa per tutela completa.</li>
            <li><strong>Report trimestrali:</strong> monitoraggio chiaro su occupazione e guadagni.</li>
        </ol>
        <div class="hm-actions">
            <a class="btn btn--large btn--primary" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Richiedi una valutazione gratuita</a>
            <a class="btn btn--large btn--ghost" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">Contattaci</a>
        </div>
    </section>

    <section class="hm-section hm-values">
        <header class="hm-section-head">
            <h2>La Nostra Filosofia</h2>
            <p>Valori concreti che guidano ogni progetto e ogni relazione.</p>
        </header>
        <div class="hm-values-grid">
            <article><h3>Prestigio, Sicurezza e Contesto</h3><p>Qualità duratura e autentico valore nel tempo.</p></article>
            <article><h3>Forma, Funzionalità e Comfort</h3><p>Spazi che coniugano bellezza ed efficienza.</p></article>
            <article><h3>Luce, Colore ed Emozioni</h3><p>Elementi che trasformano gli ambienti in esperienze.</p></article>
            <article><h3>Il Piacere di Abitare</h3><p>Benessere e armonia in ogni dettaglio.</p></article>
        </div>
    </section>
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
