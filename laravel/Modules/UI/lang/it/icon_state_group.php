<?php

<<<<<<< HEAD
declare(strict_types=1);

return [
    'fields' => [
        'name' => [
            'label' => 'Nome',
        ],
        'first_name' => [
            'label' => 'Nome',
        ],
        'suspended' => [
            'label' => 'Sospeso',
        ],
        'rejected' => [
            'label' => 'Rifiutato',
        ],
        'pending' => [
            'label' => 'In attesa',
        ],
        'integration_requested' => [
            'label' => 'Integrazione richiesta',
        ],
        'integration_completed' => [
            'label' => 'Integrazione completata',
        ],
        'inactive' => [
            'label' => 'Inattivo',
        ],
        'active' => [
            'label' => 'Attivo',
        ],
        'state' => [
            'label' => 'Stato',
        ],
        'state_action' => [
            'label' => 'Azione stato',
        ],
        'scheduled' => [
            'label' => 'Programmato',
        ],
        'rescheduled' => [
            'label' => 'Riprogrammato',
        ],
        'report_pending' => [
            'label' => 'Report in attesa',
        ],
        'report_completed' => [
            'label' => 'Report completato',
        ],
        'refund_to_integrate' => [
            'label' => 'Rimborso da integrare',
        ],
        'refund_pending' => [
            'label' => 'Rimborso in attesa',
        ],
        'refund_completed' => [
            'label' => 'Rimborso completato',
        ],
        'refund_accepted' => [
            'label' => 'Rimborso accettato',
        ],
        'pro_bono' => [
            'label' => 'Pro bono',
        ],
        'no_show' => [
            'label' => 'Non presentato',
        ],
        'in_progress' => [
            'label' => 'In corso',
        ],
        'd27993a5-70e9-42c2-b961-9b00ffa459dc' => [
            'label' => 'UUID specifico',
        ],
    ],
    
    'states' => [
        'active' => [
            'label' => 'Attivo',
            'description' => 'Stato attivo del sistema',
            'icon' => 'heroicon-o-check-circle',
            'color' => 'success',
        ],
        'inactive' => [
            'label' => 'Inattivo',
            'description' => 'Stato inattivo del sistema',
            'icon' => 'heroicon-o-x-circle',
            'color' => 'danger',
        ],
        'pending' => [
            'label' => 'In attesa',
            'description' => 'Stato in attesa di approvazione',
            'icon' => 'heroicon-o-clock',
            'color' => 'warning',
        ],
        'suspended' => [
            'label' => 'Sospeso',
            'description' => 'Stato sospeso temporaneamente',
            'icon' => 'heroicon-o-pause',
            'color' => 'warning',
        ],
        'rejected' => [
            'label' => 'Rifiutato',
            'description' => 'Stato rifiutato',
            'icon' => 'heroicon-o-x-mark',
            'color' => 'danger',
        ],
    ],
    
    'actions' => [
        'change_state' => [
            'label' => 'Cambia stato',
            'description' => 'Modifica lo stato corrente',
            'success' => 'Stato modificato con successo',
            'error' => 'Errore durante la modifica dello stato',
        ],
        'activate' => [
            'label' => 'Attiva',
            'description' => 'Attiva l\'elemento',
            'success' => 'Elemento attivato con successo',
        ],
        'deactivate' => [
            'label' => 'Disattiva',
            'description' => 'Disattiva l\'elemento',
            'success' => 'Elemento disattivato con successo',
        ],
        'suspend' => [
            'label' => 'Sospendi',
            'description' => 'Sospende temporaneamente l\'elemento',
            'success' => 'Elemento sospeso con successo',
        ],
        'approve' => [
            'label' => 'Approva',
            'description' => 'Approva l\'elemento',
            'success' => 'Elemento approvato con successo',
        ],
        'reject' => [
            'label' => 'Rifiuta',
            'description' => 'Rifiuta l\'elemento',
            'success' => 'Elemento rifiutato con successo',
        ],
    ],
    
    'messages' => [
        'state_changed' => 'Stato modificato da :old_state a :new_state',
        'state_change_failed' => 'Impossibile modificare lo stato',
        'invalid_transition' => 'Transizione di stato non valida',
        'state_required' => 'Lo stato è obbligatorio',
        'message_required' => 'Il messaggio è obbligatorio per questa transizione',
    ],
    
    'validation' => [
        'state_exists' => 'Lo stato selezionato non esiste',
        'transition_allowed' => 'La transizione di stato non è consentita',
        'message_min_length' => 'Il messaggio deve contenere almeno :min caratteri',
        'message_max_length' => 'Il messaggio non può superare :max caratteri',
    ],
];
=======
return array(
  'fields' =>
  array(
    'name' =>
    array(
      'label' => 'name',
    ),
    'firs_name' =>
    array(
      'label' => 'firs_name',
    ),
    'suspended' =>
    array(
      'label' => 'suspended',
    ),
    'rejected' =>
    array(
      'label' => 'rejected',
    ),
    'pending' =>
    array(
      'label' => 'pending',
    ),
    'integration_requested' =>
    array(
      'label' => 'integration_requested',
    ),
    'integration_completed' =>
    array(
      'label' => 'integration_completed',
    ),
    'inactive' =>
    array(
      'label' => 'inactive',
    ),
    'active' =>
    array(
      'label' => 'active',
    ),
    'state' =>
    array(
      'label' => 'state',
    ),
    'state-action' =>
    array(
      'label' => 'state-action',
    ),
    'scheduled' =>
    array(
      'label' => 'scheduled',
    ),
    'rescheduled' =>
    array(
      'label' => 'rescheduled',
    ),
    'report_pending' =>
    array(
      'label' => 'report_pending',
    ),
    'report_completed' =>
    array(
      'label' => 'report_completed',
    ),
    'refund_to_integrate' =>
    array(
      'label' => 'refund_to_integrate',
    ),
    'refund_pending' =>
    array(
      'label' => 'refund_pending',
    ),
    'refund_completed' =>
    array(
      'label' => 'refund_completed',
    ),
    'refund_accepted' =>
    array(
      'label' => 'refund_accepted',
    ),
    'pro_bono' =>
    array(
      'label' => 'pro_bono',
    ),
    'no_show' =>
    array(
      'label' => 'no_show',
    ),
    'in_progress' =>
    array(
      'label' => 'in_progress',
    ),
    'd27993a5-70e9-42c2-b961-9b00ffa459dc' =>
    array(
      'label' => 'd27993a5-70e9-42c2-b961-9b00ffa459dc',
    ),
    '3d1badd5-ef88-4bdf-b652-1954049dd617' =>
    array(
      'label' => '3d1badd5-ef88-4bdf-b652-1954049dd617',
    ),
    '65489aac-9238-454f-82eb-258680b5f036' =>
    array(
      'label' => '65489aac-9238-454f-82eb-258680b5f036',
    ),
    'bb926046-0237-4da1-8b0e-d7b072c697be' =>
    array(
      'label' => 'bb926046-0237-4da1-8b0e-d7b072c697be',
    ),
    '61c6d14e-59ec-4782-9dbc-a9560522a94e' =>
    array(
      'label' => '61c6d14e-59ec-4782-9dbc-a9560522a94e',
    ),
    '3a4ee0c1-4991-41fa-bd92-926549f0c3f4' =>
    array(
      'label' => '3a4ee0c1-4991-41fa-bd92-926549f0c3f4',
    ),
    'ab9bf71a-988f-4050-9a7e-9ea98037ce81' =>
    array(
      'label' => 'ab9bf71a-988f-4050-9a7e-9ea98037ce81',
    ),
    '3933cf94-86f7-48ba-afd6-064b4fbd8758' =>
    array(
      'label' => '3933cf94-86f7-48ba-afd6-064b4fbd8758',
    ),
    '3e01b53e-2101-4b5c-af81-d1885300de31' =>
    array(
      'label' => '3e01b53e-2101-4b5c-af81-d1885300de31',
    ),
    '1b3dfa44-c5a5-4c4f-a7db-30a41f1fa87f' =>
    array(
      'label' => '1b3dfa44-c5a5-4c4f-a7db-30a41f1fa87f',
    ),
    '1bbcccfd-c303-4f06-bd92-723fbc6faeeb' =>
    array(
      'label' => '1bbcccfd-c303-4f06-bd92-723fbc6faeeb',
    ),
    'scheduled-action' =>
    array(
      'label' => 'scheduled-action',
    ),
    'scheduled-icon' =>
    array(
      'label' => 'scheduled-icon',
    ),
    'rescheduled-action' =>
    array(
      'label' => 'rescheduled-action',
    ),
    'rescheduled-icon' =>
    array(
      'label' => 'rescheduled-icon',
    ),
    'report_pending-action' =>
    array(
      'label' => 'report_pending-action',
    ),
    'report_pending-icon' =>
    array(
      'label' => 'report_pending-icon',
    ),
    'report_completed-action' =>
    array(
      'label' => 'report_completed-action',
    ),
    'report_completed-icon' =>
    array(
      'label' => 'report_completed-icon',
    ),
    'rejected-action' =>
    array(
      'label' => 'rejected-action',
    ),
    'rejected-icon' =>
    array(
      'label' => 'rejected-icon',
    ),
    'refund_to_integrate-action' =>
    array(
      'label' => 'refund_to_integrate-action',
    ),
    'refund_to_integrate-icon' =>
    array(
      'label' => 'refund_to_integrate-icon',
    ),
    'refund_pending-action' =>
    array(
      'label' => 'refund_pending-action',
    ),
    'refund_pending-icon' =>
    array(
      'label' => 'refund_pending-icon',
    ),
    'refund_completed-action' =>
    array(
      'label' => 'refund_completed-action',
    ),
    'refund_completed-icon' =>
    array(
      'label' => 'refund_completed-icon',
    ),
    'refund_accepted-action' =>
    array(
      'label' => 'refund_accepted-action',
    ),
    'refund_accepted-icon' =>
    array(
      'label' => 'refund_accepted-icon',
    ),
    'pro_bono-icon' =>
    array(
      'label' => 'pro_bono-icon',
    ),
    'pending-icon' =>
    array(
      'label' => 'pending-icon',
    ),
    'no_show-icon' =>
    array(
      'label' => 'no_show-icon',
    ),
    'in_progress-icon' =>
    array(
      'label' => 'in_progress-icon',
    ),
    'confirmed-icon' =>
    array(
      'label' => 'confirmed-icon',
    ),
    'completed-icon' =>
    array(
      'label' => 'completed-icon',
    ),
    'cancelled-icon' =>
    array(
      'label' => 'cancelled-icon',
    ),
    'cancelled-action' =>
    array(
      'label' => 'cancelled-action',
    ),
    'banned-icon' =>
    array(
      'label' => 'banned-icon',
    ),
    'pro_bono-action' =>
    array(
      'label' => 'pro_bono-action',
    ),
    'pending-action' =>
    array(
      'label' => 'pending-action',
    ),
    'no_show-action' =>
    array(
      'label' => 'no_show-action',
    ),
    'in_progress-action' =>
    array(
      'label' => 'in_progress-action',
    ),
    'confirmed-action' =>
    array(
      'label' => 'confirmed-action',
    ),
    'completed-action' =>
    array(
      'label' => 'completed-action',
    ),
    'banned-action' =>
    array(
      'label' => 'banned-action',
    ),
    'scheduled-visible' =>
    array(
      'description' => 'scheduled-visible',
      'label' => 'scheduled-visible',
    ),
    'rescheduled-visible' =>
    array(
      'label' => 'rescheduled-visible',
    ),
    'suspended-action' =>
    array(
      'label' => 'suspended-action',
    ),
    'suspended-icon' =>
    array(
      'label' => 'suspended-icon',
    ),
    'integration_requested-action' =>
    array(
      'label' => 'integration_requested-action',
    ),
    'integration_requested-icon' =>
    array(
      'label' => 'integration_requested-icon',
    ),
    'integration_completed-action' =>
    array(
      'label' => 'integration_completed-action',
    ),
    'integration_completed-icon' =>
    array(
      'label' => 'integration_completed-icon',
    ),
    'inactive-action' =>
    array(
      'label' => 'inactive-action',
    ),
    'inactive-icon' =>
    array(
      'label' => 'inactive-icon',
    ),
    'active-action' =>
    array(
      'label' => 'active-action',
    ),
    'active-icon' =>
    array(
      'label' => 'active-icon',
    ),
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    'refund_integrate-action' =>
    array(
      'label' => 'refund_integrate-action',
    ),
    'refund_integrate-icon' =>
    array(
=======
=======
>>>>>>> 51da2b43 (.)
=======
>>>>>>> 8727c5b (.)
=======
>>>>>>> be3ca71 (.)
    'refund_integrate-action' => 
    array (
      'label' => 'refund_integrate-action',
    ),
    'refund_integrate-icon' => 
    array (
<<<<<<< HEAD
>>>>>>> 41f976e (.)
=======
>>>>>>> be3ca71 (.)
      'label' => 'refund_integrate-icon',
    ),
  ),
);
>>>>>>> bbf3ab4 (.)
