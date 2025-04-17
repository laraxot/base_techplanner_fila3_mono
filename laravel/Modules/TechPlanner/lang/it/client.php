<?php

declare(strict_types=1);

return [
    'navigation' => [
        'group' => 'techplanner',
        'label' => 'Clienti',
        'icon' => 'techplanner-client',
        'sort' => 30
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Cliente',
        ],
        'import' => [
            'label' => 'Importa Clienti',
        ],
        'importClient' => [
            'label' => 'Importa Clienti',
        ],
        'populateCoordinates' => [
            'label' => 'Aggiorna Coordinate',
        ],
        'updateCoordinates' => [
            'label' => 'Aggiorna Coordinate',
        ],
        'sortByDistance' => [
            'label' => 'Ordina per Distanza',
        ],
        'downloadExample' => [
            'label' => 'Scarica Esempio',
        ],
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
        ],
        'business_closed' => [
            'label' => 'Attività Cessata',
        ],
        'company_name' => [
            'label' => 'Ragione Sociale',
        ],
        'latitude' => [
            'label' => 'Latitudine',
        ],
        'longitude' => [
            'label' => 'Longitudine',
        ],
        'distance' => [
            'label' => 'Distanza',
        ],
        'distance_km' => [
            'label' => 'km',
        ],
        'is_active' => [
            'label' => 'Attivo',
        ],
        'full_address' => [
            'label' => 'Indirizzo Completo',
        ],
        'country' => [
            'label' => 'Paese',
        ],
        'tax_code' => [
            'label' => 'Codice Fiscale',
        ],
        'vat_number' => [
            'label' => 'Partita IVA',
        ],
        'fiscal_code' => [
            'label' => 'Codice Fiscale',
        ],
        'competent_health_unit' => [
            'label' => 'ASL Competente',
        ],
        'address' => [
            'label' => 'Indirizzo',
        ],
        'street_number' => [
            'label' => 'Numero Civico',
        ],
        'postal_code' => [
            'label' => 'CAP',
        ],
        'province' => [
            'label' => 'Provincia',
        ],
        'phone' => [
            'label' => 'Telefono',
        ],
        'fax' => [
            'label' => 'Fax',
        ],
        'mobile' => [
            'label' => 'Cellulare',
        ],
        'email' => [
            'label' => 'Email',
        ],
        'notes' => [
            'label' => 'Note',
        ],
        'activity' => [
            'label' => 'Attività',
        ],
        'name' => [
            'label' => 'Nome',
        ],
        'city' => [
            'label' => 'Città',
        ],
        'company_office' => [
            'label' => 'Sede Legale',
        ],
        'sortByDistance' => [
            'label' => 'Ordina per Distanza',
        ],
        'toggleColumns' => [
            'label' => 'Attiva/Disattiva Colonne',
        ],
        'reorderRecords' => [
            'label' => 'Riorganizza Record',
        ],
        'resetFilters' => [
            'label' => 'Resetta Filtro',
        ],
        'applyFilters' => [
            'label' => 'Applica Filtro',
        ],
        'openFilters' => [
            'label' => 'Apri Filtri',
        ],
        'value' => [
            'label' => 'Valore',
        ],
        'delete' => [
            'label' => 'Elimina',
        ],
        'edit' => [
            'label' => 'Modifica',
        ],
        'values' => [
            'label' => 'Valori',
        ],
        'view' => [
            'label' => 'Visualizza',
        ],
        'create' => [
            'label' => 'Crea',
        ],
        'file' => [
            'label' => 'File',
        ],
        'distance_calc' => [
            'label' => 'distance_calc',
        ],
    ],
    'import' => [
        'label' => 'Importa Clienti',
        'name' => [
            'label' => 'Nome',
        ],
        'vat_number' => [
            'label' => 'Partita IVA',
        ],
        'fiscal_code' => [
            'label' => 'Codice Fiscale',
        ],
        'city' => [
            'label' => 'Città',
        ],
        'province' => [
            'label' => 'Provincia',
        ],
        'phone' => [
            'label' => 'Telefono',
        ],
        'email' => [
            'label' => 'Email',
        ],
        'is_active' => [
            'label' => 'Attivo',
        ],
        'created_at' => [
            'label' => 'Data Creazione',
        ],
        'updated_at' => [
            'label' => 'Data Aggiornamento',
        ],
        'view' => [
            'label' => 'Visualizza',
        ],
        'edit' => [
            'label' => 'Modifica',
        ],
        'activity' => [
            'label' => 'Attività',
        ],
    ],
    'messages' => [
        'coordinates_updated' => 'Coordinate aggiornate con successo',
        'coordinates_update_failed' => 'Aggiornamento coordinate fallito',
        'import_success' => 'Importazione completata con successo',
        'import_failed' => 'Importazione fallita',
    ],
    'model' => [
        'label' => 'Cliente',
        'plural' => 'Clienti',
    ],
];
