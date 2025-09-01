<?php

return [
    'navigation' => [
        'group' => 'techplanner',
        'label' => 'Termine',
        'icon' => 'techplanner-appointment',
        'sort' => 10,
    ],
    'resource' => [
        'label' => 'Termin',
        'plural' => 'Termine',
        'description' => 'Terminverwaltung und technische Planung',
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
            'description' => 'Eindeutige Termin-ID',
        ],
        'client_id' => [
            'label' => 'Kunde',
            'placeholder' => 'Kunde auswählen',
            'help' => 'Der Kunde, für den der Termin geplant ist',
            'description' => 'Mit dem Termin verbundener Kunde',
        ],
        'client' => [
            'label' => 'Kunde',
            'description' => 'Kundeninformationen',
        ],
        'date' => [
            'label' => 'Datum',
            'placeholder' => 'Datum auswählen',
            'help' => 'Termindatum',
            'description' => 'Geplantes Datum für den Termin',
        ],
        'time' => [
            'label' => 'Uhrzeit',
            'placeholder' => 'Uhrzeit auswählen',
            'help' => 'Terminuhrzeit',
            'description' => 'Geplante Uhrzeit für den Termin',
        ],
        'datetime' => [
            'label' => 'Datum und Uhrzeit',
            'description' => 'Vollständiges Datum und Uhrzeit des Termins',
        ],
        'status' => [
            'label' => 'Status',
            'placeholder' => 'Status auswählen',
            'help' => 'Aktueller Terminstatus',
            'description' => 'Terminstatus',
            'options' => [
                'scheduled' => 'Geplant',
                'confirmed' => 'Bestätigt',
                'completed' => 'Abgeschlossen',
                'cancelled' => 'Storniert',
            ],
        ],
        'notes' => [
            'label' => 'Notizen',
            'placeholder' => 'Zusätzliche Notizen eingeben...',
            'help' => 'Zusätzliche Notizen und Details zum Termin',
            'description' => 'Notizen und Kommentare zum Termin',
        ],
        'machines_count' => [
            'label' => 'Anzahl Maschinen',
            'description' => 'Anzahl der mit dem Termin verbundenen Maschinen',
        ],
        'created_at' => [
            'label' => 'Erstellt am',
            'description' => 'Terminerstellungsdatum',
        ],
        'updated_at' => [
            'label' => 'Aktualisiert am',
            'description' => 'Datum der letzten Änderung',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Neuer Termin',
            'description' => 'Einen neuen Termin erstellen',
        ],
        'edit' => [
            'label' => 'Termin bearbeiten',
            'description' => 'Den ausgewählten Termin bearbeiten',
        ],
        'delete' => [
            'label' => 'Termin löschen',
            'description' => 'Den ausgewählten Termin löschen',
        ],
        'confirm' => [
            'label' => 'Termin bestätigen',
            'description' => 'Den ausgewählten Termin bestätigen',
        ],
        'complete' => [
            'label' => 'Termin abschließen',
            'description' => 'Den Termin als abgeschlossen markieren',
        ],
        'cancel' => [
            'label' => 'Termin stornieren',
            'description' => 'Den ausgewählten Termin stornieren',
        ],
        'view' => [
            'label' => 'Termin anzeigen',
            'description' => 'Termindetails anzeigen',
        ],
        'bulk_confirm' => [
            'label' => 'Ausgewählte bestätigen',
            'description' => 'Alle ausgewählten Termine bestätigen',
        ],
        'bulk_complete' => [
            'label' => 'Ausgewählte abschließen',
            'description' => 'Alle ausgewählten Termine als abgeschlossen markieren',
        ],
        'bulk_cancel' => [
            'label' => 'Ausgewählte stornieren',
            'description' => 'Alle ausgewählten Termine stornieren',
        ],
        'export' => [
            'label' => 'Termine exportieren',
            'description' => 'Termine im CSV-Format exportieren',
        ],
    ],
    'filters' => [
        'status' => [
            'label' => 'Status',
            'placeholder' => 'Nach Status filtern',
        ],
        'date_range' => [
            'label' => 'Datumsbereich',
            'placeholder' => 'Datumsbereich auswählen',
        ],
        'client' => [
            'label' => 'Kunde',
            'placeholder' => 'Nach Kunde filtern',
        ],
        'created_date' => [
            'label' => 'Erstellungsdatum',
            'placeholder' => 'Nach Erstellungsdatum filtern',
        ],
    ],
    'pages' => [
        'list' => [
            'title' => 'Termine',
            'description' => 'Terminverwaltung und -anzeige',
        ],
        'create' => [
            'title' => 'Neuer Termin',
            'description' => 'Einen neuen Termin erstellen',
        ],
        'edit' => [
            'title' => 'Termin bearbeiten',
            'description' => 'Den ausgewählten Termin bearbeiten',
        ],
    ],
    'status' => [
        'scheduled' => [
            'label' => 'Geplant',
            'color' => 'warning',
            'description' => 'Termin geplant, aber noch nicht bestätigt',
        ],
        'confirmed' => [
            'label' => 'Bestätigt',
            'color' => 'info',
            'description' => 'Termin bestätigt und bereit',
        ],
        'completed' => [
            'label' => 'Abgeschlossen',
            'color' => 'success',
            'description' => 'Termin erfolgreich abgeschlossen',
        ],
        'cancelled' => [
            'label' => 'Storniert',
            'color' => 'danger',
            'description' => 'Termin storniert',
        ],
    ],
    'messages' => [
        'created' => 'Termin erfolgreich erstellt',
        'updated' => 'Termin erfolgreich aktualisiert',
        'deleted' => 'Termin erfolgreich gelöscht',
        'confirmed' => 'Termin erfolgreich bestätigt',
        'completed' => 'Termin erfolgreich abgeschlossen',
        'cancelled' => 'Termin erfolgreich storniert',
        'bulk_updated' => ':count Termine erfolgreich aktualisiert',
        'bulk_deleted' => ':count Termine erfolgreich gelöscht',
        'bulk_confirmed' => ':count Termine erfolgreich bestätigt',
        'bulk_completed' => ':count Termine erfolgreich abgeschlossen',
        'bulk_cancelled' => ':count Termine erfolgreich storniert',
        'export_success' => 'Termine erfolgreich exportiert',
        'no_appointments' => 'Keine Termine gefunden',
        'no_selected' => 'Keine Termine ausgewählt',
    ],
    'summary' => [
        'total' => 'Gesamte Termine',
        'scheduled' => 'Geplant',
        'confirmed' => 'Bestätigt',
        'completed' => 'Abgeschlossen',
        'cancelled' => 'Storniert',
        'today' => 'Heute',
        'this_week' => 'Diese Woche',
        'this_month' => 'Dieser Monat',
    ],
];
