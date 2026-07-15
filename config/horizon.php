<?php

return [
    'domain' => null,
    'path' => 'horizon',
    'use' => 'default',
    'prefix' => env('HORIZON_PREFIX', 'horizon:'),
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
    'notifications' => ['email' => env('HORIZON_EMAIL')],
    'metrics' => [
        'trim' => [
            'recent' => 60,
            'snapshots' => ['5' => 60, '10' => 60, '15' => 60, '30' => 60, '60' => 60],
        ],
    ],
    'fast_termination' => false,
    'memory_limit' => 64,
    'supervisors' => [
        [
            'name' => 'supervisor-1',
            'connection' => 'redis',
            'queue' => ['default'],
            'balance' => 'simple',
            'minProcesses' => 1,
            'maxProcesses' => 2,
            'tries' => 3,
            'backoff' => 60,
            'maxTime' => 3600,
            'maxJobs' => 500,
            'memory' => 64,
            'nice' => 0,
        ],
    ],
];
