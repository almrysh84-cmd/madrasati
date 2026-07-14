<?php

// Scribe API Documentation config
// After installing: composer require knuckleswtf/scribe
// Run: php artisan scribe:generate

return [
    'theme' => 'default',
    'title' => 'مدرستي API',
    'description' => 'RESTful API لنظام إدارة المدارس مدرستي',

    'routes' => [
        [
            'match' => ['prefixes' => ['api/v1']],
            'include' => [],
        ],
    ],

    'type' => 'laravel',
    'static' => [
        'output_path' => 'docs/api',
    ],

    'languages' => ['ar'],
    'example_languages' => ['json'],

    'ask_auth_for_details' => true,
    'auth' => [
        'enabled' => true,
        'default' => true,
        'in' => 'bearer',
        'name' => 'API Token',
        'use_value' => env('SCRIBE_AUTH_KEY'),
        'placeholder' => '{YOUR_API_TOKEN}',
    ],
];
