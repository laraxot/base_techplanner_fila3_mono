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
    ),
    'notes' => 
    array (
      'label' => 'Note',
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
  'plural' => 
  array (
    'model' => 
    array (
      'label' => 'appointment.plural.model',
    ),
  ),
);
