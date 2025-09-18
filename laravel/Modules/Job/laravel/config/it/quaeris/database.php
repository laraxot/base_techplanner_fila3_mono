<?php

declare(strict_types=1);
use Modules\Tenant\Services\TenantService;

return [
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge7'),
            'username' => env('DB_USERNAME', 'forge8'),
            'password' => env('DB_PASSWORD', ''),
            // 'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        'liveuser_general' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            // 'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock',
            'database' => env('DB_DATABASE_USER', 'forge9'),
            'username' => env('DB_USERNAME', 'forge10'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => 'liveuser_',
            'strict' => false,
            'engine' => null,
        ],

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'orbit' => [
            'driver' => 'sqlite',
            'database' => TenantService::filePath('orbit.sqlite'),
            'foreign_key_constraints' => false,
        ],
        'orbit_meta' => [
            'driver' => 'sqlite',
            'database' => storage_path('framework/cache/orbit/orbit_meta.sqlite'),
            'foreign_key_constraints' => false,
        ],
    ], // end connections
];
