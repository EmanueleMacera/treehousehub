<?php

return [
    'nav' => [
        'back_public' => 'Back to website',
        'dashboard' => 'Dashboard',
        'about' => 'About',
        'owners' => 'Become an owner',
        'structures' => 'Rentals',
        'sales' => 'Sales',
        'categories' => 'Categories',
        'logout' => 'Logout',
    ],
    'flash' => [
        'saved' => 'Saved successfully.',
        'deleted' => 'Deleted successfully.',
    ],
    'actions' => [
        'save' => 'Save',
        'cancel' => 'Cancel',
        'back' => 'Back to list',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'confirm_delete' => 'Confirm deletion?',
    ],
    'validation' => [
        'check_fields' => 'Check the highlighted fields before saving.',
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
        'index_title' => 'Rentals',
        'create_title' => 'New rental',
        'edit_title' => 'Edit rental: :name',
        'actions' => [
            'create' => 'Create rental',
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
        'subtitle' => 'A quick overview of rentals, sales and website status.',
        'ok' => 'OK',
        'ko' => 'KO',
        'stats' => [
            'structures_total' => 'Total structures',
            'structures_active' => 'Active structures',
            'sales_total' => 'Total sale properties',
            'sales_active' => 'Active sale properties',
            'admins_total' => 'Administrators',
        ],
        'health' => [
            'title' => 'System health',
            'database' => 'Database connection',
            'storage_public_writable' => 'Public storage writable',
            'app_key_set' => 'APP_KEY configured',
        ],
        'quick_actions' => 'Quick actions',
        'latest_structures' => 'Recently updated structures',
        'latest_sales' => 'Recently updated sales',
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
            'property_type' => 'Property type',
            'rooms' => 'Rooms',
            'bathrooms' => 'Bathrooms',
            'surface' => 'Commercial sqm',
            'energy_class' => 'Energy class',
            'condition' => 'Condition',
            'description_short' => 'Short description',
            'description_long' => 'Long description',
            'active' => 'Active',
            'order' => 'Order',
        ],
    ],
];
