<?php

return [
    'nav' => [
        'back_public' => 'Torna al sito',
        'dashboard' => 'Dashboard',
        'about' => 'Chi siamo',
        'owners' => 'Diventa proprietario',
        'structures' => 'Affitti',
        'sales' => 'Vendite',
        'categories' => 'Categorie',
        'logout' => 'Logout',
    ],
    'flash' => [
        'saved' => 'Salvato correttamente.',
        'deleted' => 'Eliminato correttamente.',
    ],
    'actions' => [
        'save' => 'Salva',
        'cancel' => 'Annulla',
        'back' => 'Torna all\'elenco',
        'edit' => 'Modifica',
        'delete' => 'Elimina',
        'confirm_delete' => 'Confermi eliminazione?',
    ],
    'validation' => [
        'check_fields' => 'Controlla i campi evidenziati prima di salvare.',
    ],
    'pages' => [
        'edit_title' => 'Modifica: :title',
        'fields' => [
            'title' => 'Titolo',
            'content' => 'Contenuto (HTML consentito)',
        ],
        'actions' => [
            'save' => 'Salva',
        ],
    ],
    'structures' => [
        'index_title' => 'Affitti',
        'create_title' => 'Nuovo affitto',
        'edit_title' => 'Modifica affitto: :name',
        'actions' => [
            'create' => 'Crea affitto',
        ],
        'fields' => [
            'name' => 'Nome',
            'slug' => 'Slug',
            'location' => 'Località',
            'address' => 'Indirizzo',
            'external_url' => 'URL sito ufficiale',
            'image' => 'Foto struttura',
            'remove_image' => 'Rimuovi foto corrente',
            'description_short' => 'Descrizione breve',
            'description_long' => 'Descrizione estesa',
            'active' => 'Attiva',
            'order' => 'Ordine',
        ],
    ],

    'dashboard' => [
        'title' => 'Dashboard amministrazione',
        'subtitle' => 'Panoramica rapida di affitti, vendite e stato del sito.',
        'ok' => 'OK',
        'ko' => 'KO',
        'stats' => [
            'structures_total' => 'Affitti totali',
            'structures_active' => 'Affitti attivi',
            'sales_total' => 'Immobili in vendita totali',
            'sales_active' => 'Immobili in vendita attivi',
            'admins_total' => 'Amministratori',
        ],
        'health' => [
            'title' => 'Salute sistema',
            'database' => 'Connessione database',
            'storage_public_writable' => 'Storage pubblico scrivibile',
            'app_key_set' => 'APP_KEY configurata',
        ],
        'quick_actions' => 'Azioni rapide',
        'latest_structures' => 'Ultime strutture aggiornate',
        'latest_sales' => 'Ultime vendite aggiornate',
    ],
    'sales' => [
        'index_title' => 'Vendite',
        'create_title' => 'Nuovo immobile',
        'edit_title' => 'Modifica immobile: :title',
        'actions' => [
            'create' => 'Crea immobile',
        ],
        'fields' => [
            'title' => 'Titolo',
            'slug' => 'Slug',
            'location' => 'Località',
            'address' => 'Indirizzo',
            'price' => 'Prezzo',
            'property_type' => 'Tipologia',
            'rooms' => 'Locali',
            'bathrooms' => 'Bagni',
            'surface' => 'Mq commerciali',
            'energy_class' => 'Classe energetica',
            'condition' => 'Stato',
            'description_short' => 'Descrizione breve',
            'description_long' => 'Descrizione estesa',
            'active' => 'Attivo',
            'order' => 'Ordine',
        ],
    ],
];
