<?php

return [
    'fields' => [
        'uuid' => [
            'label' => 'UUID',
            'placeholder' => 'Inserisci l\'UUID del dispositivo',
            'help' => 'Identificativo univoco del dispositivo',
        ],
        'mobile_id' => [
            'label' => 'Mobile ID',
            'placeholder' => 'Inserisci l\'ID mobile',
            'help' => 'Identificativo mobile del dispositivo',
        ],
        'languages' => [
            'label' => 'Lingue',
            'placeholder' => 'Aggiungi una lingua',
            'help' => 'Seleziona o digita i codici delle lingue (es. it, en, es)',
        ],
        'device' => [
            'label' => 'Nome Dispositivo',
            'placeholder' => 'Inserisci il nome del dispositivo',
            'help' => 'Nome del dispositivo',
        ],
        'platform' => [
            'label' => 'Piattaforma',
            'placeholder' => 'Inserisci la piattaforma',
            'help' => 'Piattaforma del dispositivo',
        ],
        'browser' => [
            'label' => 'Browser',
            'placeholder' => 'Inserisci il browser',
            'help' => 'Browser utilizzato',
        ],
        'version' => [
            'label' => 'Versione',
            'placeholder' => 'Inserisci la versione',
            'help' => 'Versione del browser o sistema',
        ],
        'is_robot' => [
            'label' => 'È Robot',
            'placeholder' => 'Seleziona se è un robot',
            'help' => 'Indica se il dispositivo è un robot',
        ],
        'robot' => [
            'label' => 'Robot',
            'placeholder' => 'Inserisci il tipo di robot',
            'help' => 'Tipo di robot se applicabile',
        ],
        'is_desktop' => [
            'label' => 'È Desktop',
            'placeholder' => 'Seleziona se è desktop',
            'help' => 'Indica se è un dispositivo desktop',
        ],
        'is_mobile' => [
            'label' => 'È Mobile',
            'placeholder' => 'Seleziona se è mobile',
            'help' => 'Indica se è un dispositivo mobile',
        ],
        'is_tablet' => [
            'label' => 'È Tablet',
            'placeholder' => 'Seleziona se è tablet',
            'help' => 'Indica se è un tablet',
        ],
        'is_phone' => [
            'label' => 'È Telefono',
            'placeholder' => 'Seleziona se è telefono',
            'help' => 'Indica se è un telefono',
        ],
    ],
    'navigation' => [
        'sort' => 50,
        'label' => 'Dispositivi',
        'group' => 'Sicurezza',
        'icon' => 'heroicon-o-device-phone-mobile',
    ],
];
