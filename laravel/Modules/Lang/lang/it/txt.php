<?php

<<<<<<< HEAD
declare(strict_types=1);

return [
    // CAMPI DI AUTENTICAZIONE E UTENTE
    'fields' => [
        // Autenticazione
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Inserisci la tua email',
            'help' => 'Usa un indirizzo email valido',
        ],
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Inserisci la tua password',
            'help' => 'La password deve contenere almeno 8 caratteri',
        ],
        'remember' => [
            'label' => 'Ricordami',
            'placeholder' => 'Mantieni l\'accesso attivo',
            'help' => 'Ricorda le credenziali su questo dispositivo',
        ],
        'user_id' => [
            'label' => 'ID Utente',
            'placeholder' => 'Seleziona utente',
            'help' => 'Identificativo dell\'utente',
        ],
        
        // CAMPI GENERICI DI SISTEMA
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci il nome',
            'help' => 'Nome dell\'elemento',
        ],
        'slug' => [
            'label' => 'Slug',
            'placeholder' => 'Inserisci lo slug',
            'help' => 'Identificatore URL-friendly',
        ],
        'description' => [
            'label' => 'Descrizione',
            'placeholder' => 'Inserisci descrizione',
            'help' => 'Descrizione dettagliata',
        ],
        'details' => [
            'label' => 'Dettagli',
            'placeholder' => 'Inserisci dettagli',
            'help' => 'Informazioni aggiuntive',
        ],
        'value' => [
            'label' => 'Valore',
            'placeholder' => 'Inserisci il valore',
            'help' => 'Valore del campo',
        ],
        'values_list' => [
            'label' => 'Lista Valori',
            'placeholder' => 'Inserisci lista valori',
            'help' => 'Elenco dei valori disponibili',
        ],
        
        // CAMPI DI STATO E CONFIGURAZIONE
        'is_active' => [
            'label' => 'Attivo',
            'placeholder' => 'Seleziona stato',
            'help' => 'Stato di attivazione',
        ],
        'ordering' => [
            'label' => 'Ordine',
            'placeholder' => 'Inserisci ordine',
            'help' => 'Posizione nell\'ordinamento',
        ],
        'category_id' => [
            'label' => 'Categoria',
            'placeholder' => 'Seleziona categoria',
            'help' => 'Categoria di appartenenza',
        ],
        
        // CAMPI TEMPORALI
        'start_date' => [
            'label' => 'Data Inizio',
            'placeholder' => 'Seleziona data inizio',
            'help' => 'Data di inizio del periodo',
        ],
        'end_date' => [
            'label' => 'Data Fine',
            'placeholder' => 'Seleziona data fine',
            'help' => 'Data di fine del periodo',
        ],
        'test_date' => [
            'label' => 'Data Test',
            'placeholder' => 'Seleziona data test',
            'help' => 'Data per il test del sistema',
        ],
        
        // CAMPI DI TEST E DEBUG
        'test' => [
            'label' => 'Test',
            'placeholder' => 'Inserisci valore test',
            'help' => 'Campo per test del sistema',
        ],
        
        // CAMPI DI INTERFACCIA E FILTRI
        'apply_filters' => [
            'label' => 'Applica Filtri',
            'placeholder' => 'Applica i filtri selezionati',
            'help' => 'Filtra i risultati secondo i criteri',
        ],
        'toggle_columns' => [
            'label' => 'Mostra/Nascondi Colonne',
            'placeholder' => 'Gestisci visibilità colonne',
            'help' => 'Personalizza le colonne visualizzate',
        ],
        'reorder_records' => [
            'label' => 'Riordina Records',
            'placeholder' => 'Modifica ordine elementi',
            'help' => 'Trascina per riordinare',
        ],
        'reset_filters' => [
            'label' => 'Reset Filtri',
            'placeholder' => 'Ripristina filtri predefiniti',
            'help' => 'Rimuovi tutti i filtri applicati',
        ],
        'open_filters' => [
            'label' => 'Apri Filtri',
            'placeholder' => 'Mostra pannello filtri',
            'help' => 'Visualizza opzioni di filtro',
        ],
    ],
    
    // AZIONI DI SISTEMA
    'actions' => [
        // Autenticazione
        'authenticate' => [
            'label' => 'Autentica',
            'success' => 'Autenticazione completata',
            'error' => 'Errore durante l\'autenticazione',
        ],
        'login' => [
            'label' => 'Accedi',
            'success' => 'Accesso effettuato con successo',
            'error' => 'Credenziali non valide',
        ],
        
        // Operazioni CRUD
        'create' => [
            'label' => 'Crea',
            'success' => 'Elemento creato',
            'error' => 'Errore durante la creazione',
        ],
        'create_another' => [
            'label' => 'Crea Altro',
            'success' => 'Nuovo elemento creato',
            'error' => 'Errore nella creazione',
        ],
        'save' => [
            'label' => 'Salva',
            'success' => 'Salvato con successo',
            'error' => 'Errore durante il salvataggio',
        ],
        
        // Operazioni di sistema
        'request' => [
            'label' => 'Richiedi',
            'success' => 'Richiesta inviata',
            'error' => 'Errore nell\'invio della richiesta',
        ],
        'cancel' => [
            'label' => 'Annulla',
            'success' => 'Operazione annullata',
            'error' => 'Impossibile annullare',
        ],
        'open' => [
            'label' => 'Apri',
            'success' => 'Elemento aperto',
            'error' => 'Impossibile aprire',
        ],
        
        // Configurazione locale
        'active_locale' => [
            'label' => 'Lingua Attiva',
            'success' => 'Lingua cambiata',
            'error' => 'Errore nel cambio lingua',
        ],
    ],
    
    // MESSAGGI DI SISTEMA
    'messages' => [
        'system' => [
            'ready' => 'Sistema pronto',
            'loading' => 'Caricamento in corso...',
            'processing' => 'Elaborazione in corso...',
            'completed' => 'Operazione completata',
            'failed' => 'Operazione fallita',
        ],
        'validation' => [
            'required' => 'Campo obbligatorio',
            'invalid_format' => 'Formato non valido',
            'min_length' => 'Lunghezza minima non rispettata',
            'max_length' => 'Lunghezza massima superata',
        ],
    ],
];
=======
return array (
  'fields' => 
  array (
    'email' => 
    array (
      'label' => 'Email',
      'placeholder' => 'Inserisci la tua email',
      'tooltip' => 'Usa un indirizzo email valido',
      'icon' => 'heroicon-o-mail',
      'description' => 'email',
      'helper_text' => '',
    ),
    'password' => 
    array (
      'label' => 'Password',
      'placeholder' => 'Inserisci la tua password',
      'tooltip' => 'La password deve contenere almeno 8 caratteri',
      'icon' => 'heroicon-o-lock-closed',
      'description' => 'password',
      'helper_text' => '',
    ),
    'remember' => 
    array (
      'label' => 'Ricordami',
      'tooltip' => 'Mantieni l\'accesso attivo su questo dispositivo',
      'description' => 'remember',
      'helper_text' => '',
      'placeholder' => 'remember',
    ),
    'applyFilters' => 
    array (
      'label' => 'applyFilters',
    ),
    'toggleColumns' => 
    array (
      'label' => 'toggleColumns',
    ),
    'reorderRecords' => 
    array (
      'label' => 'reorderRecords',
    ),
    'options' => 
    array (
      'prefix-icon-color' => 
      array (
        'description' => 'options.prefix-icon-color',
        'helper_text' => 'options.prefix-icon-color',
        'placeholder' => 'options.prefix-icon-color',
        'label' => 'options.prefix-icon-color',
      ),
      'allow_multiple' => 
      array (
        'description' => 'options.allow_multiple',
        'label' => 'options.allow_multiple',
        'placeholder' => 'options.allow_multiple',
        'helper_text' => 'options.allow_multiple',
      ),
      'visibility' => 
      array (
        'values' => 
        array (
          'description' => 'options.visibility.values',
          'label' => 'options.visibility.values',
          'placeholder' => 'options.visibility.values',
          'helper_text' => 'options.visibility.values',
        ),
        'active' => 
        array (
          'label' => 'options.visibility.active',
          'placeholder' => 'options.visibility.active',
          'helper_text' => 'options.visibility.active',
          'description' => 'options.visibility.active',
        ),
        'fieldID' => 
        array (
          'label' => 'options.visibility.fieldID',
          'placeholder' => 'options.visibility.fieldID',
          'helper_text' => 'options.visibility.fieldID',
          'description' => 'options.visibility.fieldID',
        ),
      ),
      'confirmation-message' => 
      array (
        'label' => 'options.confirmation-message',
        'placeholder' => 'options.confirmation-message',
        'helper_text' => 'options.confirmation-message',
        'description' => 'options.confirmation-message',
      ),
      'require-login' => 
      array (
        'label' => 'options.require-login',
        'placeholder' => 'options.require-login',
        'helper_text' => 'options.require-login',
        'description' => 'options.require-login',
      ),
      'one-entry-per-user' => 
      array (
        'label' => 'options.one-entry-per-user',
        'placeholder' => 'options.one-entry-per-user',
        'helper_text' => 'options.one-entry-per-user',
        'description' => 'options.one-entry-per-user',
      ),
      'show-as' => 
      array (
        'label' => 'options.show-as',
        'placeholder' => 'options.show-as',
        'helper_text' => 'options.show-as',
        'description' => 'options.show-as',
      ),
      'emails-notification' => 
      array (
        'label' => 'options.emails-notification',
        'placeholder' => 'options.emails-notification',
        'helper_text' => 'options.emails-notification',
        'description' => 'options.emails-notification',
      ),
      'primary_color' => 
      array (
        'label' => 'options.primary_color',
        'placeholder' => 'options.primary_color',
        'helper_text' => 'options.primary_color',
        'description' => 'options.primary_color',
      ),
      'logo' => 
      array (
        'label' => 'options.logo',
        'placeholder' => 'options.logo',
        'helper_text' => 'options.logo',
        'description' => 'options.logo',
      ),
      'cover' => 
      array (
        'label' => 'options.cover',
        'placeholder' => 'options.cover',
        'helper_text' => 'options.cover',
        'description' => 'options.cover',
      ),
      'prefix-icon' => 
      array (
        'description' => 'options.prefix-icon',
        'helper_text' => 'options.prefix-icon',
        'placeholder' => 'options.prefix-icon',
        'label' => 'options.prefix-icon',
      ),
      'htmlId' => 
      array (
        'label' => 'options.htmlId',
        'placeholder' => 'options.htmlId',
        'helper_text' => 'options.htmlId',
        'description' => 'options.htmlId',
      ),
      'hint' => 
      array (
        'text' => 
        array (
          'label' => 'options.hint.text',
          'placeholder' => 'options.hint.text',
          'helper_text' => 'options.hint.text',
          'description' => 'options.hint.text',
        ),
        'icon' => 
        array (
          'label' => 'options.hint.icon',
          'placeholder' => 'options.hint.icon',
          'helper_text' => 'options.hint.icon',
          'description' => 'options.hint.icon',
        ),
        'color' => 
        array (
          'label' => 'options.hint.color',
          'placeholder' => 'options.hint.color',
          'helper_text' => 'options.hint.color',
          'description' => 'options.hint.color',
        ),
        'icon-tooltip' => 
        array (
          'label' => 'options.hint.icon-tooltip',
          'placeholder' => 'options.hint.icon-tooltip',
          'helper_text' => 'options.hint.icon-tooltip',
          'description' => 'options.hint.icon-tooltip',
        ),
      ),
      'is_required' => 
      array (
        'label' => 'options.is_required',
        'placeholder' => 'options.is_required',
        'helper_text' => 'options.is_required',
        'description' => 'options.is_required',
      ),
      'column_span_full' => 
      array (
        'label' => 'options.column_span_full',
        'placeholder' => 'options.column_span_full',
        'helper_text' => 'options.column_span_full',
        'description' => 'options.column_span_full',
      ),
      'hidden_label' => 
      array (
        'label' => 'options.hidden_label',
        'placeholder' => 'options.hidden_label',
        'helper_text' => 'options.hidden_label',
        'description' => 'options.hidden_label',
      ),
      'dataSource' => 
      array (
        'label' => 'options.dataSource',
        'placeholder' => 'options.dataSource',
        'helper_text' => 'options.dataSource',
        'description' => 'options.dataSource',
      ),
      'dateType' => 
      array (
        'label' => 'options.dateType',
        'placeholder' => 'options.dateType',
        'helper_text' => 'options.dateType',
        'description' => 'options.dateType',
      ),
      'minValue' => 
      array (
        'label' => 'options.minValue',
        'placeholder' => 'options.minValue',
        'helper_text' => 'options.minValue',
        'description' => 'options.minValue',
      ),
      'maxValue' => 
      array (
        'label' => 'options.maxValue',
        'placeholder' => 'options.maxValue',
        'helper_text' => 'options.maxValue',
        'description' => 'options.maxValue',
      ),
      'suffix' => 
      array (
        'label' => 'options.suffix',
        'placeholder' => 'options.suffix',
        'helper_text' => 'options.suffix',
        'description' => 'options.suffix',
      ),
      'suffix-icon' => 
      array (
        'label' => 'options.suffix-icon',
        'placeholder' => 'options.suffix-icon',
        'helper_text' => 'options.suffix-icon',
        'description' => 'options.suffix-icon',
      ),
      'suffix-icon-color' => 
      array (
        'label' => 'options.suffix-icon-color',
        'placeholder' => 'options.suffix-icon-color',
        'helper_text' => 'options.suffix-icon-color',
        'description' => 'options.suffix-icon-color',
      ),
      'prefix' => 
      array (
        'label' => 'options.prefix',
        'placeholder' => 'options.prefix',
        'helper_text' => 'options.prefix',
        'description' => 'options.prefix',
      ),
    ),
    'resetFilters' => 
    array (
      'label' => 'resetFilters',
    ),
    'openFilters' => 
    array (
      'label' => 'openFilters',
    ),
    'value' => 
    array (
      'description' => 'value',
      'helper_text' => '',
      'placeholder' => 'value',
      'label' => 'value',
    ),
    'values-list' => 
    array (
      'description' => 'values-list',
      'helper_text' => '',
      'placeholder' => 'values-list',
      'label' => 'values-list',
    ),
    'user_id' => 
    array (
      'label' => 'user_id',
      'placeholder' => 'user_id',
      'helper_text' => '',
      'description' => 'user_id',
    ),
    'name' => 
    array (
      'label' => 'name',
      'placeholder' => 'name',
      'helper_text' => '',
      'description' => 'name',
    ),
    'slug' => 
    array (
      'label' => 'slug',
      'placeholder' => 'slug',
      'helper_text' => '',
      'description' => 'slug',
    ),
    'category_id' => 
    array (
      'label' => 'category_id',
      'placeholder' => 'category_id',
      'helper_text' => '',
      'description' => 'category_id',
    ),
    'description' => 
    array (
      'label' => 'description',
      'placeholder' => 'description',
      'helper_text' => '',
      'description' => 'description',
    ),
    'details' => 
    array (
      'label' => 'details',
      'placeholder' => 'details',
      'helper_text' => '',
      'description' => 'details',
    ),
    'is_active' => 
    array (
      'label' => 'is_active',
      'placeholder' => 'is_active',
      'helper_text' => '',
      'description' => 'is_active',
    ),
    'ordering' => 
    array (
      'label' => 'ordering',
      'placeholder' => 'ordering',
      'helper_text' => '',
      'description' => 'ordering',
    ),
    'start_date' => 
    array (
      'label' => 'start_date',
      'placeholder' => 'start_date',
      'helper_text' => '',
      'description' => 'start_date',
    ),
    'end_date' => 
    array (
      'label' => 'end_date',
      'placeholder' => 'end_date',
      'helper_text' => '',
      'description' => 'end_date',
    ),
    'extensions' => 
    array (
      'label' => 'extensions',
      'placeholder' => 'extensions',
      'helper_text' => '',
      'description' => 'extensions',
    ),
    'sections' => 
    array (
      'label' => 'sections',
      'placeholder' => 'sections',
      'helper_text' => '',
      'description' => 'sections',
    ),
    'fields' => 
    array (
      'label' => 'fields',
      'placeholder' => 'fields',
      'helper_text' => '',
      'description' => 'fields',
    ),
    'type' => 
    array (
      'label' => 'type',
      'placeholder' => 'type',
      'helper_text' => '',
      'description' => 'type',
    ),
    'compact' => 
    array (
      'label' => 'compact',
      'placeholder' => 'compact',
      'helper_text' => '',
      'description' => 'compact',
    ),
    'aside' => 
    array (
      'label' => 'aside',
      'placeholder' => 'aside',
      'helper_text' => '',
      'description' => 'aside',
    ),
    'borderless' => 
    array (
      'label' => 'borderless',
      'placeholder' => 'borderless',
      'helper_text' => '',
      'description' => 'borderless',
    ),
    'icon' => 
    array (
      'label' => 'icon',
      'placeholder' => 'icon',
      'helper_text' => '',
      'description' => 'icon',
    ),
    'columns' => 
    array (
      'label' => 'columns',
      'placeholder' => 'columns',
      'helper_text' => '',
      'description' => 'columns',
    ),
    'itemIsDefault' => 
    array (
      'description' => 'itemIsDefault',
      'helper_text' => '',
      'placeholder' => 'itemIsDefault',
      'label' => 'itemIsDefault',
    ),
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'edit' => 
    array (
      'label' => 'edit',
    ),
    'isActive' => 
    array (
      'description' => 'isActive',
      'helper_text' => '',
      'placeholder' => 'isActive',
      'label' => 'isActive',
    ),
    'status' => 
    array (
      'label' => 'status',
    ),
    'notes' => 
    array (
      'description' => 'notes',
    ),
    'responses_count' => 
    array (
      'description' => 'responses_count',
      'helper_text' => '',
      'placeholder' => 'responses_count',
      'label' => 'responses_count',
    ),
    'itemKey' => 
    array (
      'description' => 'itemKey',
      'helper_text' => '',
      'placeholder' => 'itemKey',
      'label' => 'itemKey',
    ),
    'forms_count' => 
    array (
      'description' => 'forms_count',
      'helper_text' => '',
      'placeholder' => 'forms_count',
      'label' => 'forms_count',
    ),
    'responses_exists' => 
    array (
      'description' => 'responses_exists',
      'helper_text' => '',
      'placeholder' => 'responses_exists',
      'label' => 'responses_exists',
    ),
    'logo' => 
    array (
      'description' => 'logo',
      'helper_text' => '',
    ),
    'category' => 
    array (
      'name' => 
      array (
        'description' => 'category.name',
        'helper_text' => '',
      ),
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 0f52eb1 (.)
=======
>>>>>>> aee7a32 (.)
    ),
    'test_date' => 
    array (
      'label' => 'test_date',
      'placeholder' => 'test_date',
      'helper_text' => 'test_date',
      'description' => 'test_date',
    ),
    'test' => 
    array (
      'label' => 'test',
      'placeholder' => 'test',
      'helper_text' => 'test',
      'description' => 'test',
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 0cd7164 (.)
=======
>>>>>>> 0f52eb1 (.)
=======
>>>>>>> aee7a32 (.)
    ),
  ),
  'actions' => 
  array (
    'authenticate' => 
    array (
      'label' => 'Autentica',
      'tooltip' => 'Effettua il login nel sistema',
      'icon' => 'heroicon-o-login',
      'color' => 'primary',
    ),
    'login' => 
    array (
      'label' => 'Accedi',
      'tooltip' => 'Accedi con le tue credenziali',
      'icon' => 'heroicon-o-key',
      'color' => 'success',
    ),
    'request' => 
    array (
      'label' => 'request',
    ),
    'cancel' => 
    array (
      'label' => 'cancel',
    ),
    'save' => 
    array (
      'label' => 'save',
    ),
    'activeLocale' => 
    array (
      'label' => 'activeLocale',
    ),
    'open' => 
    array (
      'label' => 'open',
    ),
    'create' => 
    array (
      'label' => 'create',
    ),
    'createAnother' => 
    array (
      'label' => 'createAnother',
    ),
  ),
);
>>>>>>> 685d248 (.)
