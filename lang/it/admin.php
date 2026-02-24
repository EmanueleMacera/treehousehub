<?php

return [
    'nav' => [
        'back_public' => 'Torna al sito',
        'dashboard' => 'Dashboard',
        'about' => 'Chi siamo',
        'owners' => 'Diventa proprietario',
        'structures' => 'Strutture',
        'sales' => 'Vendite',
        'logout' => 'Logout',
    ],
    'flash' => [
        'saved' => 'Salvato correttamente.',
        'deleted' => 'Eliminato correttamente.',
    ],
    'actions' => [
        'save' => 'Salva',
        'edit' => 'Modifica',
        'delete' => 'Elimina',
        'confirm_delete' => 'Confermi eliminazione?',
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
        'index_title' => 'Strutture',
        'create_title' => 'Nuova struttura',
        'edit_title' => 'Modifica struttura: :name',
        'actions' => [
            'create' => 'Crea struttura',
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
        'ok' => 'OK',
        'ko' => 'KO',
        'stats' => [
            'structures_total' => 'Strutture totali',
            'structures_active' => 'Strutture attive',
            'sales_total' => 'Immobili in vendita totali',
            'admins_total' => 'Amministratori',
        ],
        'health' => [
            'title' => 'Salute sistema',
            'database' => 'Connessione database',
            'storage_public_writable' => 'Storage pubblico scrivibile',
            'app_key_set' => 'APP_KEY configurata',
        ],
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
            'description_short' => 'Descrizione breve',
            'description_long' => 'Descrizione estesa',
            'active' => 'Attivo',
            'order' => 'Ordine',
        ],
    ],
];
