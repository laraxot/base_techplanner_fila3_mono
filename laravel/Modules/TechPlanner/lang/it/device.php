<?php

return [
    'navigation' => [
        'group' => 'techplanner',
        'label' => 'Dispositivi',
        'icon' => 'techplanner-device',
        'sort' => 20,
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
        ],
        'name' => [
            'label' => 'Nome',
        ],
        'serial_number' => [
            'label' => 'Numero Seriale',
        ],
        'model' => [
            'label' => 'Modello',
        ],
        'manufacturer' => [
            'label' => 'Produttore',
        ],
        'purchase_date' => [
            'label' => 'Data Acquisto',
        ],
        'warranty_expiration' => [
            'label' => 'Scadenza Garanzia',
        ],
        'notes' => [
            'label' => 'Note',
        ],
        'client' => [
            'name' => [
                'label' => 'Nome Cliente',
            ],
        ],
        'toggleColumns' => [
            'label' => 'toggleColumns',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Dispositivo',
        ],
        'edit' => [
            'label' => 'Modifica Dispositivo',
        ],
        'delete' => [
            'label' => 'Elimina Dispositivo',
        ],
        'downloadExample' => [
            'label' => 'downloadExample',
        ],
    ],
    'messages' => [
        'created' => 'Dispositivo creato con successo',
        'updated' => 'Dispositivo aggiornato con successo',
        'deleted' => 'Dispositivo eliminato con successo',
    ],
    'model' => [
        'label' => 'Dispositivo',
        'plural' => 'Dispositivi',
    ],
];
