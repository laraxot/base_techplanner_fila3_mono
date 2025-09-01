<?php

return [
    'navigation' => [
        'group' => 'techplanner',
        'label' => 'Appuntamenti',
        'icon' => 'techplanner-appointment',
        'sort' => 10,
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
        ],
        'client_id' => [
            'label' => 'Cliente',
        ],
        'date' => [
            'label' => 'Data',
        ],
        'time' => [
            'label' => 'Ora',
        ],
        'status' => [
            'label' => 'Stato',
            'options' => [
                'scheduled' => 'Programmato',
                'confirmed' => 'Confermato',
                'completed' => 'Completato',
                'cancelled' => 'Annullato',
            ],
        ],
        'notes' => [
            'label' => 'Note',
        ],
        'toggleColumns' => [
            'label' => 'toggleColumns',
        ],
        'layout' => [
            'label' => 'layout',
        ],
        'attach' => [
            'label' => 'attach',
        ],
        'create' => [
            'label' => 'create',
        ],
        'machines_count' => [
            'label' => 'machines_count',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Appuntamento',
        ],
        'edit' => [
            'label' => 'Modifica Appuntamento',
        ],
        'delete' => [
            'label' => 'Elimina Appuntamento',
        ],
    ],
    'messages' => [
        'created' => 'Appuntamento creato con successo',
        'updated' => 'Appuntamento aggiornato con successo',
        'deleted' => 'Appuntamento eliminato con successo',
    ],
    'model' => [
        'label' => 'Appuntamento',
        'plural' => 'Appuntamenti',
    ],
];
