<?php

return [
    'meta' => [
        'title' => 'Contattaci - TreeHouse Italia',
        'description' => 'Contatta TreeHouse Italia per informazioni su affitti brevi, vendite immobiliari o gestione proprieta. Telefono: +39 019 8387211 | Email: info@treehouseitalia.it',
    ],
    'hero' => [
        'kicker' => 'Parliamone',
        'title' => 'Contattaci',
        'subtitle' => 'Hai domande sui nostri servizi? Vuoi una valutazione gratuita del tuo immobile? Il nostro team e pronto ad aiutarti.',
    ],
    'info' => [
        'blocks' => [
            ['type' => 'phone', 'icon' => '+', 'title' => 'Telefono', 'note' => 'Lun-Ven 9:00-18:00'],
            ['type' => 'email', 'icon' => '+', 'title' => 'Email', 'note' => 'Ti risponderemo entro 24h'],
            ['type' => 'address', 'icon' => '+', 'title' => 'Sede Legale', 'text' => 'Via Agostino Chiodo 6<br>17100 Savona (SV)<br>Italia'],
            ['type' => 'company', 'icon' => '+', 'title' => 'Dati Aziendali', 'lines' => ['TreeHouse Italia Srl', 'P.IVA: IT01581160098']],
        ],
    ],
    'form' => [
        'title' => 'Invia un Messaggio',
        'subtitle' => 'Compila il form e ti contatteremo al piu presto',
        'name' => 'Nome e Cognome',
        'email' => 'Email',
        'phone' => 'Telefono',
        'subject' => 'Oggetto',
        'subject_placeholder' => 'Seleziona un\'opzione...',
        'subject_options' => [
            'valutazione' => 'Valutazione immobile',
            'affitto' => 'Affitto breve - Proprietario',
            'prenotazione' => 'Prenotazione struttura',
            'vendita' => 'Vendita immobile',
            'informazioni' => 'Informazioni generali',
            'altro' => 'Altro',
        ],
        'message' => 'Messaggio',
        'privacy' => 'Accetto la <a href=":url" class="form-link">privacy policy</a> e acconsento al trattamento dei miei dati personali *',
        'submit' => 'Invia Messaggio',
    ],
    'flash' => [
        'sent' => 'Messaggio inviato correttamente.',
    ],
    'faq' => [
        'title' => 'Domande Frequenti',
        'subtitle' => 'Le risposte alle domande piu comuni',
        'items' => [
            ['question' => 'Come funziona la valutazione gratuita?', 'answer' => 'Contattaci per fissare un sopralluogo gratuito. I nostri esperti valuteranno il tuo immobile e ti forniremo una proiezione accurata dei potenziali guadagni da affitti brevi.'],
            ['question' => 'Quanto tempo ci vuole per una risposta?', 'answer' => 'Il nostro team risponde entro 24 ore lavorative a tutte le richieste via email o form. Per urgenze, chiamaci direttamente al numero +39 019 8387211.'],
            ['question' => 'Posso visitare la vostra sede?', 'answer' => 'Certamente! La nostra sede e a Savona in Via Agostino Chiodo 6. Ti consigliamo di contattarci prima per fissare un appuntamento e garantirti la disponibilita di un consulente.'],
        ],
    ],
    'cta' => [
        'title' => 'Preferisci Parlare Direttamente?',
        'text' => 'Il nostro team e a disposizione per rispondere a tutte le tue domande',
        'call' => 'Chiamaci Ora',
        'owners' => 'Info Proprietari',
    ],
];
