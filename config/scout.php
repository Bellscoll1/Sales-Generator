<?php

return [
    'driver' => env('SCOUT_DRIVER', 'meilisearch'),
    'prefix' => env('SCOUT_PREFIX', ''),
    'queue' => true,
    'after_commit' => true,
    'chunk' => [
        'searchable' => 500,
        'unsearchable' => 500,
    ],
    'soft_delete' => true,
    'meilisearch' => [
        'host' => env('MEILISEARCH_HOST', 'http://127.0.0.1:7700'),
        'key' => env('MEILISEARCH_KEY'),
    ],
];
