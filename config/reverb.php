<?php

return [
    'default' => env('REVERB_SERVER', 'reverb'),
    'servers' => [
        'reverb' => [
            'host' => env('REVERB_HOST', '0.0.0.0'),
            'port' => (int) env('REVERB_PORT', 8080),
            'hostname' => env('REVERB_HOSTNAME', 'localhost'),
            'options' => [
                'tls' => [],
            ],
            'max_request_size' => 10_000,
            'scaling' => [
                'enabled' => false,
                'channel' => env('REVERB_SCALING_CHANNEL', 'reverb'),
                'server' => [
                    'url' => env('REVERB_SCALING_SERVER_URL'),
                ],
            ],
        ],
    ],
    'apps' => [
        [
            'key' => env('REVERB_APP_KEY'),
            'secret' => env('REVERB_APP_SECRET'),
            'app_id' => env('REVERB_APP_ID'),
            'options' => [
                'host' => env('REVERB_HOST'),
                'port' => env('REVERB_PORT', 8080),
                'scheme' => env('REVERB_SCHEME', 'http'),
                'useTLS' => env('REVERB_SCHEME', 'http') === 'https',
            ],
            'allowed_origins' => ['*'],
            'ping_interval' => 60,
            'activity_timeout' => 120,
        ],
    ],
];
