<?php

declare(strict_types=1);

return [
    'active' => [
        'label' => 'Attivo',
        'color' => 'success',
        'description' => 'Utente attivo e operativo nel sistema',
        'icon' => 'heroicon-o-check-circle',
        'hex_color' => '#10b981',
    ],
    'inactive' => [
        'label' => 'Inattivo',
        'color' => 'danger',
        'description' => 'Utente non attivo, accesso disabilitato',
        'icon' => 'heroicon-o-x-circle',
        'hex_color' => '#ef4444',
    ],
    'pending' => [
        'label' => 'In attesa',
        'color' => 'warning',
        'description' => 'Registrazione in attesa di approvazione',
        'icon' => 'heroicon-o-clock',
        'hex_color' => '#f59e0b',
    ],
    'rejected' => [
        'label' => 'Rifiutato',
        'color' => 'danger',
        'description' => 'Registrazione rifiutata dal sistema',
        'icon' => 'heroicon-o-x-circle',
        'hex_color' => '#dc2626',
    ],
    'integration_requested' => [
        'label' => 'Richiesta di integrazione',
        'color' => 'warning',
        'description' => 'Richiesta di integrazione in attesa di elaborazione',
        'icon' => 'heroicon-o-arrow-path',
        'hex_color' => '#d97706',
    ],
    'integration_approved' => [
        'label' => 'Integrazione approvata',
        'color' => 'success',
        'description' => 'Richiesta di integrazione approvata',
        'icon' => 'heroicon-o-check-circle',
        'hex_color' => '#059669',
    ],
    'integration_rejected' => [
        'label' => 'Integrazione rifiutata',
        'color' => 'danger',
        'description' => 'Richiesta di integrazione respinta',
        'icon' => 'heroicon-o-x-circle',
        'hex_color' => '#dc2626',
    ],
    'integration_pending' => [
        'label' => 'Integrazione in attesa',
        'color' => 'warning',
        'description' => 'Integrazione in attesa di elaborazione',
        'icon' => 'heroicon-o-hourglass',
        'hex_color' => '#d97706',
    ],
    'integration_completed' => [
        'label' => 'Integrazione completata',
        'color' => 'success',
        'description' => 'Processo di integrazione completato con successo',
        'icon' => 'heroicon-o-check-circle',
        'hex_color' => '#10b981',
    ],
    'integration_cancelled' => [
        'label' => 'Integrazione annullata',
        'color' => 'danger',
        'description' => 'Processo di integrazione annullato',
        'icon' => 'heroicon-o-no-symbol',
        'hex_color' => '#ef4444',
    ],
    'suspended' => [
        'label' => 'Sospeso',
        'color' => 'danger',
        'description' => 'Utente temporaneamente sospeso dal sistema',
        'icon' => 'heroicon-o-pause-circle',
        'hex_color' => '#dc2626',
    ],
];