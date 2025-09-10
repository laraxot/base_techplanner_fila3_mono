<?php

return array (
  'navigation' => 
  array (
    'group' => 'techplanner',
    'label' => 'Appuntamenti',
    'icon' => 'techplanner-appointment',
    'sort' => 10,
  ),
  'fields' => 
  array (
    'id' => 
    array (
      'label' => 'ID',
    ),
    'client_id' => 
    array (
      'label' => 'Cliente',
    ),
    'date' => 
    array (
      'label' => 'Data',
    ),
    'time' => 
    array (
      'label' => 'Ora',
    ),
    'status' => 
    array (
      'label' => 'Stato',
      'options' => 
      array (
        'scheduled' => 'Programmato',
        'confirmed' => 'Confermato',
        'completed' => 'Completato',
        'cancelled' => 'Annullato',
      ),
      'helper_text' => 'status',
    ),
    'notes' => 
    array (
      'label' => 'Note',
      'helper_text' => 'notes',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'layout' => 
    array (
      'label' => 'layout',
    ),
    'attach' => 
    array (
      'label' => 'attach',
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
    'machines_count' => 
    array (
      'label' => 'machines_count',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'detach' => 
    array (
      'label' => 'detach',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
  ),
      'actions' =>
      array (
        'create' =>
        array (
          'label' => 'Nuovo Appuntamento',
          'tooltip' => 'Crea un nuovo appuntamento',
          'icon' => 'heroicon-o-plus',
          'color' => 'primary',
          'modal_heading' => 'Crea Nuovo Appuntamento',
          'modal_description' => 'Inserisci i dettagli per il nuovo appuntamento',
          'success' => 'Appuntamento creato con successo',
          'error' => 'Errore durante la creazione dell\'appuntamento',
        ),
        'edit' =>
        array (
          'label' => 'Modifica Appuntamento',
          'tooltip' => 'Modifica l\'appuntamento selezionato',
          'icon' => 'heroicon-o-pencil',
          'color' => 'warning',
          'modal_heading' => 'Modifica Appuntamento',
          'modal_description' => 'Aggiorna i dettagli dell\'appuntamento',
          'success' => 'Appuntamento aggiornato con successo',
          'error' => 'Errore durante l\'aggiornamento dell\'appuntamento',
        ),
        'delete' =>
        array (
          'label' => 'Elimina Appuntamento',
          'tooltip' => 'Elimina l\'appuntamento selezionato',
          'icon' => 'heroicon-o-trash',
          'color' => 'danger',
          'modal_heading' => 'Elimina Appuntamento',
          'modal_description' => 'Sei sicuro di voler eliminare questo appuntamento? Questa azione è irreversibile.',
          'success' => 'Appuntamento eliminato con successo',
          'error' => 'Errore durante l\'eliminazione dell\'appuntamento',
          'confirmation' => 'Sei sicuro di voler eliminare questo appuntamento?',
        ),
        'view' =>
        array (
          'label' => 'Visualizza Appuntamento',
          'tooltip' => 'Visualizza i dettagli dell\'appuntamento',
          'icon' => 'heroicon-o-eye',
          'color' => 'info',
        ),
        'bulk_actions' =>
        array (
          'delete' =>
          array (
            'label' => 'Elimina Selezionati',
            'tooltip' => 'Elimina gli appuntamenti selezionati',
            'icon' => 'heroicon-o-trash',
            'color' => 'danger',
            'modal_heading' => 'Elimina Appuntamenti Selezionati',
            'modal_description' => 'Sei sicuro di voler eliminare gli appuntamenti selezionati? Questa azione è irreversibile.',
            'success' => 'Appuntamenti eliminati con successo',
            'error' => 'Errore durante l\'eliminazione degli appuntamenti',
          ),
        ),
      ),
  'messages' => 
  array (
    'created' => 'Appuntamento creato con successo',
    'updated' => 'Appuntamento aggiornato con successo',
    'deleted' => 'Appuntamento eliminato con successo',
  ),
  'model' => 
  array (
    'label' => 'Appuntamento',
    'plural' => 'Appuntamenti',
  ),
);
