<?php

return [
    'nav' => [
        'back_public' => 'Back to website',
        'dashboard' => 'Dashboard',
        'about' => 'About',
        'owners' => 'Become an owner',
        'structures' => 'Structures',
        'sales' => 'Sales',
        'logout' => 'Logout',
    ],
    'flash' => [
        'saved' => 'Saved successfully.',
        'deleted' => 'Deleted successfully.',
    ],
    'actions' => [
        'save' => 'Save',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'confirm_delete' => 'Confirm deletion?',
    ],
    'pages' => [
        'edit_title' => 'Edit: :title',
        'fields' => [
            'title' => 'Title',
            'content' => 'Content (HTML allowed)',
        ],
        'actions' => [
            'save' => 'Save',
        ],
    ],
    'structures' => [
        'index_title' => 'Structures',
        'create_title' => 'New structure',
        'edit_title' => 'Edit structure: :name',
        'actions' => [
            'create' => 'Create structure',
        ],
        'fields' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'location' => 'Location',
            'address' => 'Address',
            'external_url' => 'Official website URL',
            'image' => 'Structure photo',
            'remove_image' => 'Remove current photo',
            'description_short' => 'Short description',
            'description_long' => 'Long description',
            'active' => 'Active',
            'order' => 'Order',
        ],
    ],

    'dashboard' => [
        'title' => 'Admin dashboard',
        'ok' => 'OK',
        'ko' => 'KO',
        'stats' => [
            'structures_total' => 'Total structures',
            'structures_active' => 'Active structures',
            'sales_total' => 'Total sale properties',
            'admins_total' => 'Administrators',
        ],
        'health' => [
            'title' => 'System health',
            'database' => 'Database connection',
            'storage_public_writable' => 'Public storage writable',
            'app_key_set' => 'APP_KEY configured',
        ],
    ],
    'sales' => [
        'index_title' => 'Sales',
        'create_title' => 'New property',
        'edit_title' => 'Edit property: :title',
        'actions' => [
            'create' => 'Create property',
        ],
        'fields' => [
            'title' => 'Title',
            'slug' => 'Slug',
            'location' => 'Location',
            'address' => 'Address',
            'price' => 'Price',
            'description_short' => 'Short description',
            'description_long' => 'Long description',
            'active' => 'Active',
            'order' => 'Order',
        ],
    ],
];
