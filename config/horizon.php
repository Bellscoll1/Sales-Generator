<?php

return [
    'domain' => env('HORIZON_DOMAIN'),
    'path' => env('HORIZON_PATH', 'horizon'),
    'use' => 'default',
    'prefix' => env('HORIZON_PREFIX', 'leadconnect_horizon:'),
    'middleware' => ['web'],
    'waits' => ['redis:default' => 60],
    'trim' => [
        'recent' => 60,
        'pending' => 60,
        'completed' => 60,
        'recent_failed' => 10080,
        'failed' => 10080,
        'monitored' => 10080,
    ],
    'environments' => [
        'production' => [
            'supervisor-high' => [
                'connection' => 'redis',
                'queue' => ['high'],
                'balance' => 'auto',
                'maxProcesses' => 10,
                'tries' => 3,
            ],
            'supervisor-default' => [
                'connection' => 'redis',
                'queue' => ['default'],
                'balance' => 'auto',
                'maxProcesses' => 10,
                'tries' => 3,
            ],
            'supervisor-low' => [
                'connection' => 'redis',
                'queue' => ['low'],
                'balance' => 'auto',
                'maxProcesses' => 4,
                'tries' => 1,
            ],
        ],
        'local' => [
            'supervisor-default' => [
                'connection' => 'redis',
                'queue' => ['high', 'default', 'low'],
                'balance' => 'auto',
                'maxProcesses' => 3,
                'tries' => 1,
            ],
        ],
    ],
];
