<?php

declare(strict_types=1);

return [
    'resource' => [
        'name' => 'Invio Telegram',
<<<<<<< HEAD
        'plural' => 'Invio Telegram',
=======
>>>>>>> c57e89d (.)
    ],
    'navigation' => [
        'name' => 'Invio Telegram',
        'plural' => 'Invio Telegram',
        'group' => [
            'name' => 'Sistema',
            'description' => 'Funzionalità per l\'invio di messaggi attraverso Telegram',
        ],
        'label' => 'Invio Telegram',
        'icon' => 'notify-telegram-animated',
        'sort' => 50,
    ],
    'fields' => [
        'chat_id' => [
            'label' => 'ID Chat',
<<<<<<< HEAD
            'placeholder' => 'Inserisci l\'ID della chat',
            'helper_text' => 'ID della chat Telegram di destinazione',
            'description' => 'Identificativo univoco della chat Telegram',
        ],
        'message' => [
            'label' => 'Messaggio',
            'placeholder' => 'Inserisci il messaggio da inviare',
            'helper_text' => 'Contenuto del messaggio Telegram',
            'description' => 'Testo del messaggio da inviare tramite Telegram',
        ],
        'parse_mode' => [
            'label' => 'Formato',
            'placeholder' => 'Seleziona il formato',
            'helper_text' => 'Formato di interpretazione del messaggio',
            'description' => 'Modalità di formattazione del messaggio',
=======
        ],
        'message' => [
            'label' => 'Messaggio',
        ],
        'parse_mode' => [
            'label' => 'Formato',
>>>>>>> c57e89d (.)
            'options' => [
                'text' => 'Testo semplice',
                'html' => 'HTML',
                'markdown' => 'Markdown',
            ],
        ],
    ],
    'actions' => [
        'send' => [
            'label' => 'Invia Messaggio',
<<<<<<< HEAD
            'tooltip' => 'Invia un messaggio tramite Telegram',
            'success_message' => 'Messaggio inviato con successo',
            'error_message' => 'Errore nell\'invio del messaggio',
=======
>>>>>>> c57e89d (.)
            'success' => 'Messaggio inviato con successo',
            'error' => 'Errore durante l\'invio del messaggio',
        ],
        'preview' => [
            'label' => 'Anteprima',
<<<<<<< HEAD
            'tooltip' => 'Visualizza un\'anteprima del messaggio',
            'success_message' => 'Anteprima generata',
            'error_message' => 'Errore nella generazione dell\'anteprima',
        ],
    ],
    'messages' => [
        'success' => 'Messaggio Telegram inviato con successo',
        'error' => 'Si è verificato un errore durante l\'invio del messaggio Telegram',
        'confirmation' => 'Sei sicuro di voler inviare questo messaggio Telegram?',
    ],
=======
        ],
    ],
>>>>>>> c57e89d (.)
];
