<?php

declare(strict_types=1);

return [
    'todo' => [
        'title' => 'Cose da fare',
        'description' => 'Attività HR che richiedono la tua attenzione',
        'priority' => [
            'high' => 'Alta',
            'medium' => 'Media',
            'low' => 'Bassa',
        ],
        'due_date' => 'Scadenza',
        'action_button' => 'Vai',
        'view_all' => 'Vedi tutte le attività',
        'empty_state' => [
            'title' => 'Tutto completato!',
            'description' => 'Non hai attività pendenti in questo momento.',
        ],
    ],

    'upcoming_schedule' => [
        'title' => 'Prossimi 7 giorni',
        'description' => 'Eventi e appuntamenti in programma',
        'tabs' => [
            'all' => 'Tutti',
            'absences' => 'Assenze',
            'smart_working' => 'Smart Working',
            'transfers' => 'Trasferte',
        ],
        'status' => [
            'approved' => 'Approvato',
            'pending' => 'In attesa',
            'rejected' => 'Rifiutato',
        ],
        'types' => [
            'absence' => 'Assenza',
            'smart_working' => 'Smart Working',
            'transfer' => 'Trasferta',
        ],
        'days' => 'giorni',
        'view_all' => 'Vedi presenze',
        'empty_state' => [
            'title' => 'Nessun evento programmato',
            'description' => 'Non ci sono eventi nei prossimi 7 giorni.',
        ],
    ],

    'time_off_balance' => [
        'title' => 'Le mie rimanenze',
        'description' => 'Saldi ferie e permessi per :month',
        'view_period' => 'Periodo',
        'monthly' => 'Mensile',
        'annual' => 'Annuale',
        'current_balance' => 'Saldo attuale',
        'used' => 'Utilizzato',
        'total' => 'Totale',
        'no_limit' => 'Nessun limite',
        'negative_balance' => 'Saldo negativo',
        'exhausted' => 'Esaurito',
        'last_updated' => 'Ultimo aggiornamento',
        'view_details' => 'Vedi dettagli',
    ],

    'today_presence' => [
        'title' => 'Chi c\'è oggi',
        'description' => 'Presenze in tempo reale',
        'present' => 'Presenti',
        'absent' => 'Assenti',
        'present_employees' => 'Dipendenti presenti',
        'absent_employees' => 'Dipendenti assenti',
        'return_date' => 'Rientro',
        'last_updated' => 'Aggiornato alle',
        'view_details' => 'Vedi dettaglio',
    ],

    'pending_requests' => [
        'title' => 'Le mie richieste in attesa',
        'description' => 'Stato delle tue richieste di approvazione',
        'status' => [
            'pending' => 'In attesa',
            'approved' => 'Approvata',
            'rejected' => 'Rifiutata',
            'under_review' => 'In revisione',
        ],
        'priority' => [
            'high' => 'Alta',
            'normal' => 'Normale',
            'low' => 'Bassa',
        ],
        'submitted' => 'Inviata',
        'approver' => 'Responsabile',
        'days_pending' => 'giorni in attesa',
        'view' => 'Visualizza',
        'cancel' => 'Annulla',
        'view_all' => 'Vedi tutte le richieste',
        'new_request' => 'Nuova richiesta',
        'empty_state' => [
            'title' => 'Tutto gestito!',
            'description' => 'Tutte le tue richieste sono state gestite dall\'amministratore.',
        ],
    ],

    // TimeClockWidget - Nuovo widget layout 3 colonne
    'time_clock' => [
        'session_active' => 'Sessione attiva',
        'session_completed' => 'Giornata completata',
        'no_entries' => 'Nessuna timbratura',
        'clock_in' => 'Timbra entrata',
        'clock_out' => 'Timbra uscita',
        'notifications' => [
            'clock_in_success' => 'Entrata registrata alle :time',
            'clock_out_success' => 'Uscita registrata alle :time',
            'already_clocked_in' => 'Sei già in sessione',
            'must_clock_in_first' => 'Devi prima timbrare l\'entrata',
            'user_not_found' => 'Profilo dipendente non trovato',
            'error_occurred' => 'Errore durante la timbratura',
        ],
    ],

    // Existing widgets
    'time_tracking' => [
        'session_active' => 'Sessione attiva',
        'clock_in' => 'Timbra entrata',
        'clock_out' => 'Timbra uscita',
        'no_entries' => 'Nessuna timbratura oggi',
        'status' => [
            'active' => 'Sessione attiva',
            'completed' => 'Giornata completata',
            'not_started' => 'Giornata non iniziata',
        ],
        'notifications' => [
            'clock_in_success' => 'Entrata registrata con successo',
            'clock_out_success' => 'Uscita registrata con successo',
            'already_clocked_in' => 'Sei già in sessione',
            'must_clock_in_first' => 'Devi prima timbrare l\'entrata',
            'user_not_found' => 'Profilo dipendente non trovato',
            'error_occurred' => 'Si è verificato un errore',
        ],
    ],

    'employee_overview' => [
        'title' => 'Panoramica dipendenti',
        'description' => 'Statistiche generali sui dipendenti',
        'total_employees' => 'Totale dipendenti',
        'active_employees' => 'Dipendenti attivi',
        'departments' => 'Dipartimenti',
        'new_this_month' => 'Nuovi questo mese',
    ],

    'work_hour_stats' => [
        'title' => 'Statistiche ore lavoro',
        'description' => 'Analisi delle timbrature',
        'daily_hours' => 'Ore giornaliere',
        'weekly_hours' => 'Ore settimanali',
        'pending_approvals' => 'Approvazioni pendenti',
        'overtime_hours' => 'Ore straordinario',
    ],
];
