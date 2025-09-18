<?php

<<<<<<< HEAD
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
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
  ),
  'formats' => 
  array (
=======
return  [
  'navigation' => 
   [
    'name' => 'Esportazione',
    'plural' => 'Esportazioni',
    'group' => 
     [
      'name' => 'Sistema',
      'description' => 'Gestione delle esportazioni di dati',
    ],
    'label' => 'Esportazione Dati',
    'sort' => 97,
    'icon' => 'job-export',
  ],
  'fields' => 
   [
    'name' => 
     [
      'label' => 'Nome',
      'tooltip' => 'Inserisci il nome dell\'esportazione',
      'placeholder' => 'Esporta i tuoi dati',
    ],
    'format' => 
     [
      'label' => 'Formato',
      'tooltip' => 'Scegli il formato di esportazione (CSV, Excel, etc.)',
      'placeholder' => 'Seleziona formato',
    ],
    'filters' => 
     [
      'label' => 'Filtri',
      'tooltip' => 'Applica filtri per selezionare i dati da esportare',
      'placeholder' => 'Filtra i dati',
    ],
    'columns' => 
     [
      'label' => 'Colonne',
      'tooltip' => 'Seleziona le colonne da includere nell\'esportazione',
      'placeholder' => 'Seleziona colonne',
    ],
    'total_records' => 
     [
      'label' => 'Totale Record',
      'tooltip' => 'Numero totale di record da esportare',
      'placeholder' => 'Totale',
    ],
    'status' => 
     [
      'label' => 'Stato',
      'tooltip' => 'Stato dell\'esportazione',
      'placeholder' => 'Stato in corso',
    ],
    'created_at' => 
     [
      'label' => 'Creato il',
      'tooltip' => 'Data di creazione dell\'esportazione',
      'placeholder' => 'Data di creazione',
    ],
    'completed_at' => 
     [
      'label' => 'Completato il',
      'tooltip' => 'Data di completamento dell\'esportazione',
      'placeholder' => 'Data di completamento',
    ],
    'download_url' => 
     [
      'label' => 'URL Download',
      'tooltip' => 'URL per scaricare il file esportato',
      'placeholder' => 'URL del file',
    ],
    'source' => 
     [
      'label' => 'Sorgente',
      'tooltip' => 'Origine dei dati per l\'esportazione',
      'placeholder' => 'Seleziona la sorgente',
    ],
    'toggleColumns' => 
     [
      'label' => 'toggleColumns',
    ],
    'reorderRecords' => 
     [
      'label' => 'reorderRecords',
    ],
    'resetFilters' => 
     [
      'label' => 'resetFilters',
    ],
  ],
  'formats' => 
   [
>>>>>>> 4e86067 (.)
    'csv' => 'CSV',
    'excel' => 'Excel',
    'json' => 'JSON',
    'xml' => 'XML',
    'pdf' => 'PDF',
    'standard' => 'Standard',
    'extended' => 'Esteso',
    'minimal' => 'Minimo',
    'custom' => 'Personalizzato',
<<<<<<< HEAD
  ),
  'options' => 
  array (
=======
  ],
  'options' => 
   [
>>>>>>> 4e86067 (.)
    'include_headers' => 'Includi intestazioni',
    'delimiter' => 'Delimitatore',
    'encoding' => 'Codifica',
    'worksheet_name' => 'Nome foglio di lavoro',
    'chunk_size' => 'Dimensione chunk',
<<<<<<< HEAD
  ),
  'actions' => 
  array (
    'create' => 
    array (
=======
  ],
  'actions' => 
   [
    'create' => 
     [
>>>>>>> 4e86067 (.)
      'label' => 'Nuova Esportazione',
      'icon' => 'plus',
      'color' => 'success',
      'tooltip' => 'Crea una nuova esportazione di dati',
<<<<<<< HEAD
    ),
    'download' => 
    array (
=======
    ],
    'download' => 
     [
>>>>>>> 4e86067 (.)
      'label' => 'Scarica',
      'icon' => 'download',
      'color' => 'primary',
      'tooltip' => 'Scarica il file esportato',
<<<<<<< HEAD
    ),
    'cancel' => 
    array (
=======
    ],
    'cancel' => 
     [
>>>>>>> 4e86067 (.)
      'label' => 'Annulla',
      'icon' => 'times',
      'color' => 'danger',
      'tooltip' => 'Annulla l\'operazione corrente',
<<<<<<< HEAD
    ),
    'delete' => 
    array (
=======
    ],
    'delete' => 
     [
>>>>>>> 4e86067 (.)
      'label' => 'Elimina',
      'icon' => 'trash',
      'color' => 'danger',
      'tooltip' => 'Elimina l\'esportazione selezionata',
<<<<<<< HEAD
    ),
  ),
  'messages' => 
  array (
=======
    ],
  ],
  'messages' => 
   [
>>>>>>> 4e86067 (.)
    'export_queued' => 'Esportazione in coda',
    'export_processing' => 'Esportazione in corso',
    'export_completed' => 'Esportazione completata',
    'export_failed' => 'Esportazione fallita',
    'export_started' => 'Esportazione avviata',
    'no_exports' => 'Nessuna esportazione presente',
    'file_not_found' => 'File non trovato',
    'invalid_format' => 'Formato non valido',
<<<<<<< HEAD
  ),
  'statuses' => 
  array (
=======
  ],
  'statuses' => 
   [
>>>>>>> 4e86067 (.)
    'pending' => 'In Attesa',
    'processing' => 'In Elaborazione',
    'completed' => 'Completato',
    'failed' => 'Fallito',
    'downloaded' => 'Scaricato',
<<<<<<< HEAD
  ),
  'types' => 
  array (
=======
  ],
  'types' => 
   [
>>>>>>> 4e86067 (.)
    'csv' => 'CSV',
    'excel' => 'Excel',
    'json' => 'JSON',
    'xml' => 'XML',
    'pdf' => 'PDF',
<<<<<<< HEAD
  ),
);
=======
  ],
];
>>>>>>> 4e86067 (.)
