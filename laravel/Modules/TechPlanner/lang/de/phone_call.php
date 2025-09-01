<?php

declare(strict_types=1);

return [
    'navigation' => [
        'label' => 'Telefonanrufe',
        'group' => 'TechPlanner',
        'icon' => 'heroicon-o-phone',
        'sort' => 2,
    ],
    'resource' => [
        'label' => 'Telefonanruf',
        'plural_label' => 'Telefonanrufe',
        'navigation_group' => 'TechPlanner',
        'navigation_icon' => 'heroicon-o-phone',
        'navigation_sort' => 2,
        'description' => 'Verwaltung von Telefonanrufen',
    ],
    'enums' => [
        'inbound' => [
            'label' => 'Eingehend',
            'color' => 'success',
            'icon' => 'heroicon-o-arrow-down',
        ],
        'outbound' => [
            'label' => 'Ausgehend',
            'color' => 'warning',
            'icon' => 'heroicon-o-arrow-up',
        ],
        'missed' => [
            'label' => 'Verpasst',
            'color' => 'danger',
            'icon' => 'heroicon-o-x-circle',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Neuer Anruf',
            'icon' => 'heroicon-o-plus',
            'color' => 'primary',
            'tooltip' => 'Neuen Telefonanruf aufzeichnen',
        ],
        'edit' => [
            'label' => 'Anruf bearbeiten',
            'icon' => 'heroicon-o-pencil',
            'color' => 'warning',
            'tooltip' => 'Ausgewählten Anruf bearbeiten',
        ],
        'delete' => [
            'label' => 'Anruf löschen',
            'icon' => 'heroicon-o-trash',
            'color' => 'danger',
            'tooltip' => 'Ausgewählten Anruf löschen',
        ],
        'view' => [
            'label' => 'Anruf anzeigen',
            'icon' => 'heroicon-o-eye',
            'color' => 'info',
            'tooltip' => 'Anrufdetails anzeigen',
        ],
        'import' => [
            'label' => 'Anrufe importieren',
            'icon' => 'heroicon-o-arrow-up-tray',
            'color' => 'secondary',
            'tooltip' => 'Anrufe aus externer Datei importieren',
        ],
    ],
    'fields' => [
        'client_id' => [
            'label' => 'Kunde',
            'placeholder' => 'Kunde auswählen',
            'help' => 'Der Kunde, mit dem der Anruf geführt wurde',
        ],
        'date' => [
            'label' => 'Datum',
            'placeholder' => 'Datum auswählen',
            'help' => 'Datum des Anrufs',
        ],
        'duration' => [
            'label' => 'Dauer',
            'placeholder' => 'Dauer in Minuten eingeben',
            'help' => 'Dauer des Anrufs in Minuten',
        ],
        'notes' => [
            'label' => 'Notizen',
            'placeholder' => 'Anrufnotizen eingeben',
            'help' => 'Notizen und Details zum Anruf',
        ],
        'call_type' => [
            'label' => 'Anruftyp',
            'placeholder' => 'Typ auswählen',
            'help' => 'Art des geführten Anrufs',
            'options' => [
                'inbound' => 'Eingehend',
                'outbound' => 'Ausgehend',
                'missed' => 'Verpasst',
            ],
        ],
        'id' => [
            'label' => 'ID',
            'help' => 'Eindeutiger Bezeichner des Anrufs',
        ],
    ],
    'filters' => [
        'client' => [
            'label' => 'Kunde',
            'placeholder' => 'Kunde auswählen',
            'help' => 'Nach spezifischem Kunden filtern',
        ],
        'call_type' => [
            'label' => 'Anruftyp',
            'placeholder' => 'Typ auswählen',
            'help' => 'Nach Anruftyp filtern',
        ],
        'date_range' => [
            'label' => 'Zeitraum',
            'from_date' => 'Von Datum',
            'to_date' => 'Bis Datum',
            'help' => 'Interessanten Zeitraum auswählen',
        ],
    ],
    'messages' => [
        'created' => 'Anruf erfolgreich aufgezeichnet',
        'updated' => 'Anruf erfolgreich aktualisiert',
        'deleted' => 'Anruf erfolgreich gelöscht',
        'imported' => 'Anrufe erfolgreich importiert',
    ],
];

