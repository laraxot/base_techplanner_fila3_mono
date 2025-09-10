<?php

<<<<<<< HEAD
return array (
  'resources' => 'Risorse',
  'pages' => 'Pagine',
  'widgets' => 'Widgets',
  'navigation' => 
  array (
    'name' => 'Feature',
    'plural' => 'Features',
    'group' => 
    array (
      'name' => 'Gestione Utenti',
      'description' => 'Gestione delle feature e delle funzionalità',
    ),
    'label' => 'feature',
    'sort' => 75,
    'icon' => 'user-user-feature',
  ),
  'fields' => 
  array (
    'name' => 'Nome',
    'guard_name' => 'Guard',
    'permissions' => 'Permessi',
    'updated_at' => 'Aggiornato il',
    'first_name' => 'Nome',
    'last_name' => 'Cognome',
    'select_all' => 
    array (
      'name' => 'Seleziona Tutti',
      'message' => '',
    ),
    'value' => 
    array (
      'label' => 'value',
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
  ),
  'model' => 
  array (
    'label' => 'feature.model',
  ),
);
=======
return [
    'resources' => 'Risorse',
    'pages' => 'Pagine',
    'widgets' => 'Widgets',
    'navigation' => [
        'name' => 'Feature',
        'plural' => 'Features',
        'group' => [
            'name' => 'Gestione Utenti',
            'description' => 'Gestione delle feature e delle funzionalità',
        ],
        'label' => 'feature',
        'sort' => 75,
        'icon' => 'user-user-feature',
    ],
    'fields' => [
        'name' => 'Nome',
        'guard_name' => 'Guard',
        'permissions' => 'Permessi',
        'updated_at' => 'Aggiornato il',
        'first_name' => 'Nome',
        'last_name' => 'Cognome',
        'select_all' => [
            'name' => 'Seleziona Tutti',
            'message' => '',
        ],
        'value' => [
            'label' => 'value',
        ],
        'toggleColumns' => [
            'label' => 'toggleColumns',
        ],
        'reorderRecords' => [
            'label' => 'reorderRecords',
        ],
        'resetFilters' => [
            'label' => 'resetFilters',
        ],
        'applyFilters' => [
            'label' => 'applyFilters',
        ],
        'openFilters' => [
            'label' => 'openFilters',
        ],
    ],
    'actions' => [
        'import' => [
            'fields' => [
                'import_file' => 'Seleziona un file XLS o CSV da caricare',
            ],
        ],
        'export' => [
            'filename_prefix' => 'Aree al',
            'columns' => [
                'name' => 'Nome area',
                'parent_name' => 'Nome area livello superiore',
            ],
        ],
    ],
    'model' => [
        'label' => 'feature.model',
    ],
];
>>>>>>> 9831a351 (.)
