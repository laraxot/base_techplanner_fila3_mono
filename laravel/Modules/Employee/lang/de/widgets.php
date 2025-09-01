<?php

declare(strict_types=1);

return [
    'todo' => [
        'title' => 'Zu erledigen',
        'description' => 'HR-Aktivitäten, die Ihre Aufmerksamkeit erfordern',
        'priority' => [
            'high' => 'Hoch',
            'medium' => 'Mittel',
            'low' => 'Niedrig',
        ],
        'due_date' => 'Fälligkeitsdatum',
        'action_button' => 'Los',
        'view_all' => 'Alle Aufgaben anzeigen',
        'empty_state' => [
            'title' => 'Alles erledigt!',
            'description' => 'Sie haben derzeit keine ausstehenden Aufgaben.',
        ],
    ],

    'upcoming_schedule' => [
        'title' => 'Nächste 7 Tage',
        'description' => 'Anstehende Termine und Veranstaltungen',
        'tabs' => [
            'all' => 'Alle',
            'absences' => 'Abwesenheiten',
            'smart_working' => 'Smart Working',
            'transfers' => 'Versetzungen',
        ],
        'status' => [
            'approved' => 'Genehmigt',
            'pending' => 'Ausstehend',
            'rejected' => 'Abgelehnt',
        ],
        'types' => [
            'absence' => 'Abwesenheit',
            'smart_working' => 'Smart Working',
            'transfer' => 'Versetzung',
        ],
        'days' => 'Tage',
        'view_all' => 'Anwesenheit anzeigen',
        'empty_state' => [
            'title' => 'Keine geplanten Ereignisse',
            'description' => 'Es gibt keine Ereignisse in den nächsten 7 Tagen.',
        ],
    ],

    'time_off_balance' => [
        'title' => 'Meine Salden',
        'description' => 'Urlaubs- und Genehmigungssalden für :month',
        'view_period' => 'Zeitraum',
        'monthly' => 'Monatlich',
        'annual' => 'Jährlich',
        'current_balance' => 'Aktueller Saldo',
        'used' => 'Verwendet',
        'total' => 'Gesamt',
        'no_limit' => 'Kein Limit',
        'negative_balance' => 'Negativer Saldo',
        'exhausted' => 'Erschöpft',
        'last_updated' => 'Zuletzt aktualisiert',
        'view_details' => 'Details anzeigen',
    ],

    'today_presence' => [
        'title' => 'Wer ist heute da',
        'description' => 'Echtzeit-Anwesenheit',
        'present' => 'Anwesend',
        'absent' => 'Abwesend',
        'present_employees' => 'Anwesende Mitarbeiter',
        'absent_employees' => 'Abwesende Mitarbeiter',
        'return_date' => 'Rückkehr',
        'last_updated' => 'Aktualisiert um',
        'view_details' => 'Details anzeigen',
    ],

    'pending_requests' => [
        'title' => 'Meine ausstehenden Anfragen',
        'description' => 'Status Ihrer Genehmigungsanfragen',
        'status' => [
            'pending' => 'Ausstehend',
            'approved' => 'Genehmigt',
            'rejected' => 'Abgelehnt',
            'under_review' => 'In Überprüfung',
        ],
        'priority' => [
            'high' => 'Hoch',
            'normal' => 'Normal',
            'low' => 'Niedrig',
        ],
        'submitted' => 'Eingereicht',
        'approver' => 'Genehmiger',
        'days_pending' => 'Tage ausstehend',
        'view' => 'Anzeigen',
        'cancel' => 'Abbrechen',
        'view_all' => 'Alle Anfragen anzeigen',
        'new_request' => 'Neue Anfrage',
        'empty_state' => [
            'title' => 'Alles verwaltet!',
            'description' => 'Alle Ihre Anfragen wurden vom Administrator bearbeitet.',
        ],
    ],

    // Existing widgets
    'time_tracking' => [
        'title' => 'Zeiterfassung',
        'description' => 'Arbeitszeitenverwaltung',
        'current_time' => 'Aktuelle Zeit',
        'session_status' => 'Sitzungsstatus',
        'clock_in' => 'Einstempeln',
        'clock_out' => 'Ausstempeln',
        'break_start' => 'Pause',
        'break_end' => 'Pause beenden',
        'total_hours' => 'Gesamtstunden',
        'break_time' => 'Pausenzeit',
        'status' => [
            'out' => 'Draußen',
            'in' => 'Drinnen',
            'break' => 'In der Pause',
        ],
    ],

    'employee_overview' => [
        'title' => 'Mitarbeiterübersicht',
        'description' => 'Allgemeine Mitarbeiterstatistiken',
        'total_employees' => 'Gesamte Mitarbeiter',
        'active_employees' => 'Aktive Mitarbeiter',
        'departments' => 'Abteilungen',
        'new_this_month' => 'Neu in diesem Monat',
    ],

    'work_hour_stats' => [
        'title' => 'Arbeitsstundenstatistiken',
        'description' => 'Zeiterfassungsanalyse',
        'daily_hours' => 'Tägliche Stunden',
        'weekly_hours' => 'Wöchentliche Stunden',
        'pending_approvals' => 'Ausstehende Genehmigungen',
        'overtime_hours' => 'Überstunden',
    ],
];