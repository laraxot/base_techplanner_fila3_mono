<?php

declare(strict_types=1);

return [
    'fields' => [
        'center_latitude' => [
            'label' => 'Latitudine centro',
            'placeholder' => 'Inserisci la latitudine del centro',
            'help' => 'Latitudine del centro della mappa',
        ],
        'center_longitude' => [
            'label' => 'Longitudine centro',
            'placeholder' => 'Inserisci la longitudine del centro',
            'help' => 'Longitudine del centro della mappa',
        ],
        'zoom_level' => [
            'label' => 'Livello zoom',
            'placeholder' => 'Seleziona il livello di zoom',
            'help' => 'Livello di zoom della mappa',
        ],
        'map_type' => [
            'label' => 'Tipo mappa',
            'placeholder' => 'Seleziona il tipo di mappa',
            'help' => 'Tipo di visualizzazione della mappa',
        ],
        'show_controls' => [
            'label' => 'Mostra controlli',
            'help' => 'Mostra i controlli di navigazione della mappa',
        ],
        'show_markers' => [
            'label' => 'Mostra marcatori',
            'help' => 'Mostra i marcatori sulla mappa',
        ],
        'show_info_windows' => [
            'label' => 'Mostra finestre info',
            'help' => 'Mostra le finestre informative sui marcatori',
        ],
    ],
    'validation' => [
        'center_latitude_required' => 'La latitudine del centro è obbligatoria',
        'center_longitude_required' => 'La longitudine del centro è obbligatoria',
        'zoom_level_required' => 'Il livello di zoom è obbligatorio',
        'map_type_required' => 'Il tipo di mappa è obbligatorio',
        'coordinates_invalid' => 'Le coordinate geografiche non sono valide',
    ],
    'messages' => [
        'map_created' => 'Mappa creata con successo',
        'map_updated' => 'Mappa aggiornata con successo',
        'map_deleted' => 'Mappa eliminata con successo',
        'marker_added' => 'Marcatore aggiunto con successo',
        'marker_updated' => 'Marcatore aggiornato con successo',
        'marker_deleted' => 'Marcatore eliminato con successo',
        'route_calculated' => 'Percorso calcolato con successo',
        'route_calculation_failed' => 'Impossibile calcolare il percorso',
    ],
    'map_types' => [
        'roadmap' => 'Mappa stradale',
        'satellite' => 'Satellite',
        'hybrid' => 'Ibrida',
        'terrain' => 'Terreno',
    ],
    'controls' => [
        'zoom' => 'Zoom',
        'pan' => 'Pan',
        'streetview' => 'Street View',
        'fullscreen' => 'Schermo intero',
        'scale' => 'Scala',
        'overview' => 'Panoramica',
    ],
];
