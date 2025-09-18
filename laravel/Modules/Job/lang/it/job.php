<?php

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
declare(strict_types=1);

return [
    'pages' => [
        'index' => [
            'title' => 'Elenco Jobs',
            'subtitle' => 'Gestione dei processi in background',
            'description' => 'Visualizza e gestisci tutti i job del sistema',
        ],
        'create' => [
            'title' => 'Nuovo Job',
            'subtitle' => 'Crea un nuovo job',
            'description' => 'Inserisci i dettagli per creare un nuovo job',
        ],
        'edit' => [
            'title' => 'Modifica Job',
            'subtitle' => 'Modifica i dettagli del job',
            'description' => 'Aggiorna le informazioni del job selezionato',
        ],
        'view' => [
            'title' => 'Dettagli Job',
            'subtitle' => 'Visualizza i dettagli completi del job',
            'description' => 'Informazioni dettagliate sul job selezionato',
        ],
    ],
    'widgets' => [
        'job_overview' => [
            'title' => 'Panoramica Jobs',
            'description' => 'Statistiche sui job del sistema',
        ],
        'recent_jobs' => [
            'title' => 'Jobs Recenti',
            'description' => 'Ultimi job eseguiti',
        ],
        'failed_jobs' => [
            'title' => 'Jobs Falliti',
            'description' => 'Jobs che hanno avuto errori',
        ],
    ],
=======
return [
    'pages' => 'Pagine',
    'widgets' => 'Widgets',
>>>>>>> de0f89b5 (.)
=======
return [
    'pages' => 'Pagine',
    'widgets' => 'Widgets',
>>>>>>> 2e199498 (.)
=======
return [
    'pages' => 'Pagine',
    'widgets' => 'Widgets',
>>>>>>> eaeb6531 (.)
    'navigation' => [
        'name' => 'Job',
        'plural' => 'Jobs',
        'group' => [
            'name' => 'Jobs',
            'description' => 'Gestione dei processi in background',
        ],
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'label' => 'Jobs',
        'sort' => 30,
        'icon' => 'heroicon-o-cpu-chip',
        'tooltip' => 'Gestisci i processi in background',
        'helper_text' => '',
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
            'help' => 'Identificatore univoco del job',
            'tooltip' => 'ID del job',
            'helper_text' => '',
        ],
        'queue' => [
            'label' => 'Coda',
            'placeholder' => 'Seleziona la coda',
            'help' => 'La coda a cui appartiene il job',
            'tooltip' => 'Coda di elaborazione',
            'helper_text' => '',
            'options' => [
                'default' => 'Predefinita',
                'high' => 'Alta Priorità',
                'low' => 'Bassa Priorità',
                'emails' => 'Email',
                'notifications' => 'Notifiche',
            ],
        ],
        'payload' => [
            'label' => 'Payload',
            'placeholder' => 'Dati del job',
            'help' => 'Dati associati al job',
            'tooltip' => 'Contenuto del job',
            'helper_text' => '',
        ],
        'attempts' => [
            'label' => 'Tentativi',
            'placeholder' => 'Numero di tentativi',
            'help' => 'Numero di tentativi per eseguire il job',
            'tooltip' => 'Tentativi di esecuzione',
            'helper_text' => '',
        ],
        'reserved_at' => [
            'label' => 'Riservato il',
            'placeholder' => 'Data e ora riserva',
            'help' => 'Data e ora in cui il job è stato riservato',
            'tooltip' => 'Quando è stato riservato',
            'helper_text' => '',
        ],
        'available_at' => [
            'label' => 'Disponibile il',
            'placeholder' => 'Data e ora disponibilità',
            'help' => 'Data e ora in cui il job è diventato disponibile',
            'tooltip' => 'Quando diventa disponibile',
            'helper_text' => '',
        ],
        'created_at' => [
            'label' => 'Creato il',
            'help' => 'Data di creazione del job',
            'tooltip' => 'Data creazione',
            'helper_text' => '',
        ],
        'status' => [
            'label' => 'Stato',
            'placeholder' => 'Seleziona lo stato',
            'help' => 'Stato attuale del job',
            'tooltip' => 'Stato del job',
            'helper_text' => '',
            'options' => [
                'pending' => 'In Attesa',
                'processing' => 'In Elaborazione',
                'completed' => 'Completato',
                'failed' => 'Fallito',
                'cancelled' => 'Annullato',
                'retrying' => 'Riprova',
            ],
        ],
        'progress' => [
            'label' => 'Progresso',
            'placeholder' => 'Percentuale completamento',
            'help' => 'Percentuale di completamento del job',
            'tooltip' => 'Progresso del job',
            'helper_text' => '',
        ],
        'type' => [
            'label' => 'Tipo',
            'placeholder' => 'Seleziona il tipo',
            'help' => 'Tipo di job (e.g., importazione, esportazione)',
            'tooltip' => 'Tipo di job',
            'helper_text' => '',
            'options' => [
                'import' => 'Importazione',
                'export' => 'Esportazione',
                'email' => 'Email',
                'notification' => 'Notifica',
                'report' => 'Report',
                'backup' => 'Backup',
                'cleanup' => 'Pulizia',
                'sync' => 'Sincronizzazione',
            ],
        ],
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome del job',
            'help' => 'Nome del job',
            'tooltip' => 'Nome del job',
            'helper_text' => '',
        ],
        'description' => [
            'label' => 'Descrizione',
            'placeholder' => 'Inserisci una descrizione',
            'help' => 'Descrizione del job',
            'tooltip' => 'Descrizione del job',
            'helper_text' => '',
        ],
        'guard_name' => [
            'label' => 'Guard',
            'placeholder' => 'Nome del guard',
            'help' => 'Guardiano del job',
            'tooltip' => 'Guard di autenticazione',
            'helper_text' => '',
        ],
        'permissions' => [
            'label' => 'Permessi',
            'placeholder' => 'Seleziona i permessi',
            'help' => 'Permessi associati al job',
            'tooltip' => 'Permessi del job',
            'helper_text' => '',
        ],
        'updated_at' => [
            'label' => 'Aggiornato il',
            'help' => 'Data dell\'ultimo aggiornamento del job',
            'tooltip' => 'Ultimo aggiornamento',
            'helper_text' => '',
        ],
        'first_name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help' => 'Nome del responsabile',
            'tooltip' => 'Nome responsabile',
            'helper_text' => '',
        ],
        'last_name' => [
            'label' => 'Cognome',
            'placeholder' => 'Inserisci il cognome',
            'help' => 'Cognome del responsabile',
            'tooltip' => 'Cognome responsabile',
            'helper_text' => '',
        ],
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Inserisci l\'email',
            'help' => 'Email del responsabile',
            'tooltip' => 'Email responsabile',
            'helper_text' => '',
        ],
        'phone' => [
            'label' => 'Telefono',
            'placeholder' => 'Inserisci il telefono',
            'help' => 'Numero di telefono del responsabile',
            'tooltip' => 'Telefono responsabile',
            'helper_text' => '',
        ],
        'address' => [
            'label' => 'Indirizzo',
            'placeholder' => 'Inserisci l\'indirizzo',
            'help' => 'Indirizzo del responsabile',
            'tooltip' => 'Indirizzo responsabile',
            'helper_text' => '',
        ],
        'city' => [
            'label' => 'Città',
            'placeholder' => 'Inserisci la città',
            'help' => 'Città del responsabile',
            'tooltip' => 'Città responsabile',
            'helper_text' => '',
        ],
        'state' => [
            'label' => 'Stato/Provincia',
            'placeholder' => 'Inserisci lo stato',
            'help' => 'Stato o provincia del responsabile',
            'tooltip' => 'Stato responsabile',
            'helper_text' => '',
        ],
        'zip_code' => [
            'label' => 'CAP',
            'placeholder' => 'Inserisci il CAP',
            'help' => 'Codice postale del responsabile',
            'tooltip' => 'CAP responsabile',
            'helper_text' => '',
        ],
        'country' => [
            'label' => 'Paese',
            'placeholder' => 'Seleziona il paese',
            'help' => 'Paese del responsabile',
            'tooltip' => 'Paese responsabile',
            'helper_text' => '',
        ],
        'company' => [
            'label' => 'Azienda',
            'placeholder' => 'Inserisci l\'azienda',
            'help' => 'Azienda del responsabile',
            'tooltip' => 'Azienda responsabile',
            'helper_text' => '',
        ],
        'position' => [
            'label' => 'Posizione',
            'placeholder' => 'Inserisci la posizione',
            'help' => 'Posizione lavorativa del responsabile',
            'tooltip' => 'Posizione responsabile',
            'helper_text' => '',
        ],
        'website' => [
            'label' => 'Sito Web',
            'placeholder' => 'Inserisci l\'URL del sito',
            'help' => 'Sito web del responsabile',
            'tooltip' => 'Sito web responsabile',
            'helper_text' => '',
        ],
        'notes' => [
            'label' => 'Note',
            'placeholder' => 'Inserisci note aggiuntive',
            'help' => 'Note aggiuntive sul job',
            'tooltip' => 'Note del job',
            'helper_text' => '',
        ],
        'priority' => [
            'label' => 'Priorità',
            'placeholder' => 'Seleziona la priorità',
            'help' => 'Priorità di esecuzione del job',
            'tooltip' => 'Priorità del job',
            'helper_text' => '',
            'options' => [
                'low' => 'Bassa',
                'normal' => 'Normale',
                'high' => 'Alta',
                'urgent' => 'Urgente',
            ],
        ],
        'scheduled_at' => [
            'label' => 'Programmato per',
            'placeholder' => 'Data e ora programmazione',
            'help' => 'Data e ora di programmazione del job',
            'tooltip' => 'Quando è programmato',
            'helper_text' => '',
        ],
        'started_at' => [
            'label' => 'Iniziato il',
            'help' => 'Data e ora di inizio del job',
            'tooltip' => 'Quando è iniziato',
            'helper_text' => '',
        ],
        'finished_at' => [
            'label' => 'Completato il',
            'help' => 'Data e ora di completamento del job',
            'tooltip' => 'Quando è completato',
            'helper_text' => '',
        ],
        'error_message' => [
            'label' => 'Messaggio di Errore',
            'placeholder' => 'Dettagli dell\'errore',
            'help' => 'Messaggio di errore in caso di fallimento',
            'tooltip' => 'Errore del job',
            'helper_text' => '',
        ],
        'retry_count' => [
            'label' => 'Conteggio Riprova',
            'help' => 'Numero di tentativi di riprova',
            'tooltip' => 'Tentativi di riprova',
            'helper_text' => '',
        ],
        'max_retries' => [
            'label' => 'Max Riprova',
            'placeholder' => 'Numero massimo di riprove',
            'help' => 'Numero massimo di tentativi di riprova',
            'tooltip' => 'Massimo tentativi',
            'helper_text' => '',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Crea Job',
            'icon' => 'heroicon-o-plus',
            'tooltip' => 'Crea un nuovo job',
        ],
        'edit' => [
            'label' => 'Modifica Job',
            'icon' => 'heroicon-o-pencil',
            'tooltip' => 'Modifica il job',
        ],
        'delete' => [
            'label' => 'Elimina Job',
            'icon' => 'heroicon-o-trash',
            'tooltip' => 'Elimina il job',
        ],
        'view' => [
            'label' => 'Visualizza Job',
            'icon' => 'heroicon-o-eye',
            'tooltip' => 'Visualizza i dettagli del job',
        ],
        'retry' => [
            'label' => 'Riprova',
            'icon' => 'heroicon-o-arrow-path',
            'tooltip' => 'Riprova l\'esecuzione del job',
        ],
        'cancel' => [
            'label' => 'Annulla',
            'icon' => 'heroicon-o-x-circle',
            'tooltip' => 'Annulla il job',
        ],
        'pause' => [
            'label' => 'Pausa',
            'icon' => 'heroicon-o-pause',
            'tooltip' => 'Metti in pausa il job',
        ],
        'resume' => [
            'label' => 'Riprendi',
            'icon' => 'heroicon-o-play',
            'tooltip' => 'Riprendi l\'esecuzione del job',
        ],
        'clear_failed' => [
            'label' => 'Pulisci Falliti',
            'icon' => 'heroicon-o-trash',
            'tooltip' => 'Elimina tutti i job falliti',
        ],
        'retry_failed' => [
            'label' => 'Riprova Falliti',
            'icon' => 'heroicon-o-arrow-path',
            'tooltip' => 'Riprova tutti i job falliti',
        ],
    ],
    'messages' => [
        'created' => 'Job creato con successo',
        'updated' => 'Job aggiornato con successo',
        'deleted' => 'Job eliminato con successo',
        'retried' => 'Job riprovato con successo',
        'cancelled' => 'Job annullato con successo',
        'paused' => 'Job messo in pausa',
        'resumed' => 'Job ripreso con successo',
        'cleared_failed' => 'Job falliti eliminati con successo',
        'retried_failed' => 'Job falliti riprovati con successo',
        'error' => 'Si è verificato un errore durante l\'operazione',
        'not_found' => 'Job non trovato',
        'already_running' => 'Il job è già in esecuzione',
        'cannot_cancel' => 'Impossibile annullare il job',
        'cannot_pause' => 'Impossibile mettere in pausa il job',
=======
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)
        'label' => 'jobs',
        'sort' => 30,
        'icon' => 'job.navigation',
    ],
    'fields' => [
        'id' => ['label' => 'ID', 'tooltip' => 'Identificatore univoco del job'],
        'queue' => ['label' => 'Coda', 'tooltip' => 'La coda a cui appartiene il job'],
        'payload' => ['label' => 'Payload', 'tooltip' => 'Dati associati al job'],
        'attempts' => ['label' => 'Tentativi', 'tooltip' => 'Numero di tentativi per eseguire il job'],
        'reserved_at' => ['label' => 'Riservato il', 'tooltip' => 'Data e ora in cui il job è stato riservato'],
        'available_at' => ['label' => 'Disponibile il', 'tooltip' => 'Data e ora in cui il job è diventato disponibile'],
        'created_at' => ['label' => 'Creato il', 'tooltip' => 'Data di creazione del job'],
        'status' => ['label' => 'Stato', 'tooltip' => 'Stato attuale del job'],
        'progress' => ['label' => 'Progresso', 'tooltip' => 'Percentuale di completamento del job'],
        'type' => ['label' => 'Tipo', 'tooltip' => 'Tipo di job (e.g., importazione, esportazione)'],
        'name' => ['label' => 'Nome', 'tooltip' => 'Nome del job'],
        'description' => ['label' => 'Descrizione', 'tooltip' => 'Descrizione del job', 'placeholder' => 'Inserisci una descrizione'],
        'guard_name' => ['label' => 'Guard', 'tooltip' => 'Guardiano del job'],
        'permissions' => ['label' => 'Permessi', 'tooltip' => 'Permessi associati al job'],
        'updated_at' => ['label' => 'Aggiornato il', 'tooltip' => 'Data dell’ultimo aggiornamento del job'],
        'first_name' => ['label' => 'Nome', 'tooltip' => 'Nome del responsabile'],
        'last_name' => ['label' => 'Cognome', 'tooltip' => 'Cognome del responsabile'],
        'select_all' => [
            'label' => 'Seleziona Tutti',
            'tooltip' => 'Seleziona tutti gli elementi disponibili',
        ],
    ],
    'actions' => [
        'import' => [
            'label' => 'Importa',
            'tooltip' => 'Importa dati da un file',
            'icon' => 'import-icon',
            'color' => 'blue',
            'fields' => [
                'import_file' => ['label' => 'Seleziona un file XLS o CSV da caricare', 'placeholder' => 'Seleziona il file da caricare'],
            ],
        ],
        'export' => [
            'label' => 'Esporta',
            'tooltip' => 'Esporta dati in un file',
            'icon' => 'export-icon',
            'color' => 'green',
            'filename_prefix' => 'Aree al',
            'columns' => [
                'name' => ['label' => 'Nome area', 'tooltip' => 'Nome dell’area da esportare'],
                'parent_name' => ['label' => 'Nome area livello superiore', 'tooltip' => 'Nome dell’area principale'],
            ],
        ],
        'run' => [
            'label' => 'Esegui',
            'icon' => 'play',
            'color' => 'green',
            'modal' => [
                'heading' => 'Esegui Job',
                'description' => 'Vuoi eseguire questo job?',
            ],
            'messages' => [
                'success' => 'Job avviato con successo',
            ],
        ],
        'stop' => [
            'label' => 'Ferma',
            'icon' => 'pause',
            'color' => 'red',
            'modal' => [
                'heading' => 'Ferma Job',
                'description' => 'Vuoi fermare questo job?',
            ],
            'messages' => [
                'success' => 'Job fermato con successo',
            ],
        ],
        'delete' => [
            'label' => 'Elimina',
            'icon' => 'trash',
            'color' => 'red',
            'modal' => [
                'heading' => 'Elimina Job',
                'description' => 'Sei sicuro di voler eliminare questo job?',
            ],
            'messages' => [
                'success' => 'Job eliminato con successo',
            ],
        ],
    ],
    'messages' => [
        'no_jobs' => 'Nessun job presente',
        'job_started' => 'Job avviato',
        'job_stopped' => 'Job fermato',
        'job_completed' => 'Job completato',
        'job_failed' => 'Job fallito',
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> de0f89b5 (.)
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)
    ],
    'statuses' => [
        'pending' => 'In Attesa',
        'processing' => 'In Elaborazione',
        'completed' => 'Completato',
        'failed' => 'Fallito',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'cancelled' => 'Annullato',
        'retrying' => 'Riprova',
        'paused' => 'In Pausa',
=======
        'stopped' => 'Fermato',
>>>>>>> de0f89b5 (.)
=======
        'stopped' => 'Fermato',
>>>>>>> 2e199498 (.)
=======
        'stopped' => 'Fermato',
>>>>>>> eaeb6531 (.)
    ],
    'types' => [
        'import' => 'Importazione',
        'export' => 'Esportazione',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'email' => 'Email',
        'notification' => 'Notifica',
        'report' => 'Report',
        'backup' => 'Backup',
        'cleanup' => 'Pulizia',
        'sync' => 'Sincronizzazione',
        'maintenance' => 'Manutenzione',
        'analysis' => 'Analisi',
    ],
    'priorities' => [
        'low' => 'Bassa',
        'normal' => 'Normale',
        'high' => 'Alta',
        'urgent' => 'Urgente',
    ],
    'filters' => [
        'status' => [
            'label' => 'Per Stato',
            'tooltip' => 'Filtra per stato del job',
        ],
        'type' => [
            'label' => 'Per Tipo',
            'tooltip' => 'Filtra per tipo di job',
        ],
        'priority' => [
            'label' => 'Per Priorità',
            'tooltip' => 'Filtra per priorità',
        ],
        'queue' => [
            'label' => 'Per Coda',
            'tooltip' => 'Filtra per coda',
        ],
        'date_range' => [
            'label' => 'Intervallo Date',
            'start_date' => 'Data Inizio',
            'end_date' => 'Data Fine',
            'tooltip' => 'Filtra per intervallo di date',
        ],
        'failed_only' => [
            'label' => 'Solo Falliti',
            'tooltip' => 'Mostra solo job falliti',
        ],
    ],
    'bulk_actions' => [
        'retry_selected' => [
            'label' => 'Riprova Selezionati',
            'icon' => 'heroicon-o-arrow-path',
        ],
        'cancel_selected' => [
            'label' => 'Annulla Selezionati',
            'icon' => 'heroicon-o-x-circle',
        ],
        'delete_selected' => [
            'label' => 'Elimina Selezionati',
            'icon' => 'heroicon-o-trash',
        ],
        'pause_selected' => [
            'label' => 'Pausa Selezionati',
            'icon' => 'heroicon-o-pause',
        ],
        'resume_selected' => [
            'label' => 'Riprendi Selezionati',
            'icon' => 'heroicon-o-play',
        ],
    ],
    'notifications' => [
        'job_started' => 'Job iniziato',
        'job_completed' => 'Job completato',
        'job_failed' => 'Job fallito',
        'job_cancelled' => 'Job annullato',
        'job_retried' => 'Job riprovato',
    ],
    'validation' => [
        'name' => [
            'required' => 'Il nome del job è obbligatorio',
            'max' => 'Il nome non può superare :max caratteri',
        ],
        'type' => [
            'required' => 'Il tipo è obbligatorio',
            'in' => 'Tipo di job non valido',
        ],
        'priority' => [
            'required' => 'La priorità è obbligatoria',
            'in' => 'Priorità non valida',
        ],
        'scheduled_at' => [
            'date' => 'La data di programmazione deve essere una data valida',
            'after' => 'La data di programmazione deve essere nel futuro',
        ],
        'max_retries' => [
            'integer' => 'Il numero massimo di riprove deve essere un numero intero',
            'min' => 'Il numero massimo di riprove deve essere almeno :min',
        ],
    ],
    'model' => [
        'label' => 'Job',
        'plural' => 'Jobs',
        'description' => 'Gestione dei processi in background',
    ],
    'search_placeholder' => 'Cerca per nome, tipo o stato...',
=======
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)
        'process' => 'Elaborazione',
        'notification' => 'Notifica',
        'cleanup' => 'Pulizia',
    ],
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> de0f89b5 (.)
=======
>>>>>>> 2e199498 (.)
=======
>>>>>>> eaeb6531 (.)
];
