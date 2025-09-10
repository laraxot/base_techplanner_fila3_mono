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
    ),
    'edit' => 
    array (
      'label' => 'Modifica Appuntamento',
    ),
    'delete' => 
    array (
      'label' => 'Elimina Appuntamento',
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
