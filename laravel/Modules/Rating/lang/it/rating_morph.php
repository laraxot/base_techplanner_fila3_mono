<?php

return array (
  'pages' => 'Pagine',
  'widgets' => 'Widget',
  'navigation' => 
  array (
    'name' => 'Rating Pivot',
    'plural' => 'Rating Pivot',
    'group' => 
    array (
      'name' => 'Gestione Rating',
    ),
    'label' => 'Rating Morph',
    'sort' => 6,
    'icon' => 'rating morph.navigation',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
      'help_text' => 'Nome univoco dell\'elemento',
    ),
    'guard_name' => 
    array (
      'label' => 'Guard',
      'placeholder' => 'Seleziona la guardia',
      'help_text' => 'Definisce il contesto di sicurezza',
    ),
    'permissions' => 
    array (
      'label' => 'Permessi',
      'placeholder' => 'Seleziona i permessi',
      'help_text' => 'Permessi associati all\'elemento',
    ),
    'updated_at' => 
    array (
      'label' => 'Aggiornato il',
      'help_text' => 'Data e ora dell\'ultimo aggiornamento',
    ),
    'first_name' => 
    array (
      'label' => 'Nome',
      'placeholder' => 'Inserisci il nome',
    ),
    'last_name' => 
    array (
      'label' => 'Cognome',
      'placeholder' => 'Inserisci il cognome',
    ),
    'select_all' => 
    array (
      'label' => 'Seleziona Tutti',
      'message' => 'Seleziona tutti gli elementi disponibili',
    ),
  ),
  'actions' => 
  array (
    'import' => 
    array (
      'label' => 'Importa',
      'description' => 'Carica un file per importare dati',
      'fields' => 
      array (
        'import_file' => 
        array (
          'label' => 'File da importare',
          'placeholder' => 'Seleziona un file XLS o CSV',
          'help_text' => 'Deve essere un file valido in formato CSV o Excel',
        ),
      ),
      'messages' => 
      array (
        'success' => 'Importazione completata con successo',
        'error' => 'Errore durante l\'importazione',
      ),
    ),
    'export' => 
    array (
      'label' => 'Esporta',
      'description' => 'Esporta i dati in un file',
      'filename_prefix' => 'Aree al',
      'columns' => 
      array (
        'name' => 
        array (
          'label' => 'Nome area',
        ),
        'parent_name' => 
        array (
          'label' => 'Nome area livello superiore',
        ),
      ),
      'messages' => 
      array (
        'success' => 'Esportazione completata con successo',
        'error' => 'Errore durante l\'esportazione',
      ),
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'confirmation' => 'Sei sicuro di voler eliminare questo elemento?',
      'messages' => 
      array (
        'success' => 'Elemento eliminato con successo',
        'error' => 'Errore durante l\'eliminazione',
      ),
    ),
    'edit' => 
    array (
      'label' => 'Modifica',
      'description' => 'Modifica i dettagli dell\'elemento',
      'messages' => 
      array (
        'success' => 'Modifica salvata con successo',
        'error' => 'Errore durante il salvataggio',
      ),
    ),
    'create' => 
    array (
      'label' => 'Crea',
      'description' => 'Aggiungi un nuovo elemento',
      'messages' => 
      array (
        'success' => 'Elemento creato con successo',
        'error' => 'Errore durante la creazione',
      ),
    ),
  ),
);
