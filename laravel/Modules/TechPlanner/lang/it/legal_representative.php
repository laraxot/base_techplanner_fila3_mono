<?php

declare(strict_types=1);

return [
    'navigation' => [
        'label' => 'Rappresentanti Legali',
        'group' => 'TechPlanner',
        'icon' => 'heroicon-o-user-group',
        'sort' => 3,
    ],
    'resource' => [
        'label' => 'Rappresentante Legale',
        'name' => 'Rappresentante Legale',
        'plural' => 'Rappresentanti Legali',
        'group' => [
            'name' => 'Admin',
        ],
        'sort' => 84,
        'icon' => 'heroicon-o-user-tie',
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Rappresentante',
            'icon' => 'heroicon-o-plus',
            'color' => 'primary',
            'tooltip' => 'Aggiungi un nuovo rappresentante legale',
        ],
        'edit' => [
            'label' => 'Modifica Rappresentante',
            'icon' => 'heroicon-o-pencil',
            'color' => 'warning',
            'tooltip' => 'Modifica il rappresentante selezionato',
        ],
        'delete' => [
            'label' => 'Elimina Rappresentante',
            'icon' => 'heroicon-o-trash',
            'color' => 'danger',
            'tooltip' => 'Elimina il rappresentante selezionato',
        ],
        'view' => [
            'label' => 'Visualizza Rappresentante',
            'icon' => 'heroicon-o-eye',
            'color' => 'info',
            'tooltip' => 'Visualizza i dettagli del rappresentante',
        ],
    ],
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci nome completo',
            'help' => 'Nome completo del rappresentante legale',
        ],
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Inserisci indirizzo email',
            'help' => 'Indirizzo email del rappresentante',
        ],
        'phone' => [
            'label' => 'Telefono',
            'placeholder' => 'Inserisci numero di telefono',
            'help' => 'Numero di telefono del rappresentante',
        ],
        'role' => [
            'label' => 'Ruolo',
            'placeholder' => 'Seleziona ruolo',
            'help' => 'Ruolo del rappresentante legale',
            'options' => [
                'lawyer' => 'Avvocato',
                'notary' => 'Notaio',
                'consultant' => 'Consulente',
            ],
        ],
        'id' => [
            'label' => 'ID',
            'help' => 'Identificativo univoco del rappresentante',
        ],
    ],
    'filters' => [
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Cerca per nome',
            'help' => 'Filtra per nome del rappresentante',
        ],
        'role' => [
            'label' => 'Ruolo',
            'placeholder' => 'Seleziona ruolo',
            'help' => 'Filtra per ruolo del rappresentante',
        ],
    ],
    'messages' => [
        'created' => 'Rappresentante legale creato con successo',
        'updated' => 'Rappresentante legale aggiornato con successo',
        'deleted' => 'Rappresentante legale eliminato con successo',
    ],
];
