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
