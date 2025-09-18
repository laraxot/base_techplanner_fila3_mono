<?php

declare(strict_types=1);

use Modules\Tenant\Services\TenantService;

return [
    'default' => env('ORBIT_DEFAULT_DRIVER', 'md'),

    'drivers' => [
        'md' => Orbit\Drivers\Markdown::class,
        'json' => Orbit\Drivers\Json::class,
        'yaml' => Orbit\Drivers\Yaml::class,
    ],

    'paths' => [
        'content' => TenantService::filePath('database/content'),
        'cache' => TenantService::filePath(''),
    ],
];
