<?php

return array (
  'navigation' => 
  array (
    'label' => 'Ore di Lavoro',
    'group' => 'Gestione Dipendenti',
    'icon' => 'heroicon-o-clock',
    'sort' => 50,
  ),
  'resource' => 
  array (
    'label' => 'Voce Oraria',
    'plural_label' => 'Voci Orarie',
    'navigation_label' => 'Ore di Lavoro',
    'description' => 'Gestione completa delle registrazioni orarie dei dipendenti',
  ),
  'fields' => 
  array (
    'employee_id' => 
    array (
      'label' => 'Dipendente',
      'placeholder' => 'Seleziona dipendente',
      'help' => 'Il dipendente a cui appartiene questa voce oraria',
      'tooltip' => 'Identifica il dipendente per la registrazione',
      'description' => 'Campo obbligatorio per associare la voce al dipendente corretto',
    ),
    'type' => 
    array (
      'label' => 'Tipo di Voce',
      'placeholder' => 'Seleziona tipo di voce',
      'help' => 'Tipo di registrazione oraria',
      'tooltip' => 'Specifica il tipo di registrazione',
      'description' => 'Determina la natura della voce oraria',
      'options' => 
      array (
        'clock_in' => 'Entrata',
        'clock_out' => 'Uscita',
        'break_start' => 'Inizio Pausa',
        'break_end' => 'Fine Pausa',
      ),
    ),
    'timestamp' => 
    array (
      'label' => 'Data e Ora',
      'placeholder' => 'Seleziona data e ora',
      'help' => 'Data e ora della voce oraria',
      'tooltip' => 'Momento esatto della registrazione',
      'description' => 'Timestamp della registrazione oraria',
    ),
    'location_lat' => 
    array (
      'label' => 'Latitudine',
      'placeholder' => 'Coordinata GPS latitudine',
      'help' => 'Posizione GPS - latitudine',
      'tooltip' => 'Coordinate GPS per verifica posizione',
      'description' => 'Coordinate di latitudine per tracciamento posizione',
    ),
    'location_lng' => 
    array (
      'label' => 'Longitudine',
      'placeholder' => 'Coordinata GPS longitudine',
      'help' => 'Posizione GPS - longitudine',
      'tooltip' => 'Coordinate GPS per verifica posizione',
      'description' => 'Coordinate di longitudine per tracciamento posizione',
    ),
    'location_name' => 
    array (
      'label' => 'Nome Località',
      'placeholder' => 'Es: Ufficio, Casa, Cliente...',
      'help' => 'Descrizione della località di lavoro',
      'tooltip' => 'Nome descrittivo della posizione',
      'description' => 'Identificativo umano della località di lavoro',
    ),
    'device_info' => 
    array (
      'label' => 'Info Dispositivo',
      'placeholder' => 'Dettagli dispositivo utilizzato',
      'help' => 'Informazioni sul dispositivo di registrazione',
      'tooltip' => 'Dettagli tecnici del dispositivo',
      'description' => 'Metadati tecnici del dispositivo utilizzato',
    ),
    'photo_path' => 
    array (
      'label' => 'Foto Verifica',
      'placeholder' => 'Carica foto opzionale',
      'help' => 'Foto di verifica per questa registrazione',
      'tooltip' => 'Foto per documentare la presenza',
      'description' => 'Immagine di verifica opzionale per la registrazione',
    ),
    'status' => 
    array (
      'label' => 'Stato Approvazione',
      'placeholder' => 'Seleziona stato',
      'help' => 'Stato di approvazione della voce',
      'tooltip' => 'Stato corrente della voce oraria',
      'description' => 'Stato di approvazione da parte del supervisore',
      'options' => 
      array (
        'pending' => 'In Attesa',
        'approved' => 'Approvato',
        'rejected' => 'Rifiutato',
      ),
    ),
    'approved_by' => 
    array (
      'label' => 'Approvato Da',
      'placeholder' => 'Utente che ha approvato',
      'help' => 'Chi ha approvato questa voce',
      'tooltip' => 'Responsabile dell\'approvazione',
      'description' => 'Utente che ha approvato la voce oraria',
    ),
    'approved_at' => 
    array (
      'label' => 'Data Approvazione',
      'placeholder' => 'Quando è stato approvato',
      'help' => 'Data e ora di approvazione',
      'tooltip' => 'Timestamp dell\'approvazione',
      'description' => 'Data e ora quando la voce è stata approvata',
    ),
    'notes' => 
    array (
      'label' => 'Note',
      'placeholder' => 'Aggiungi note opzionali...',
      'help' => 'Note aggiuntive per questa voce',
      'tooltip' => 'Commenti aggiuntivi opzionali',
      'description' => 'Note e commenti per la registrazione',
    ),
    'created_at' => 
    array (
      'label' => 'Creato il',
      'help' => 'Data di creazione del record',
      'tooltip' => 'Timestamp di creazione',
      'description' => 'Data e ora di creazione della voce',
    ),
    'updated_at' => 
    array (
      'label' => 'Aggiornato il',
      'help' => 'Data ultimo aggiornamento',
      'tooltip' => 'Timestamp ultimo aggiornamento',
      'description' => 'Data e ora dell\'ultimo aggiornamento',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
      'help' => 'Toggle colonne tabella',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Crea Voce Oraria',
      'success' => 'Voce oraria creata con successo',
      'error' => 'Impossibile creare la voce oraria',
      'confirmation' => 'Confermi la creazione di questa voce oraria?',
      'tooltip' => 'Crea una nuova registrazione oraria',
      'modal_heading' => 'Crea Nuova Voce Oraria',
      'modal_description' => 'Compila i dettagli per la nuova registrazione',
    ),
    'edit' => 
    array (
      'label' => 'Modifica Voce Oraria',
      'success' => 'Voce oraria aggiornata con successo',
      'error' => 'Impossibile aggiornare la voce oraria',
      'confirmation' => 'Confermi le modifiche a questa voce oraria?',
      'tooltip' => 'Modifica la registrazione esistente',
      'modal_heading' => 'Modifica Voce Oraria',
      'modal_description' => 'Aggiorna i dettagli della registrazione',
    ),
    'delete' => 
    array (
      'label' => 'Elimina Voce Oraria',
      'success' => 'Voce oraria eliminata con successo',
      'error' => 'Impossibile eliminare la voce oraria',
      'confirmation' => 'Sei sicuro di voler eliminare questa voce oraria? Questa azione è irreversibile.',
      'tooltip' => 'Elimina definitivamente la registrazione',
      'modal_heading' => 'Elimina Voce Oraria',
      'modal_description' => 'Questa azione eliminerà definitivamente la voce oraria',
    ),
    'view' => 
    array (
      'label' => 'Visualizza Dettagli',
      'tooltip' => 'Visualizza tutti i dettagli della registrazione',
      'modal_heading' => 'Dettagli Voce Oraria',
      'modal_description' => 'Informazioni complete sulla registrazione',
    ),
    'approve' => 
    array (
      'label' => 'Approva Voce',
      'success' => 'Voce oraria approvata con successo',
      'error' => 'Impossibile approvare la voce oraria',
      'confirmation' => 'Confermi l\'approvazione di questa voce oraria?',
      'tooltip' => 'Approva la registrazione oraria',
      'modal_heading' => 'Approva Voce Oraria',
      'modal_description' => 'Conferma l\'approvazione di questa registrazione',
    ),
    'reject' => 
    array (
      'label' => 'Rifiuta Voce',
      'success' => 'Voce oraria rifiutata',
      'error' => 'Impossibile rifiutare la voce oraria',
      'confirmation' => 'Confermi il rifiuto di questa voce oraria?',
      'tooltip' => 'Rifiuta la registrazione oraria',
      'modal_heading' => 'Rifiuta Voce Oraria',
      'modal_description' => 'Conferma il rifiuto di questa registrazione',
    ),
    'bulk_approve' => 
    array (
      'label' => 'Approva Selezionate',
      'success' => ':count voci orarie approvate correttamente',
      'error' => 'Impossibile approvare le voci selezionate',
      'confirmation' => 'Confermi l\'approvazione di :count voci orarie?',
      'tooltip' => 'Approva tutte le voci selezionate',
    ),
    'bulk_reject' => 
    array (
      'label' => 'Rifiuta Selezionate',
      'success' => ':count voci orarie rifiutate correttamente',
      'error' => 'Impossibile rifiutare le voci selezionate',
      'confirmation' => 'Confermi il rifiuto di :count voci orarie?',
      'tooltip' => 'Rifiuta tutte le voci selezionate',
    ),
  ),
  'sections' => 
  array (
    'time_entry_details' => 
    array (
      'heading' => 'Dettagli Voce Oraria',
      'description' => 'Informazioni sulla registrazione oraria',
      'subtitle' => 'Compila i dettagli della voce oraria',
      'collapsible' => true,
      'collapsed' => false,
    ),
    'location_info' => 
    array (
      'heading' => 'Informazioni Località',
      'description' => 'Dati sulla posizione di lavoro',
      'subtitle' => 'Specifica la posizione di lavoro',
      'collapsible' => true,
      'collapsed' => true,
    ),
    'approval_info' => 
    array (
      'heading' => 'Informazioni Approvazione',
      'description' => 'Stato e dettagli approvazione',
      'subtitle' => 'Gestisci l\'approvazione della voce',
      'collapsible' => true,
      'collapsed' => true,
    ),
    'metadata' => 
    array (
      'heading' => 'Metadati',
      'description' => 'Informazioni tecniche e note',
      'subtitle' => 'Dettagli aggiuntivi e note',
      'collapsible' => true,
      'collapsed' => true,
    ),
  ),
  'filters' => 
  array (
    'employee' => 
    array (
      'label' => 'Dipendente',
      'placeholder' => 'Seleziona dipendente',
      'help' => 'Filtra per dipendente specifico',
    ),
    'entry_type' => 
    array (
      'label' => 'Tipo Voce',
      'placeholder' => 'Seleziona tipo',
      'help' => 'Filtra per tipo di registrazione',
    ),
    'date_range' => 
    array (
      'label' => 'Periodo',
      'from_date' => 'Da Data',
      'to_date' => 'A Data',
      'help' => 'Seleziona il periodo di interesse',
    ),
    'status' => 
    array (
      'label' => 'Stato',
      'placeholder' => 'Seleziona stato',
      'help' => 'Filtra per stato di approvazione',
    ),
    'today_only' => 
    array (
      'label' => 'Solo Oggi',
      'help' => 'Mostra solo le registrazioni di oggi',
    ),
    'pending_approval' => 
    array (
      'label' => 'In Attesa Approvazione',
      'help' => 'Mostra solo voci in attesa di approvazione',
    ),
  ),
  'tabs' => 
  array (
    'all' => 
    array (
      'label' => 'Tutte le Voci',
      'description' => 'Visualizza tutte le registrazioni',
      'icon' => 'heroicon-o-list-bullet',
    ),
    'today' => 
    array (
      'label' => 'Oggi',
      'description' => 'Registrazioni di oggi',
      'icon' => 'heroicon-o-calendar-days',
    ),
    'this_week' => 
    array (
      'label' => 'Questa Settimana',
      'description' => 'Registrazioni della settimana corrente',
      'icon' => 'heroicon-o-calendar',
    ),
    'pending' => 
    array (
      'label' => 'In Attesa',
      'description' => 'Voci in attesa di approvazione',
      'icon' => 'heroicon-o-clock',
    ),
    'approved' => 
    array (
      'label' => 'Approvate',
      'description' => 'Voci approvate',
      'icon' => 'heroicon-o-check-circle',
    ),
    'rejected' => 
    array (
      'label' => 'Rifiutate',
      'description' => 'Voci rifiutate',
      'icon' => 'heroicon-o-x-circle',
    ),
  ),
  'pages' => 
  array (
    'timeclock' => 
    array (
      'title' => 'Timbratura Dipendenti',
      'subtitle' => 'Registra le tue ore di lavoro facilmente',
      'heading' => 'Sistema di Timbratura',
      'description' => 'Interfaccia per la registrazione delle ore di lavoro',
      'welcome_message' => 'Benvenuto nel sistema di timbratura',
      'instructions' => 'Seleziona il tipo di registrazione e conferma',
    ),
    'list' => 
    array (
      'title' => 'Ore di Lavoro',
      'subtitle' => 'Gestione delle registrazioni orarie',
      'heading' => 'Elenco Voci Orarie',
      'description' => 'Visualizza e gestisci tutte le registrazioni orarie',
      'empty_state' => 'Nessuna voce oraria trovata',
      'loading_message' => 'Caricamento voci orarie...',
    ),
    'create' => 
    array (
      'title' => 'Nuova Voce Oraria',
      'subtitle' => 'Crea una nuova registrazione oraria',
      'heading' => 'Creazione Voce Oraria',
      'description' => 'Compila i dettagli per la nuova registrazione',
      'success_message' => 'Voce oraria creata con successo',
    ),
    'edit' => 
    array (
      'title' => 'Modifica Voce Oraria',
      'subtitle' => 'Modifica la registrazione esistente',
      'heading' => 'Modifica Voce Oraria',
      'description' => 'Aggiorna i dettagli della registrazione',
      'success_message' => 'Voce oraria aggiornata con successo',
    ),
    'view' => 
    array (
      'title' => 'Dettagli Voce Oraria',
      'subtitle' => 'Visualizza tutti i dettagli',
      'heading' => 'Dettagli Voce Oraria',
      'description' => 'Informazioni complete sulla registrazione',
    ),
  ),
  'widgets' => 
  array (
    'stats' => 
    array (
      'title' => 'Statistiche Ore di Lavoro',
      'description' => 'Panoramica delle registrazioni orarie',
      'today_entries' => 
      array (
        'label' => 'Voci di Oggi',
        'description' => 'Numero di registrazioni oggi',
        'tooltip' => 'Conteggio voci registrate oggi',
      ),
      'this_week' => 
      array (
        'label' => 'Questa Settimana',
        'description' => 'Totale ore questa settimana',
        'tooltip' => 'Ore totali lavorate questa settimana',
      ),
      'avg_daily' => 
      array (
        'label' => 'Media Giornaliera',
        'description' => 'Media ore per giorno',
        'tooltip' => 'Media delle ore lavorate per giorno',
      ),
      'pending_approval' => 
      array (
        'label' => 'In Attesa Approvazione',
        'description' => 'Voci da approvare',
        'tooltip' => 'Numero di voci in attesa di approvazione',
      ),
      'total_hours' => 
      array (
        'label' => 'Ore Totali',
        'description' => 'Totale ore lavorate',
        'tooltip' => 'Somma totale delle ore lavorate',
      ),
    ),
    'recent_activity' => 
    array (
      'title' => 'Attività Recenti',
      'description' => 'Ultime registrazioni orarie',
      'empty_state' => 'Nessuna attività recente',
      'view_all' => 'Visualizza Tutte',
      'refresh' => 'Aggiorna',
    ),
    'quick_actions' => 
    array (
      'title' => 'Azioni Rapide',
      'description' => 'Accesso veloce alle funzioni principali',
      'clock_in' => 
      array (
        'label' => 'Entrata',
        'description' => 'Registra entrata',
        'icon' => 'heroicon-o-play',
      ),
      'clock_out' => 
      array (
        'label' => 'Uscita',
        'description' => 'Registra uscita',
        'icon' => 'heroicon-o-stop',
      ),
      'break_start' => 
      array (
        'label' => 'Inizio Pausa',
        'description' => 'Inizia pausa',
        'icon' => 'heroicon-o-pause',
      ),
      'break_end' => 
      array (
        'label' => 'Fine Pausa',
        'description' => 'Termina pausa',
        'icon' => 'heroicon-o-play',
      ),
    ),
  ),
  'status' => 
  array (
    'not_clocked_in' => 
    array (
      'label' => 'Non Timbrato',
      'description' => 'Dipendente non ha ancora timbrato l\'entrata',
      'color' => 'gray',
      'icon' => 'heroicon-o-clock',
    ),
    'clocked_in' => 
    array (
      'label' => 'Timbrato in Entrata',
      'description' => 'Dipendente ha timbrato l\'entrata',
      'color' => 'green',
      'icon' => 'heroicon-o-check-circle',
    ),
    'on_break' => 
    array (
      'label' => 'In Pausa',
      'description' => 'Dipendente è in pausa',
      'color' => 'yellow',
      'icon' => 'heroicon-o-pause',
    ),
    'clocked_out' => 
    array (
      'label' => 'Timbrato in Uscita',
      'description' => 'Dipendente ha timbrato l\'uscita',
      'color' => 'red',
      'icon' => 'heroicon-o-x-circle',
    ),
    'pending' => 
    array (
      'label' => 'In Attesa',
      'description' => 'Voce in attesa di approvazione',
      'color' => 'orange',
      'icon' => 'heroicon-o-clock',
    ),
    'approved' => 
    array (
      'label' => 'Approvato',
      'description' => 'Voce approvata dal supervisore',
      'color' => 'green',
      'icon' => 'heroicon-o-check-circle',
    ),
    'rejected' => 
    array (
      'label' => 'Rifiutato',
      'description' => 'Voce rifiutata dal supervisore',
      'color' => 'red',
      'icon' => 'heroicon-o-x-circle',
    ),
  ),
  'messages' => 
  array (
    'validation' => 
    array (
      'invalid_sequence' => 'Sequenza voci non valida. Ultima voce: :last_entry',
      'duplicate_entry' => 'Esiste già una voce con questo timestamp per il dipendente',
      'outside_working_hours' => 'Registrazione disponibile dalle :start alle :end',
      'invalid_time' => 'Orario non valido per il turno di lavoro',
      'employee_required' => 'Il campo dipendente è obbligatorio',
      'type_required' => 'Il tipo di voce è obbligatorio',
      'timestamp_required' => 'La data e ora sono obbligatorie',
      'timestamp_future' => 'Non è possibile registrare voci future',
      'timestamp_past_limit' => 'Non è possibile registrare voci oltre :days giorni fa',
    ),
    'success' => 
    array (
      'entry_recorded' => 'Registrazione completata: :action alle :time',
      'data_refreshed' => 'Dati aggiornati con successo',
      'entry_created' => 'Voce oraria creata correttamente',
      'entry_updated' => 'Voce oraria aggiornata correttamente',
      'entry_deleted' => 'Voce oraria eliminata correttamente',
      'entry_approved' => 'Voce oraria approvata correttamente',
      'entry_rejected' => 'Voce oraria rifiutata correttamente',
      'bulk_approved' => ':count voci orarie approvate correttamente',
      'bulk_rejected' => ':count voci orarie rifiutate correttamente',
    ),
    'error' => 
    array (
      'user_not_found' => 'Dipendente non trovato',
      'invalid_action' => 'Azione non valida per lo stato attuale',
      'failed_to_record' => 'Errore nella registrazione: :error',
      'permission_denied' => 'Non hai i permessi per questa operazione',
      'entry_not_found' => 'Voce oraria non trovata',
      'invalid_status_transition' => 'Transizione di stato non valida',
      'approval_failed' => 'Impossibile approvare la voce: :error',
      'rejection_failed' => 'Impossibile rifiutare la voce: :error',
      'bulk_operation_failed' => 'Operazione bulk fallita: :error',
    ),
    'empty_states' => 
    array (
      'no_entries_today' => 'Nessuna voce registrata oggi',
      'no_recent_entries' => 'Nessuna voce recente disponibile',
      'no_entries_found' => 'Nessuna voce oraria trovata',
      'no_pending_approvals' => 'Nessuna voce in attesa di approvazione',
      'no_approved_entries' => 'Nessuna voce approvata trovata',
      'no_rejected_entries' => 'Nessuna voce rifiutata trovata',
    ),
    'confirmations' => 
    array (
      'delete_entry' => 'Sei sicuro di voler eliminare questa voce oraria?',
      'bulk_delete' => 'Sei sicuro di voler eliminare :count voci orarie?',
      'approve_entry' => 'Confermi l\'approvazione di questa voce oraria?',
      'reject_entry' => 'Confermi il rifiuto di questa voce oraria?',
      'bulk_approve' => 'Confermi l\'approvazione di :count voci orarie?',
      'bulk_reject' => 'Confermi il rifiuto di :count voci orarie?',
    ),
  ),
  'summary' => 
  array (
    'total_hours_worked' => 
    array (
      'label' => 'Ore Totali Lavorate',
      'description' => 'Somma totale delle ore lavorate',
      'tooltip' => 'Calcolo basato su entrate e uscite',
    ),
    'current_status' => 
    array (
      'label' => 'Stato Attuale',
      'description' => 'Stato corrente del dipendente',
      'tooltip' => 'Stato basato sull\'ultima registrazione',
    ),
    'total_entries' => 
    array (
      'label' => 'Voci Totali',
      'description' => 'Numero totale di registrazioni',
      'tooltip' => 'Conteggio di tutte le voci',
    ),
    'todays_summary' => 
    array (
      'label' => 'Riepilogo di Oggi',
      'description' => 'Panoramica delle registrazioni di oggi',
      'tooltip' => 'Statistiche giornaliere',
    ),
    'todays_entries' => 
    array (
      'label' => 'Voci di Oggi',
      'description' => 'Registrazioni effettuate oggi',
      'tooltip' => 'Lista delle voci di oggi',
    ),
    'last_entry' => 
    array (
      'label' => 'Ultima voce: :type alle :time',
      'description' => 'Ultima registrazione effettuata',
      'tooltip' => 'Dettagli dell\'ultima voce',
    ),
    'work_time' => 
    array (
      'label' => 'Tempo di Lavoro: :hours ore',
      'description' => 'Tempo totale lavorato',
      'tooltip' => 'Calcolo ore lavorate',
    ),
    'break_time' => 
    array (
      'label' => 'Tempo di Pausa: :hours ore',
      'description' => 'Tempo totale in pausa',
      'tooltip' => 'Calcolo tempo pausa',
    ),
    'overtime' => 
    array (
      'label' => 'Straordinario: :hours ore',
      'description' => 'Ore oltre l\'orario standard',
      'tooltip' => 'Calcolo ore straordinarie',
    ),
  ),
  'quick_actions' => 
  array (
    'title' => 'Azioni Rapide',
    'description' => 'Accesso veloce alle funzioni principali',
    'refresh_data' => 
    array (
      'label' => 'Aggiorna Dati',
      'description' => 'Ricarica i dati più recenti',
      'tooltip' => 'Sincronizza con il database',
    ),
    'export_data' => 
    array (
      'label' => 'Esporta Dati',
      'description' => 'Esporta i dati in formato Excel/CSV',
      'tooltip' => 'Scarica report in formato Excel',
    ),
    'view_reports' => 
    array (
      'label' => 'Visualizza Report',
      'description' => 'Accedi ai report e statistiche',
      'tooltip' => 'Apri dashboard reportistica',
    ),
    'time_clock' => 
    array (
      'label' => 'Vai alla Timbratura',
      'description' => 'Accedi al sistema di timbratura',
      'tooltip' => 'Apri interfaccia timbratura',
    ),
    'view_all' => 
    array (
      'label' => 'Visualizza Tutte le Voci',
      'description' => 'Mostra tutte le registrazioni',
      'tooltip' => 'Apri lista completa',
    ),
    'create_entry' => 
    array (
      'label' => 'Nuova Voce',
      'description' => 'Crea una nuova registrazione',
      'tooltip' => 'Apri form creazione',
    ),
    'bulk_approve' => 
    array (
      'label' => 'Approva Selezionate',
      'description' => 'Approva tutte le voci selezionate',
      'tooltip' => 'Operazione bulk approvazione',
    ),
    'bulk_reject' => 
    array (
      'label' => 'Rifiuta Selezionate',
      'description' => 'Rifiuta tutte le voci selezionate',
      'tooltip' => 'Operazione bulk rifiuto',
    ),
  ),
);
