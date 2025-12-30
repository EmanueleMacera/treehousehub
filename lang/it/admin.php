<?php

return [
    'nav' => [
        'back_public' => 'Torna al sito',
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
            'external_url' => 'URL sito ufficiale',
            'description_short' => 'Descrizione breve',
            'description_long' => 'Descrizione estesa',
            'active' => 'Attiva',
            'order' => 'Ordine',
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
            'price' => 'Prezzo',
            'description_short' => 'Descrizione breve',
            'description_long' => 'Descrizione estesa',
            'active' => 'Attivo',
            'order' => 'Ordine',
        ],
    ],
];
