<?php

use Modules\Tenant\Services\TenantService;
use Nwidart\Modules\Activators\FileActivator;

return [
    'activators' => [
        'file' => [
            'class' => FileActivator::class,
            'statuses-file' => TenantService::filePath('modules_statuses.json'),
        ],
    ],
];
