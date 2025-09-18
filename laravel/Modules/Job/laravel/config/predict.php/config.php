<?php

declare(strict_types=1);

return [
    'name' => 'Predict',
    'icon' => 'heroicon-o-briefcase',
    'navigation_sort' => 1,

    /*
    |--------------------------------------------------------------------------
    | Database Connection
    |--------------------------------------------------------------------------
    |
    | Specifica la connessione al database da utilizzare per questo modulo
    |
    */
    'database' => [
        'connection' => 'predict',
        'prefix' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Event Sourcing
    |--------------------------------------------------------------------------
    |
    | Configurazione per l'event sourcing
    |
    */
    'event_sourcing' => [
        'snapshot_every' => 50,
        'snapshots_table' => 'snapshots',
        'stored_events_table' => 'stored_events',
    ],

    /*
    |--------------------------------------------------------------------------
    | Filament Settings
    |--------------------------------------------------------------------------
    |
    | Configurazioni per l'interfaccia Filament
    |
    */
    'filament' => [
        'should_register_navigation' => true,
        'navigation_sort' => 100,
        'navigation_group' => 'Predict',
    ],
];
