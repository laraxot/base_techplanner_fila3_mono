<?php

return [
    'servers' => [
        'filesystem' => [
            'driver' => 'local',
            'root' => storage_path('app/mcp'),
            'visibility' => 'private',
        ],
        'memory' => [
            'driver' => 'redis',
            'connection' => 'mcp',
            'prefix' => 'mcp:',
            'ttl' => 3600,
        ],
        'fetch' => [
            'timeout' => 30,
            'retry' => 3,
            'retry_delay' => 1000,
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => 'MCP/1.0',
            ],
        ],
    ],

    'contexts' => [
        'path' => __DIR__.'/../contexts',
        'cache' => true,
        'cache_ttl' => 3600,
    ],

    'validation' => [
        'strict' => true,
        'auto_fix' => false,
        'report_violations' => true,
    ],

    'monitoring' => [
        'enabled' => true,
        'metrics' => [
            'context_validations' => true,
            'server_performance' => true,
            'violation_tracking' => true,
        ],
        'dashboard' => [
            'enabled' => true,
            'path' => '/mcp/dashboard',
            'middleware' => ['auth', 'admin'],
        ],
    ],
];
