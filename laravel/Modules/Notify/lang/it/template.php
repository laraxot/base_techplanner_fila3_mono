<?php

<<<<<<< HEAD
declare(strict_types=1);

return [
    'resource' => [
        'name' => 'Template Notifiche',
        'plural' => 'Template Notifiche',
    ],
    'navigation' => [
        'name' => 'Template Notifiche',
        'plural' => 'Template Notifiche',
        'group' => [
            'name' => 'Sistema',
            'description' => 'Gestione dei modelli per le notifiche',
        ],
        'label' => 'Template Notifiche',
        'icon' => 'notify-template-animated',
        'sort' => 48,
=======
return [
    'navigation' => [
        'group' => 'Sistema',
        'label' => 'Template Notifiche',
        'icon' => 'notify-template-animated',
        'sort' => 48,
        'description' => 'Gestione dei modelli per le notifiche',
>>>>>>> c57e89d (.)
    ],
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'tooltip' => 'Nome identificativo del template',
            'placeholder' => 'es: Notifica Scadenza',
<<<<<<< HEAD
            'helper_text' => 'Inserisci un nome descrittivo per il template',
=======
>>>>>>> c57e89d (.)
            'help' => 'Inserisci un nome descrittivo per il template',
        ],
        'description' => [
            'label' => 'Descrizione',
            'tooltip' => 'Descrizione del template',
            'placeholder' => 'es: Template per le notifiche di scadenza',
<<<<<<< HEAD
            'helper_text' => 'Breve descrizione dello scopo del template',
        ],
        'type' => [
            'label' => 'Tipo',
            'tooltip' => 'Tipologia di notifica',
            'placeholder' => 'Seleziona il tipo di notifica',
            'helper_text' => 'Il tipo determina il canale di invio della notifica',
            'options' => [
                'email' => 'Email',
                'sms' => 'SMS',
                'push' => 'Notifica Push',
                'telegram' => 'Telegram',
                'whatsapp' => 'WhatsApp',
            ],
=======
            'help' => 'Breve descrizione dello scopo del template',
>>>>>>> c57e89d (.)
        ],
        'subject' => [
            'label' => 'Oggetto',
            'tooltip' => 'Oggetto della notifica',
<<<<<<< HEAD
            'placeholder' => 'es: Promemoria appuntamento',
            'helper_text' => 'Oggetto visualizzato nella notifica (es. oggetto email)',
        ],
        'content' => [
            'label' => 'Contenuto',
            'tooltip' => 'Corpo del messaggio',
            'placeholder' => 'Inserisci il testo del messaggio',
            'helper_text' => 'Contenuto principale della notifica',
        ],
        'variables' => [
            'label' => 'Variabili',
            'tooltip' => 'Variabili disponibili',
            'placeholder' => '{{nome}}, {{email}}, ecc.',
            'helper_text' => 'Variabili che possono essere utilizzate nel template',
        ],
        'is_active' => [
            'label' => 'Attivo',
            'tooltip' => 'Stato del template',
            'helper_text' => 'Se attivo, il template può essere utilizzato per l\'invio di notifiche',
        ],
        'created_at' => [
            'label' => 'Data creazione',
            'tooltip' => 'Data di creazione del template',
        ],
        'updated_at' => [
            'label' => 'Ultima modifica',
            'tooltip' => 'Data dell\'ultima modifica del template',
=======
            'placeholder' => 'es: Promemoria: {event_name}',
            'help' => 'Puoi usare le variabili tra parentesi graffe',
        ],
        'body' => [
            'label' => 'Corpo',
            'tooltip' => 'Contenuto del messaggio',
            'placeholder' => 'es: Gentile {user_name},\n\nTi ricordiamo che...',
            'help' => 'Il contenuto principale della notifica. Supporta HTML per le email.',
        ],
        'type' => [
            'label' => 'Tipo',
            'tooltip' => 'Tipo di notifica',
            'help' => 'Seleziona il tipo di notifica per cui usare questo template',
            'options' => [
                'email' => [
                    'label' => 'Email',
                    'tooltip' => 'Template per notifiche email',
                ],
                'sms' => [
                    'label' => 'SMS',
                    'tooltip' => 'Template per messaggi SMS',
                ],
                'push' => [
                    'label' => 'Push',
                    'tooltip' => 'Template per notifiche push',
                ],
                'telegram' => [
                    'label' => 'Telegram',
                    'tooltip' => 'Template per messaggi Telegram',
                ],
            ],
        ],
        'variables' => [
            'label' => 'Variabili disponibili',
            'tooltip' => 'Variabili che possono essere utilizzate nel template',
            'help' => 'Usa queste variabili per personalizzare il contenuto',
            'sections' => [
                'user' => [
                    'label' => 'Utente',
                    'tooltip' => 'Variabili relative all\'utente',
                    'variables' => [
                        'name' => [
                            'label' => 'Nome utente',
                            'tooltip' => '{user_name} - Nome completo dell\'utente',
                        ],
                        'email' => [
                            'label' => 'Email utente',
                            'tooltip' => '{user_email} - Indirizzo email dell\'utente',
                        ],
                    ],
                ],
                'notification' => [
                    'label' => 'Notifica',
                    'tooltip' => 'Variabili relative alla notifica',
                    'variables' => [
                        'title' => [
                            'label' => 'Titolo notifica',
                            'tooltip' => '{notification_title} - Titolo della notifica',
                        ],
                        'message' => [
                            'label' => 'Messaggio notifica',
                            'tooltip' => '{notification_message} - Messaggio della notifica',
                        ],
                        'date' => [
                            'label' => 'Data notifica',
                            'tooltip' => '{notification_date} - Data della notifica',
                        ],
                    ],
                ],
            ],
        ],
        'is_active' => [
            'label' => 'Attivo',
            'tooltip' => 'Stato di attivazione del template',
            'help' => 'Solo i template attivi possono essere utilizzati',
>>>>>>> c57e89d (.)
        ],
    ],
    'actions' => [
        'preview' => [
            'label' => 'Anteprima',
            'tooltip' => 'Visualizza anteprima del template',
            'icon' => 'heroicon-o-eye',
<<<<<<< HEAD
            'success_message' => 'Anteprima generata con successo',
            'error_message' => 'Errore nella generazione dell\'anteprima',
        ],
        'duplicate' => [
            'label' => 'Duplica',
            'tooltip' => 'Crea una copia del template',
            'icon' => 'heroicon-o-document-duplicate',
            'success_message' => 'Template duplicato con successo',
            'error_message' => 'Errore nella duplicazione del template',
        ],
        'test' => [
            'label' => 'Test',
            'tooltip' => 'Invia una notifica di test',
            'icon' => 'heroicon-o-paper-airplane',
            'success_message' => 'Notifica di test inviata con successo',
            'error_message' => 'Errore nell\'invio della notifica di test',
        ],
    ],
    'messages' => [
        'success' => 'Operazione completata con successo',
        'error' => 'Si è verificato un errore durante l\'operazione',
        'confirmation' => 'Sei sicuro di voler procedere con questa operazione?',
        'template_created' => 'Il template è stato creato con successo',
        'template_updated' => 'Il template è stato aggiornato con successo',
        'template_deleted' => 'Il template è stato eliminato con successo',
=======
            'color' => 'primary',
        ],
        'test' => [
            'label' => 'Invia test',
            'tooltip' => 'Invia una notifica di test usando questo template',
            'icon' => 'heroicon-o-paper-airplane',
            'color' => 'info',
            'confirmation' => [
                'title' => 'Conferma test',
                'message' => 'Vuoi inviare una notifica di test usando questo template?',
                'confirm' => 'Sì, invia test',
                'cancel' => 'No, annulla',
            ],
        ],
        'duplicate' => [
            'label' => 'Duplica',
            'tooltip' => 'Crea una copia di questo template',
            'icon' => 'heroicon-o-document-duplicate',
            'color' => 'success',
            'confirmation' => [
                'title' => 'Conferma duplicazione',
                'message' => 'Vuoi creare una copia di questo template?',
                'confirm' => 'Sì, duplica',
                'cancel' => 'No, annulla',
            ],
        ],
    ],
    'messages' => [
        'preview_title' => [
            'title' => 'Anteprima Template',
            'message' => 'Questa è un\'anteprima di come apparirà la notifica',
        ],
        'test_sent' => [
            'title' => 'Test Inviato',
            'message' => 'La notifica di test è stata inviata con successo',
        ],
        'duplicated' => [
            'title' => 'Template Duplicato',
            'message' => 'Il template è stato duplicato con successo',
        ],
>>>>>>> c57e89d (.)
    ],
];
