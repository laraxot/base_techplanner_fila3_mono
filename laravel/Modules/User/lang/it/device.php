<?php

return array (
  'navigation' => 
  array (
    'name' => 'Dispositivo',
    'plural' => 'Dispositivi',
    'group' => 
    array (
      'name' => 'Gestione Utenti',
      'description' => 'Gestione dei dispositivi degli utenti',
    ),
    'label' => 'device',
    'sort' => 20,
    'icon' => 'user-device',
  ),
  'fields' => 
  array (
    'first_name' => 'Nome',
    'last_name' => 'Cognome',
    'id' => 
    array (
      'label' => 'id',
    ),
    'mobile_id' => 
    array (
      'label' => 'mobile_id',
    ),
    'device' => 
    array (
      'label' => 'device',
    ),
    'platform' => 
    array (
      'label' => 'platform',
    ),
    'browser' => 
    array (
      'label' => 'browser',
    ),
    'version' => 
    array (
      'label' => 'version',
    ),
    'is_robot' => 
    array (
      'label' => 'is_robot',
    ),
    'robot' => 
    array (
      'label' => 'robot',
    ),
    'is_desktop' => 
    array (
      'label' => 'is_desktop',
    ),
    'is_mobile' => 
    array (
      'label' => 'is_mobile',
    ),
    'is_tablet' => 
    array (
      'label' => 'is_tablet',
    ),
    'is_phone' => 
    array (
      'label' => 'is_phone',
    ),
    'logout_at' => 
    array (
      'label' => 'logout_at',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
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
    'login_at' => 
    array (
      'label' => 'login_at',
    ),
  ),
  'actions' => 
  array (
    'import' => 
    array (
      'fields' => 
      array (
        'import_file' => 'Seleziona un file XLS o CSV da caricare',
      ),
    ),
    'export' => 
    array (
      'filename_prefix' => 'Aree al',
      'columns' => 
      array (
        'name' => 'Nome area',
        'parent_name' => 'Nome area livello superiore',
      ),
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
  ),
  'model' => 
  array (
    'label' => 'device.model',
  ),
);
