<?php

declare(strict_types=1);

return [
    // ==============================================
    // NAVIGATION & STRUCTURE
    // ==============================================
    'navigation' => [
        'label' => 'Appuntamenti',
        'plural_label' => 'Appuntamenti',
        'group' => 'TechPlanner',
        'icon' => 'heroicon-o-calendar-days',
        'sort' => 10,
        'badge' => 'Gestione appuntamenti',
    ],

    // ==============================================
    // MODEL INFORMATION
    // ==============================================
    'model' => [
        'label' => 'Appuntamento',
        'plural' => 'Appuntamenti',
        'description' => 'Gestione appuntamenti e prenotazioni',
    ],

    // ==============================================
    // FIELDS - STRUTTURA ESPANSA OBBLIGATORIA
    // ==============================================
    'fields' => [
        'id' => [
            'label' => 'ID',
            'tooltip' => 'Identificativo univoco dell\'appuntamento',
            'helper_text' => 'Identificativo numerico univoco dell\'appuntamento nel sistema',
        ],
        'client_id' => [
            'label' => 'Cliente',
            'placeholder' => 'Seleziona il cliente',
            'tooltip' => 'Cliente per cui è programmato l\'appuntamento',
            'helper_text' => 'Cliente specifico per cui è stato programmato l\'appuntamento',
            'help' => 'Scegli il cliente dall\'elenco disponibile',
        ],
        'date' => [
            'label' => 'Data',
            'placeholder' => 'Seleziona la data',
            'tooltip' => 'Data dell\'appuntamento',
            'helper_text' => 'Data specifica in cui si svolgerà l\'appuntamento',
            'help' => 'Seleziona la data appropriata per l\'appuntamento',
        ],
        'time' => [
            'label' => 'Ora',
            'placeholder' => 'Seleziona l\'ora',
            'tooltip' => 'Orario dell\'appuntamento',
            'helper_text' => 'Orario specifico in cui inizierà l\'appuntamento',
            'help' => 'Scegli l\'orario più appropriato',
        ],
        'status' => [
            'label' => 'Stato',
            'placeholder' => 'Seleziona lo stato',
            'tooltip' => 'Stato attuale dell\'appuntamento',
            'helper_text' => 'Stato corrente dell\'appuntamento nel sistema',
            'help' => 'Seleziona lo stato appropriato dall\'elenco',
            'options' => [
                'scheduled' => 'Programmato',
                'confirmed' => 'Confermato',
                'completed' => 'Completato',
                'cancelled' => 'Annullato',
            ],
        ],
        'notes' => [
            'label' => 'Note',
            'placeholder' => 'Inserisci note aggiuntive',
            'tooltip' => 'Note e osservazioni sull\'appuntamento',
            'helper_text' => 'Informazioni aggiuntive o note particolari sull\'appuntamento',
            'help' => 'Aggiungi qualsiasi informazione rilevante',
        ],
        'machines_count' => [
            'label' => 'Numero Macchine',
            'tooltip' => 'Numero di macchine coinvolte',
            'helper_text' => 'Numero di macchine o dispositivi coinvolti nell\'appuntamento',
        ],
        'created_at' => [
            'label' => 'Data Creazione',
            'tooltip' => 'Data di creazione dell\'appuntamento',
            'helper_text' => 'Data e ora in cui l\'appuntamento è stato creato nel sistema',
        ],
        'updated_at' => [
            'label' => 'Ultima Modifica',
            'tooltip' => 'Data dell\'ultima modifica',
            'helper_text' => 'Data e ora dell\'ultimo aggiornamento dell\'appuntamento',
        ],
    ],

    // ==============================================
    // ACTIONS - STRUTTURA ESPANSA OBBLIGATORIA
    // ==============================================
    'actions' => [
        'create' => [
            'label' => 'Nuovo Appuntamento',
            'icon' => 'heroicon-o-plus',
            'color' => 'primary',
            'tooltip' => 'Crea un nuovo appuntamento',
            'modal' => [
                'heading' => 'Crea Nuovo Appuntamento',
                'description' => 'Inserisci i dettagli per il nuovo appuntamento',
                'confirm' => 'Crea Appuntamento',
                'cancel' => 'Annulla',
            ],
            'messages' => [
                'success' => 'Appuntamento creato con successo',
                'error' => 'Errore durante la creazione dell\'appuntamento',
            ],
        ],
        'edit' => [
            'label' => 'Modifica Appuntamento',
            'icon' => 'heroicon-o-pencil',
            'color' => 'warning',
            'tooltip' => 'Modifica l\'appuntamento selezionato',
            'modal' => [
                'heading' => 'Modifica Appuntamento',
                'description' => 'Aggiorna i dettagli dell\'appuntamento',
                'confirm' => 'Salva modifiche',
                'cancel' => 'Annulla',
            ],
            'messages' => [
                'success' => 'Appuntamento aggiornato con successo',
                'error' => 'Errore durante l\'aggiornamento dell\'appuntamento',
            ],
        ],
        'delete' => [
            'label' => 'Elimina Appuntamento',
            'icon' => 'heroicon-o-trash',
            'color' => 'danger',
            'tooltip' => 'Elimina l\'appuntamento selezionato',
            'modal' => [
                'heading' => 'Elimina Appuntamento',
                'description' => 'Sei sicuro di voler eliminare questo appuntamento? Questa azione è irreversibile.',
                'confirm' => 'Elimina',
                'cancel' => 'Annulla',
            ],
            'messages' => [
                'success' => 'Appuntamento eliminato con successo',
                'error' => 'Errore durante l\'eliminazione dell\'appuntamento',
            ],
            'confirmation' => 'Sei sicuro di voler eliminare questo appuntamento?',
        ],
        'view' => [
            'label' => 'Visualizza Appuntamento',
            'icon' => 'heroicon-o-eye',
            'color' => 'secondary',
            'tooltip' => 'Visualizza i dettagli dell\'appuntamento',
        ],
        'confirm' => [
            'label' => 'Conferma Appuntamento',
            'icon' => 'heroicon-o-check-circle',
            'color' => 'success',
            'tooltip' => 'Conferma l\'appuntamento selezionato',
            'modal' => [
                'heading' => 'Conferma Appuntamento',
                'description' => 'Sei sicuro di voler confermare questo appuntamento?',
                'confirm' => 'Conferma',
                'cancel' => 'Annulla',
            ],
            'messages' => [
                'success' => 'Appuntamento confermato con successo',
                'error' => 'Errore durante la conferma dell\'appuntamento',
            ],
        ],
        'cancel' => [
            'label' => 'Annulla Appuntamento',
            'icon' => 'heroicon-o-x-circle',
            'color' => 'danger',
            'tooltip' => 'Annulla l\'appuntamento selezionato',
            'modal' => [
                'heading' => 'Annulla Appuntamento',
                'description' => 'Sei sicuro di voler annullare questo appuntamento?',
                'confirm' => 'Annulla',
                'cancel' => 'Chiudi',
            ],
            'messages' => [
                'success' => 'Appuntamento annullato con successo',
                'error' => 'Errore durante l\'annullamento dell\'appuntamento',
            ],
        ],
        'bulk_actions' => [
            'delete' => [
                'label' => 'Elimina Selezionati',
                'icon' => 'heroicon-o-trash',
                'color' => 'danger',
                'tooltip' => 'Elimina gli appuntamenti selezionati',
                'modal' => [
                    'heading' => 'Elimina Appuntamenti Selezionati',
                    'description' => 'Sei sicuro di voler eliminare gli appuntamenti selezionati? Questa azione è irreversibile.',
                    'confirm' => 'Elimina tutti',
                    'cancel' => 'Annulla',
                ],
                'messages' => [
                    'success' => 'Appuntamenti eliminati con successo',
                    'error' => 'Errore durante l\'eliminazione degli appuntamenti',
                ],
            ],
            'confirm' => [
                'label' => 'Conferma Selezionati',
                'icon' => 'heroicon-o-check-circle',
                'color' => 'success',
                'tooltip' => 'Conferma gli appuntamenti selezionati',
                'modal' => [
                    'heading' => 'Conferma Appuntamenti Selezionati',
                    'description' => 'Sei sicuro di voler confermare gli appuntamenti selezionati?',
                    'confirm' => 'Conferma tutti',
                    'cancel' => 'Annulla',
                ],
                'messages' => [
                    'success' => 'Appuntamenti confermati con successo',
                    'error' => 'Errore durante la conferma degli appuntamenti',
                ],
            ],
        ],
    ],

    // ==============================================
    // SECTIONS - ORGANIZZAZIONE FORM
    // ==============================================
    'sections' => [
        'basic_info' => [
            'label' => 'Informazioni Base',
            'description' => 'Informazioni fondamentali dell\'appuntamento',
            'icon' => 'heroicon-o-information-circle',
        ],
        'schedule' => [
            'label' => 'Programmazione',
            'description' => 'Data, ora e dettagli temporali',
            'icon' => 'heroicon-o-clock',
        ],
        'client_info' => [
            'label' => 'Informazioni Cliente',
            'description' => 'Dettagli del cliente e note',
            'icon' => 'heroicon-o-user',
        ],
    ],

    // ==============================================
    // FILTERS - RICERCA E FILTRI
    // ==============================================
    'filters' => [
        'status' => [
            'label' => 'Stato',
            'options' => [
                'scheduled' => 'Programmato',
                'confirmed' => 'Confermato',
                'completed' => 'Completato',
                'cancelled' => 'Annullato',
            ],
        ],
        'client' => [
            'label' => 'Cliente',
            'placeholder' => 'Seleziona cliente',
        ],
        'date_range' => [
            'label' => 'Periodo',
            'placeholder' => 'Seleziona il periodo',
        ],
        'search' => [
            'label' => 'Ricerca',
            'placeholder' => 'Cerca negli appuntamenti...',
        ],
    ],

    // ==============================================
    // MESSAGES - FEEDBACK UTENTE
    // ==============================================
    'messages' => [
        'empty_state' => 'Nessun appuntamento trovato',
        'search_placeholder' => 'Cerca appuntamenti...',
        'loading' => 'Caricamento appuntamenti in corso...',
        'total_count' => 'Totale appuntamenti: :count',
        'created' => 'Appuntamento creato con successo',
        'updated' => 'Appuntamento aggiornato con successo',
        'deleted' => 'Appuntamento eliminato con successo',
        'confirmed' => 'Appuntamento confermato con successo',
        'cancelled' => 'Appuntamento annullato con successo',
        'bulk_deleted' => 'Appuntamenti eliminati con successo',
        'bulk_confirmed' => 'Appuntamenti confermati con successo',
        'error_general' => 'Si è verificato un errore. Riprova più tardi.',
        'error_validation' => 'Si sono verificati errori di validazione.',
        'error_permission' => 'Non hai i permessi per eseguire questa azione.',
        'success_operation' => 'Operazione completata con successo',
    ],

    // ==============================================
    // VALIDATION - MESSAGGI DI VALIDAZIONE
    // ==============================================
    'validation' => [
        'client_id_required' => 'Il cliente è obbligatorio',
        'date_required' => 'La data è obbligatoria',
        'time_required' => 'L\'ora è obbligatoria',
        'status_required' => 'Lo stato è obbligatorio',
        'date_after' => 'La data deve essere futura',
        'time_format' => 'L\'ora deve essere in formato HH:MM',
        'notes_max' => 'Le note non possono superare i :max caratteri',
    ],

    // ==============================================
    // DESCRIPTIONS - DESCRIZIONI CONTESTUALI
    // ==============================================
    'descriptions' => [
        'appointment_purpose' => 'Gestione completa degli appuntamenti e prenotazioni',
        'status_workflow' => 'Flusso degli stati: Programmato → Confermato → Completato/Annullato',
        'best_practices' => 'Verificare sempre la disponibilità prima di confermare',
        'limitations' => 'Non è possibile modificare appuntamenti già completati',
    ],

    // ==============================================
    // OPTIONS - OPZIONI E VALORI PREDEFINITI
    // ==============================================
    'options' => [
        'statuses' => [
            'scheduled' => 'Programmato',
            'confirmed' => 'Confermato',
            'completed' => 'Completato',
            'cancelled' => 'Annullato',
        ],
        'time_slots' => [
            '09:00' => '09:00',
            '09:30' => '09:30',
            '10:00' => '10:00',
            '10:30' => '10:30',
            '11:00' => '11:00',
            '11:30' => '11:30',
            '14:00' => '14:00',
            '14:30' => '14:30',
            '15:00' => '15:00',
            '15:30' => '15:30',
            '16:00' => '16:00',
            '16:30' => '16:30',
        ],
        'priorities' => [
            'low' => 'Bassa',
            'medium' => 'Media',
            'high' => 'Alta',
            'urgent' => 'Urgente',
        ],
    ],
];