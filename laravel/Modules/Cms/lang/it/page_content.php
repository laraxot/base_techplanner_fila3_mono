<?php

declare(strict_types=1);

return [
  'navigation' => [
    'name' => 'Contenuti Pagina',
    'plural' => 'Contenuti Pagina',
    'group' => [
      'name' => 'Gestione Contenuti',
      'description' => 'Gestione dei contenuti delle pagine del sito',
    ],
    'label' => 'Contenuti Pagina',
    'sort' => '87',
    'icon' => 'heroicon-o-document-text',
  ],
  'fields' => [
    'id' => [
      'label' => 'ID',
      'placeholder' => 'ID del contenuto pagina',
      'description' => 'Identificativo univoco del contenuto',
      'helper_text' => 'Generato automaticamente dal sistema',
    ],
    'name' => [
      'label' => 'Nome',
      'placeholder' => 'Nome del contenuto',
      'description' => 'Nome identificativo del contenuto',
      'helper_text' => 'Il nome aiuta a identificare il contenuto',
    ],
    'slug' => [
      'label' => 'Slug',
      'placeholder' => 'Slug del contenuto pagina',
      'description' => 'URL amichevole per il contenuto',
      'helper_text' => 'Lo slug determina l\'URL del contenuto',
    ],
    'blocks' => [
      'label' => 'Blocchi',
      'placeholder' => 'Blocchi di contenuto',
      'description' => 'Blocchi di contenuto della pagina',
      'helper_text' => 'Configura i blocchi di contenuto da visualizzare',
    ],
    'created_at' => [
      'label' => 'Data Creazione',
      'placeholder' => 'Data e ora creazione',
      'description' => 'Data e ora di creazione del contenuto',
      'helper_text' => 'Generato automaticamente dal sistema',
    ],
    'updated_at' => [
      'label' => 'Ultima Modifica',
      'placeholder' => 'Data e ora ultima modifica',
      'description' => 'Data e ora dell\'ultima modifica',
      'helper_text' => 'Aggiornato automaticamente ad ogni modifica',
    ],
    'created_by' => [
      'label' => 'Creato da',
      'placeholder' => 'Creato da',
      'description' => 'Utente che ha creato il contenuto',
      'helper_text' => 'Identifica l\'autore del contenuto',
    ],
    'updated_by' => [
      'label' => 'Aggiornato da',
      'placeholder' => 'Aggiornato da',
      'description' => 'Utente che ha aggiornato il contenuto',
      'helper_text' => 'Identifica l\'ultimo autore delle modifiche',
    ],
    'toggleColumns' => [
      'label' => 'Mostra/Nascondi Colonne',
      'placeholder' => 'Gestisci visibilità colonne',
      'tooltip' => 'Controlla la visibilità delle colonne',
      'description' => 'Azione per mostrare o nascondere le colonne della tabella',
      'helper_text' => 'Personalizza la visualizzazione della tabella',
    ],
    'reorderRecords' => [
      'label' => 'Riordina Elementi',
      'placeholder' => 'Trascina per riordinare',
      'tooltip' => 'Riordina la sequenza degli elementi',
      'description' => 'Azione per modificare l\'ordine dei record',
      'helper_text' => 'Modifica l\'ordine di visualizzazione dei contenuti',
    ],
    'resetFilters' => [
      'label' => 'Azzera Filtri',
      'placeholder' => 'Clicca per azzerare',
      'tooltip' => 'Rimuove tutti i filtri applicati',
      'description' => 'Azione per rimuovere tutti i filtri attivi',
      'helper_text' => 'Ripristina la visualizzazione di tutti i record',
    ],
    'applyFilters' => [
      'label' => 'Applica Filtri',
      'placeholder' => 'Clicca per applicare',
      'tooltip' => 'Applica i filtri selezionati',
      'description' => 'Azione per applicare i filtri configurati',
      'helper_text' => 'Filtra i risultati in base ai criteri selezionati',
    ],
    'openFilters' => [
      'label' => 'Apri Filtri',
      'placeholder' => 'Clicca per aprire i filtri',
      'tooltip' => 'Mostra i filtri disponibili',
      'description' => 'Azione per aprire il pannello dei filtri',
      'helper_text' => 'Mostra le opzioni di filtro disponibili',
    ],
    'delete' => [
      'label' => 'Elimina',
      'placeholder' => 'Conferma eliminazione',
      'tooltip' => 'Rimuove definitivamente l\'elemento',
      'description' => 'Azione per eliminare il record selezionato',
      'helper_text' => 'Elimina definitivamente il contenuto dal sistema',
    ],
    'edit' => [
      'label' => 'Modifica',
      'placeholder' => 'Clicca per modificare',
      'tooltip' => 'Modifica l\'elemento selezionato',
      'description' => 'Azione per modificare il record',
      'helper_text' => 'Apri il form di modifica del contenuto',
    ],
    'view' => [
      'label' => 'Visualizza',
      'placeholder' => 'Clicca per visualizzare',
      'tooltip' => 'Visualizza i dettagli dell\'elemento',
      'description' => 'Azione per visualizzare il record',
      'helper_text' => 'Mostra i dettagli completi del contenuto',
    ],
  ],
  'actions' => [
    'view' => [
      'label' => 'Visualizza Contenuto',
      'tooltip' => 'Visualizza i dettagli del contenuto',
      'description' => 'Azione per visualizzare il contenuto',
    ],
    'create' => [
      'label' => 'Crea Contenuto',
      'tooltip' => 'Crea un nuovo contenuto',
      'description' => 'Azione per creare un nuovo contenuto',
    ],
    'edit' => [
      'label' => 'Modifica Contenuto',
      'tooltip' => 'Modifica il contenuto esistente',
      'description' => 'Azione per modificare il contenuto',
    ],
    'delete' => [
      'label' => 'Elimina Contenuto',
      'tooltip' => 'Elimina il contenuto',
      'description' => 'Azione per eliminare il contenuto',
    ],
    'activeLocale' => [
      'label' => 'Lingua Attiva',
      'tooltip' => 'Lingua corrente dell\'interfaccia',
      'description' => 'Lingua attualmente attiva per l\'utente',
    ],
  ],
  'messages' => [
    'created' => 'Contenuto creato con successo',
    'updated' => 'Contenuto aggiornato con successo',
    'deleted' => 'Contenuto eliminato con successo',
  ],
  'validation' => [
    'name_required' => 'Il nome è obbligatorio',
    'slug_unique' => 'Lo slug deve essere unico',
    'blocks_required' => 'I blocchi di contenuto sono obbligatori',
  ],
  'model' => [
    'label' => 'Contenuto Pagina',
    'tooltip' => 'Modello dati del contenuto pagina',
    'description' => 'Rappresentazione del modello del contenuto pagina nel sistema',
  ],
];
