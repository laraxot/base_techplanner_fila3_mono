<?php

<<<<<<< HEAD
declare(strict_types=1);

return [
    'resource' => [
        'name' => 'Notifica',
        'plural' => 'Notifiche',
    ],
    'navigation' => [
        'name' => 'Gestione Notifiche',
        'plural' => 'Gestione Notifiche',
        'group' => [
            'name' => 'Sistema',
            'description' => 'Gestione centralizzata delle notifiche di sistema',
        ],
        'label' => 'Gestione Notifiche',
        'icon' => 'notify-notification-animated',
        'sort' => 46,
    ],
    'fields' => [
        'title' => [
            'label' => 'Titolo',
            'helper_text' => 'Titolo della notifica',
            'placeholder' => 'Inserisci il titolo',
        ],
        'message' => [
            'label' => 'Messaggio',
            'helper_text' => 'Contenuto della notifica',
            'placeholder' => 'Inserisci il messaggio',
        ],
        'type' => [
            'label' => 'Tipo',
            'helper_text' => 'Tipologia di notifica',
            'placeholder' => 'Seleziona il tipo',
            'options' => [
                'system' => 'Sistema',
                'alert' => 'Avviso',
                'info' => 'Informazione',
                'success' => 'Successo',
                'warning' => 'Attenzione',
                'error' => 'Errore',
            ],
        ],
        'status' => [
            'label' => 'Stato',
            'helper_text' => 'Stato corrente della notifica',
            'placeholder' => 'Seleziona lo stato',
            'options' => [
                'unread' => 'Non letta',
                'read' => 'Letta',
                'archived' => 'Archiviata',
            ],
        ],
        'recipient' => [
            'label' => 'Destinatario',
            'helper_text' => 'Utente destinatario della notifica',
            'placeholder' => 'Seleziona il destinatario',
        ],
        'sent_at' => [
            'label' => 'Inviata il',
            'helper_text' => 'Data e ora di invio della notifica',
        ],
        'read_at' => [
            'label' => 'Letta il',
            'helper_text' => 'Data e ora di lettura della notifica',
        ],
        'archived_at' => [
            'label' => 'Archiviata il',
            'helper_text' => 'Data e ora di archiviazione della notifica',
        ],
        'channel' => [
            'label' => 'Canale',
            'tooltip' => 'Canale di invio della notifica',
            'helper_text' => 'Seleziona il canale attraverso cui inviare la notifica',
            'placeholder' => 'Seleziona un canale',
=======
return [
    'navigation' => [
        'group' => 'Sistema',
        'label' => 'Gestione Notifiche',
        'icon' => 'notify-notification-animated',
        'sort' => 46,
        'description' => 'Gestione centralizzata delle notifiche di sistema',
    ],
    'fields' => [
        'title' => 'Titolo',
        'message' => 'Messaggio',
        'type' => [
            'label' => 'Tipo',
            'system' => 'Sistema',
            'alert' => 'Avviso',
            'info' => 'Informazione',
            'success' => 'Successo',
            'warning' => 'Attenzione',
            'error' => 'Errore',
        ],
        'status' => [
            'label' => 'Stato',
            'unread' => 'Non letta',
            'read' => 'Letta',
            'archived' => 'Archiviata',
        ],
        'recipient' => 'Destinatario',
        'sent_at' => 'Inviata il',
        'read_at' => 'Letta il',
        'archived_at' => 'Archiviata il',
        'channel' => [
            'label' => 'Canale',
            'tooltip' => 'Canale di invio della notifica',
            'help' => 'Seleziona il canale attraverso cui inviare la notifica',
>>>>>>> c57e89d (.)
            'options' => [
                'email' => [
                    'label' => 'Email',
                    'tooltip' => 'Invia tramite email',
                ],
                'sms' => [
                    'label' => 'SMS',
                    'tooltip' => 'Invia tramite SMS',
                ],
                'push' => [
                    'label' => 'Push',
                    'tooltip' => 'Invia come notifica push',
                ],
                'telegram' => [
                    'label' => 'Telegram',
                    'tooltip' => 'Invia tramite Telegram',
                ],
            ],
        ],
        'template' => [
            'label' => 'Template',
            'tooltip' => 'Template da utilizzare per la notifica',
<<<<<<< HEAD
            'helper_text' => 'Scegli il modello predefinito per questa notifica',
            'placeholder' => 'Seleziona un template',
=======
            'help' => 'Scegli il modello predefinito per questa notifica',
>>>>>>> c57e89d (.)
            'options' => [
                'subject' => [
                    'label' => 'Oggetto',
                    'tooltip' => 'Oggetto della notifica',
                    'placeholder' => 'es: Notifica importante',
                ],
                'body' => [
                    'label' => 'Corpo',
                    'tooltip' => 'Contenuto principale della notifica',
                    'placeholder' => 'Inserisci il testo della notifica...',
                ],
                'variables' => [
                    'label' => 'Variabili disponibili',
                    'tooltip' => 'Variabili che possono essere utilizzate nel template',
<<<<<<< HEAD
                    'helper_text' => 'Usa {variable} per inserire valori dinamici',
=======
                    'help' => 'Usa {variable} per inserire valori dinamici',
>>>>>>> c57e89d (.)
                ],
            ],
        ],
        'schedule' => [
            'label' => 'Programmazione',
            'tooltip' => 'Quando inviare la notifica',
<<<<<<< HEAD
            'helper_text' => 'Imposta quando la notifica deve essere inviata',
            'placeholder' => 'Seleziona l\'opzione di programmazione',
=======
            'help' => 'Imposta quando la notifica deve essere inviata',
>>>>>>> c57e89d (.)
            'options' => [
                'immediate' => [
                    'label' => 'Immediata',
                    'tooltip' => 'Invia subito la notifica',
                ],
                'scheduled' => [
                    'label' => 'Programmata',
                    'tooltip' => 'Programma l\'invio per una data specifica',
                ],
                'date' => [
                    'label' => 'Data',
                    'tooltip' => 'Data di invio programmato',
                    'placeholder' => 'es: 01/01/2024',
                ],
                'time' => [
                    'label' => 'Ora',
                    'tooltip' => 'Ora di invio programmato',
                    'placeholder' => 'es: 14:30',
                ],
            ],
        ],
    ],
    'actions' => [
<<<<<<< HEAD
        'mark_as_read' => [
            'label' => 'Segna come letta',
            'tooltip' => 'Marca la notifica come letta',
            'success_message' => 'Notifica segnata come letta',
            'error_message' => 'Errore nel segnare la notifica come letta',
        ],
        'mark_as_unread' => [
            'label' => 'Segna come non letta',
            'tooltip' => 'Marca la notifica come non letta',
            'success_message' => 'Notifica segnata come non letta',
            'error_message' => 'Errore nel segnare la notifica come non letta',
        ],
        'archive' => [
            'label' => 'Archivia',
            'tooltip' => 'Archivia la notifica',
            'success_message' => 'Notifica archiviata con successo',
            'error_message' => 'Errore nell\'archiviazione della notifica',
        ],
        'unarchive' => [
            'label' => 'Ripristina',
            'tooltip' => 'Ripristina la notifica archiviata',
            'success_message' => 'Notifica ripristinata con successo',
            'error_message' => 'Errore nel ripristino della notifica',
        ],
        'send' => [
            'label' => 'Invia',
            'tooltip' => 'Invia la notifica',
            'success_message' => 'Notifica inviata con successo',
            'error_message' => 'Errore nell\'invio della notifica',
        ],
        'resend' => [
            'label' => 'Invia nuovamente',
            'tooltip' => 'Invia nuovamente la notifica',
            'success_message' => 'Notifica inviata nuovamente con successo',
            'error_message' => 'Errore nell\'invio della notifica',
        ],
        'delete' => [
            'label' => 'Elimina',
            'tooltip' => 'Elimina definitivamente la notifica',
            'success_message' => 'Notifica eliminata con successo',
            'error_message' => 'Errore nell\'eliminazione della notifica',
            'confirmation' => 'Sei sicuro di voler eliminare questa notifica? Questa azione non può essere annullata.',
        ],
    ],
    'messages' => [
        'no_notifications' => 'Non hai notifiche',
        'all_read' => 'Tutte le notifiche sono state lette',
        'mark_all_read' => 'Segna tutte come lette',
        'notification_sent' => 'Notifica inviata con successo',
        'notification_error' => 'Si è verificato un errore durante l\'invio della notifica',
        'delete_confirmation' => 'Sei sicuro di voler eliminare questa notifica?',
        'batch_action_confirmation' => 'Sei sicuro di voler eseguire questa azione su tutte le notifiche selezionate?',
        'success' => 'Operazione completata con successo',
        'error' => 'Si è verificato un errore durante l\'operazione',
=======
        'mark_as_read' => 'Segna come letta',
        'mark_as_unread' => 'Segna come non letta',
        'archive' => 'Archivia',
        'unarchive' => 'Ripristina',
        'delete' => 'Elimina',
        'send_test' => [
            'label' => 'Invia test',
            'tooltip' => 'Invia una notifica di test',
            'icon' => 'heroicon-o-paper-airplane',
            'color' => 'info',
            'confirmation' => [
                'title' => 'Conferma invio test',
                'message' => 'Vuoi inviare una notifica di test?',
                'confirm' => 'Sì, invia test',
                'cancel' => 'No, annulla',
            ],
        ],
        'preview' => [
            'label' => 'Anteprima',
            'tooltip' => 'Visualizza anteprima della notifica',
            'icon' => 'heroicon-o-eye',
            'color' => 'primary',
        ],
        'schedule' => [
            'label' => 'Programma',
            'tooltip' => 'Programma l\'invio della notifica',
            'icon' => 'heroicon-o-clock',
            'color' => 'success',
            'confirmation' => [
                'title' => 'Conferma programmazione',
                'message' => 'Vuoi programmare l\'invio di questa notifica?',
                'confirm' => 'Sì, programma',
                'cancel' => 'No, annulla',
            ],
        ],
    ],
    'messages' => [
        'no_notifications' => 'Nessuna notifica',
        'mark_all_read' => 'Segna tutte come lette',
        'archive_all' => 'Archivia tutte',
        'delete_all' => 'Elimina tutte',
        'test_sent' => [
            'title' => 'Test Inviato',
            'message' => 'La notifica di test è stata inviata con successo',
        ],
        'scheduled' => [
            'title' => 'Programmazione Completata',
            'message' => 'Notifica programmata per il :date alle :time',
        ],
    ],
    'filters' => [
        'all' => 'Tutte',
        'unread' => 'Non lette',
        'read' => 'Lette',
        'archived' => 'Archiviate',
        'type' => 'Tipo',
        'date' => 'Data',
    ],
    'badges' => [
        'unread' => 'Non letta',
        'priority' => [
            'high' => 'Alta priorità',
            'medium' => 'Media priorità',
            'low' => 'Bassa priorità',
        ],
>>>>>>> c57e89d (.)
    ],
];
