<?php

declare(strict_types=1);

return [
    'navigation' => [
        'label' => 'Rechtsanwaltskanzlei',
        'group' => 'TechPlanner',
        'icon' => 'heroicon-o-building-office',
        'sort' => 9,
    ],

    'resource' => [
        'label' => 'Rechtsanwaltskanzlei',
        'plural_label' => 'Rechtsanwaltskanzleien',
        'navigation_group' => 'TechPlanner',
        'navigation_icon' => 'heroicon-o-building-office',
        'navigation_sort' => 9,
        'description' => 'Verwaltung der Rechtsanwaltskanzleien',
    ],

    'actions' => [
        'create' => [
            'label' => 'Neue Kanzlei',
            'icon' => 'heroicon-o-plus',
            'color' => 'primary',
            'tooltip' => 'Eine neue Rechtsanwaltskanzlei erstellen',
        ],
        'edit' => [
            'label' => 'Bearbeiten',
            'icon' => 'heroicon-o-pencil',
            'color' => 'warning',
            'tooltip' => 'Kanzlei bearbeiten',
        ],
        'delete' => [
            'label' => 'Löschen',
            'icon' => 'heroicon-o-trash',
            'color' => 'danger',
            'tooltip' => 'Kanzlei löschen',
        ],
        'view' => [
            'label' => 'Anzeigen',
            'icon' => 'heroicon-o-eye',
            'color' => 'info',
            'tooltip' => 'Kanzlei anzeigen',
        ],
    ],

    'fields' => [
        'name' => [
            'label' => 'Kanzleiename',
            'placeholder' => 'Namen der Kanzlei eingeben',
            'help' => 'Vollständiger Name der Rechtsanwaltskanzlei',
        ],
        'address' => [
            'label' => 'Adresse',
            'placeholder' => 'Vollständige Adresse eingeben',
            'help' => 'Vollständige Adresse der Kanzlei',
        ],
        'phone' => [
            'label' => 'Telefon',
            'placeholder' => 'Telefonnummer eingeben',
            'help' => 'Haupttelefonnummer',
        ],
        'email' => [
            'label' => 'E-Mail',
            'placeholder' => 'E-Mail-Adresse eingeben',
            'help' => 'Haupt-E-Mail-Adresse der Kanzlei',
        ],
        'website' => [
            'label' => 'Website',
            'placeholder' => 'Website-URL eingeben',
            'help' => 'Website-URL der Kanzlei',
        ],
        'vat_number' => [
            'label' => 'USt-IdNr.',
            'placeholder' => 'USt-IdNr. eingeben',
            'help' => 'Umsatzsteuer-Identifikationsnummer der Kanzlei',
        ],
        'fiscal_code' => [
            'label' => 'Steuernummer',
            'placeholder' => 'Steuernummer eingeben',
            'help' => 'Steuernummer der Kanzlei',
        ],
        'is_active' => [
            'label' => 'Aktiv',
            'help' => 'Ob die Kanzlei aktiv ist',
        ],
    ],

    'filters' => [
        'is_active' => [
            'label' => 'Status',
            'options' => [
                'active' => 'Aktiv',
                'inactive' => 'Inaktiv',
            ],
        ],
        'city' => [
            'label' => 'Stadt',
            'placeholder' => 'Stadt auswählen',
        ],
    ],

    'messages' => [
        'created' => 'Kanzlei erfolgreich erstellt',
        'updated' => 'Kanzlei erfolgreich aktualisiert',
        'deleted' => 'Kanzlei erfolgreich gelöscht',
        'not_found' => 'Kanzlei nicht gefunden',
        'validation_error' => 'Validierungsfehler bei der Eingabe',
    ],
];
