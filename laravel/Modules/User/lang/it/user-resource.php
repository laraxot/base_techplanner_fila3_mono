<?php

return [
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help' => 'Il nome dell\'utente',
            'validation' => [
                'required' => 'Il nome è obbligatorio',
<<<<<<< HEAD
                'max' => 'Il nome non può superare i 255 caratteri'
            ]
=======
                'max' => 'Il nome non può superare i 255 caratteri',
            ],
>>>>>>> 9831a351 (.)
        ],
        'last_name' => [
            'label' => 'Cognome',
            'placeholder' => 'Inserisci il cognome',
            'help' => 'Il cognome dell\'utente',
            'validation' => [
                'required' => 'Il cognome è obbligatorio',
<<<<<<< HEAD
                'max' => 'Il cognome non può superare i 255 caratteri'
            ]
=======
                'max' => 'Il cognome non può superare i 255 caratteri',
            ],
>>>>>>> 9831a351 (.)
        ],
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Inserisci l\'email',
            'help' => 'L\'email dell\'utente',
            'validation' => [
                'required' => 'L\'email è obbligatoria',
                'email' => 'Inserisci un\'email valida',
                'max' => 'L\'email non può superare i 255 caratteri',
<<<<<<< HEAD
                'unique' => 'Questa email è già registrata'
            ]
=======
                'unique' => 'Questa email è già registrata',
            ],
>>>>>>> 9831a351 (.)
        ],
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Inserisci la password',
            'help' => 'La password deve essere di almeno 8 caratteri',
            'validation' => [
                'required' => 'La password è obbligatoria',
                'min' => 'La password deve essere di almeno 8 caratteri',
<<<<<<< HEAD
                'max' => 'La password non può superare i 255 caratteri'
            ]
=======
                'max' => 'La password non può superare i 255 caratteri',
            ],
>>>>>>> 9831a351 (.)
        ],
        'password_confirmation' => [
            'label' => 'Conferma Password',
            'placeholder' => 'Conferma la password',
            'help' => 'Reinserisci la password per confermare',
            'validation' => [
                'required' => 'La conferma della password è obbligatoria',
                'min' => 'La password deve essere di almeno 8 caratteri',
                'max' => 'La password non può superare i 255 caratteri',
<<<<<<< HEAD
                'same' => 'Le password non coincidono'
            ]
        ],
        'remember_me' => [
            'label' => 'Ricordami',
            'help' => 'Mantieni la sessione attiva'
        ]
=======
                'same' => 'Le password non coincidono',
            ],
        ],
        'remember_me' => [
            'label' => 'Ricordami',
            'help' => 'Mantieni la sessione attiva',
        ],
>>>>>>> 9831a351 (.)
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Utente',
<<<<<<< HEAD
            'tooltip' => 'Crea un nuovo utente'
        ],
        'edit' => [
            'label' => 'Modifica',
            'tooltip' => 'Modifica l\'utente'
        ],
        'delete' => [
            'label' => 'Elimina',
            'tooltip' => 'Elimina l\'utente'
        ]
=======
            'tooltip' => 'Crea un nuovo utente',
        ],
        'edit' => [
            'label' => 'Modifica',
            'tooltip' => 'Modifica l\'utente',
        ],
        'delete' => [
            'label' => 'Elimina',
            'tooltip' => 'Elimina l\'utente',
        ],
>>>>>>> 9831a351 (.)
    ],
    'teams' => [
        'personal_team' => [
            'label' => 'Team Personale',
<<<<<<< HEAD
            'help' => 'Il team personale dell\'utente'
        ]
=======
            'help' => 'Il team personale dell\'utente',
        ],
>>>>>>> 9831a351 (.)
    ],
    'devices' => [
        'fields' => [
            'uuid' => [
                'label' => 'UUID',
<<<<<<< HEAD
                'help' => 'Identificativo univoco del dispositivo'
            ],
            'mobile_id' => [
                'label' => 'Mobile ID',
                'help' => 'Identificativo del dispositivo mobile'
            ],
            'languages' => [
                'label' => 'Lingue',
                'help' => 'Le lingue supportate dal dispositivo'
            ],
            'device_name' => [
                'label' => 'Nome Dispositivo',
                'help' => 'Il nome del dispositivo'
            ]
        ]
=======
                'help' => 'Identificativo univoco del dispositivo',
            ],
            'mobile_id' => [
                'label' => 'Mobile ID',
                'help' => 'Identificativo del dispositivo mobile',
            ],
            'languages' => [
                'label' => 'Lingue',
                'help' => 'Le lingue supportate dal dispositivo',
            ],
            'device_name' => [
                'label' => 'Nome Dispositivo',
                'help' => 'Il nome del dispositivo',
            ],
        ],
>>>>>>> 9831a351 (.)
    ],
    'permissions' => [
        'fields' => [
            'name' => [
                'label' => 'Nome',
<<<<<<< HEAD
                'help' => 'Il nome del permesso'
            ],
            'guard_name' => [
                'label' => 'Guard Name',
                'help' => 'Il nome della guardia'
            ],
            'active' => [
                'label' => 'Attivo',
                'help' => 'Stato di attivazione del permesso'
            ],
            'created_at' => [
                'label' => 'Data Creazione',
                'help' => 'Data di creazione del permesso'
            ]
        ]
=======
                'help' => 'Il nome del permesso',
            ],
            'guard_name' => [
                'label' => 'Guard Name',
                'help' => 'Il nome della guardia',
            ],
            'active' => [
                'label' => 'Attivo',
                'help' => 'Stato di attivazione del permesso',
            ],
            'created_at' => [
                'label' => 'Data Creazione',
                'help' => 'Data di creazione del permesso',
            ],
        ],
>>>>>>> 9831a351 (.)
    ],
    'widgets' => [
        'recent_logins' => [
            'fields' => [
                'user' => [
                    'label' => 'Utente',
<<<<<<< HEAD
                    'help' => 'L\'utente che ha effettuato l\'accesso'
                ],
                'login_at' => [
                    'label' => 'Data Accesso',
                    'help' => 'Data e ora dell\'accesso'
                ],
                'ip_address' => [
                    'label' => 'Indirizzo IP',
                    'help' => 'L\'indirizzo IP dell\'utente'
                ],
                'user_agent' => [
                    'label' => 'User Agent',
                    'help' => 'Il browser dell\'utente'
                ]
            ]
        ]
    ]
=======
                    'help' => 'L\'utente che ha effettuato l\'accesso',
                ],
                'login_at' => [
                    'label' => 'Data Accesso',
                    'help' => 'Data e ora dell\'accesso',
                ],
                'ip_address' => [
                    'label' => 'Indirizzo IP',
                    'help' => 'L\'indirizzo IP dell\'utente',
                ],
                'user_agent' => [
                    'label' => 'User Agent',
                    'help' => 'Il browser dell\'utente',
                ],
            ],
        ],
    ],
>>>>>>> 9831a351 (.)
];
