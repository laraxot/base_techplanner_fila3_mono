<?php

return array (
  'navigation' => 
  array (
    'name' => 'Esportazione',
    'plural' => 'Esportazioni',
    'group' => 
    array (
      'name' => 'Sistema',
      'description' => 'Gestione delle esportazioni di dati',
    ),
    'label' => 'Esportazione Dati',
    'sort' => 97,
    'icon' => 'job-export',
  ),
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Nome',
      'tooltip' => 'Inserisci il nome dell\'esportazione',
      'placeholder' => 'Esporta i tuoi dati',
    ),
    'format' => 
    array (
      'label' => 'Formato',
      'tooltip' => 'Scegli il formato di esportazione (CSV, Excel, etc.)',
      'placeholder' => 'Seleziona formato',
    ),
    'filters' => 
    array (
      'label' => 'Filtri',
      'tooltip' => 'Applica filtri per selezionare i dati da esportare',
      'placeholder' => 'Filtra i dati',
    ),
    'columns' => 
    array (
      'label' => 'Colonne',
      'tooltip' => 'Seleziona le colonne da includere nell\'esportazione',
      'placeholder' => 'Seleziona colonne',
    ),
    'total_records' => 
    array (
      'label' => 'Totale Record',
      'tooltip' => 'Numero totale di record da esportare',
      'placeholder' => 'Totale',
    ),
    'status' => 
    array (
      'label' => 'Stato',
      'tooltip' => 'Stato dell\'esportazione',
      'placeholder' => 'Stato in corso',
    ),
    'created_at' => 
    array (
      'label' => 'Creato il',
      'tooltip' => 'Data di creazione dell\'esportazione',
      'placeholder' => 'Data di creazione',
    ),
    'completed_at' => 
    array (
      'label' => 'Completato il',
      'tooltip' => 'Data di completamento dell\'esportazione',
      'placeholder' => 'Data di completamento',
    ),
    'download_url' => 
    array (
      'label' => 'URL Download',
      'tooltip' => 'URL per scaricare il file esportato',
      'placeholder' => 'URL del file',
    ),
    'source' => 
    array (
      'label' => 'Sorgente',
      'tooltip' => 'Origine dei dati per l\'esportazione',
      'placeholder' => 'Seleziona la sorgente',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
  ),
  'formats' => 
  array (
    'csv' => 'CSV',
    'excel' => 'Excel',
    'json' => 'JSON',
    'xml' => 'XML',
    'pdf' => 'PDF',
    'standard' => 'Standard',
    'extended' => 'Esteso',
    'minimal' => 'Minimo',
    'custom' => 'Personalizzato',
  ),
  'options' => 
  array (
    'include_headers' => 'Includi intestazioni',
    'delimiter' => 'Delimitatore',
    'encoding' => 'Codifica',
    'worksheet_name' => 'Nome foglio di lavoro',
    'chunk_size' => 'Dimensione chunk',
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'label' => 'Nuova Esportazione',
      'icon' => 'plus',
      'color' => 'success',
      'tooltip' => 'Crea una nuova esportazione di dati',
    ),
    'download' => 
    array (
      'label' => 'Scarica',
      'icon' => 'download',
      'color' => 'primary',
      'tooltip' => 'Scarica il file esportato',
    ),
    'cancel' => 
    array (
      'label' => 'Annulla',
      'icon' => 'times',
      'color' => 'danger',
      'tooltip' => 'Annulla l\'operazione corrente',
    ),
    'delete' => 
    array (
      'label' => 'Elimina',
      'icon' => 'trash',
      'color' => 'danger',
      'tooltip' => 'Elimina l\'esportazione selezionata',
    ),
  ),
  'messages' => 
  array (
    'export_queued' => 'Esportazione in coda',
    'export_processing' => 'Esportazione in corso',
    'export_completed' => 'Esportazione completata',
    'export_failed' => 'Esportazione fallita',
    'export_started' => 'Esportazione avviata',
    'no_exports' => 'Nessuna esportazione presente',
    'file_not_found' => 'File non trovato',
    'invalid_format' => 'Formato non valido',
  ),
  'statuses' => 
  array (
    'pending' => 'In Attesa',
    'processing' => 'In Elaborazione',
    'completed' => 'Completato',
    'failed' => 'Fallito',
    'downloaded' => 'Scaricato',
  ),
  'types' => 
  array (
    'csv' => 'CSV',
    'excel' => 'Excel',
    'json' => 'JSON',
    'xml' => 'XML',
    'pdf' => 'PDF',
  ),
);
