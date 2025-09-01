<?php

return [
    'name' => 'TechPlanner',
    'description' => 'Gestione e pianificazione tecnica degli eventi',

    'guard' => [
        'web' => 'web',
        'api' => 'api',
    ],

    'icon' => 'heroicon-o-globe-europe-africa',

    'navigation' => [
        'group' => 'Gestione',
        'label' => 'Tech Planner',
        'icon' => 'techplanner-animated',
        'sort' => 75, // Nel gruppo Gestione (70-89)
    ],

    'routes' => [
        'web' => [
            'prefix' => 'techplanner',
            'middleware' => ['web', 'auth'],
            'namespace' => 'Modules\TechPlanner\Http\Controllers',
        ],
        'api' => [
            'prefix' => 'api/techplanner',
            'middleware' => ['api', 'auth:sanctum'],
            'namespace' => 'Modules\TechPlanner\Http\Controllers\Api',
        ],
    ],

    'providers' => [
        /*
         * Package Service Providers...
         */
        Modules\TechPlanner\Providers\TechPlannerServiceProvider::class,
        Modules\TechPlanner\Providers\RouteServiceProvider::class,
        Modules\TechPlanner\Providers\EventServiceProvider::class,
    ],

    'permissions' => [
        'groups' => [
            'techplanner' => [
                'label' => 'Tech Planner',
                'description' => 'Gestione pianificazione tecnica',
            ],
        ],
        'abilities' => [
            'techplanner.view' => [
                'label' => 'Visualizza',
                'description' => 'Può visualizzare la pianificazione tecnica',
                'group' => 'techplanner',
            ],
            'techplanner.manage' => [
                'label' => 'Gestisci',
                'description' => 'Può gestire la pianificazione tecnica',
                'group' => 'techplanner',
            ],
            'techplanner.create' => [
                'label' => 'Crea',
                'description' => 'Può creare nuove pianificazioni',
                'group' => 'techplanner',
            ],
            'techplanner.edit' => [
                'label' => 'Modifica',
                'description' => 'Può modificare le pianificazioni esistenti',
                'group' => 'techplanner',
            ],
            'techplanner.delete' => [
                'label' => 'Elimina',
                'description' => 'Può eliminare le pianificazioni',
                'group' => 'techplanner',
            ],
        ],
    ],

    'settings' => [
        'cache' => [
            'enabled' => true,
            'ttl' => 3600, // 1 ora
            'prefix' => 'techplanner_',
        ],
        'notifications' => [
            'enabled' => true,
            'channels' => ['mail', 'database'],
        ],
        'export' => [
            'formats' => ['pdf', 'xlsx', 'csv'],
            'default' => 'pdf',
        ],
    ],

    'features' => [
        'scheduling' => [
            'enabled' => true,
            'default_view' => 'week', // week, month, timeline
            'min_interval' => 30, // minuti
        ],
        'resources' => [
            'enabled' => true,
            'categories' => ['equipment', 'staff', 'venues'],
        ],
        'budgeting' => [
            'enabled' => true,
            'currency' => 'EUR',
            'vat' => 22,
        ],
    ],
];
