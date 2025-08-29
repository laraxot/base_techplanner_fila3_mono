<?php

declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'Menu',
        'plural' => 'Menu',
        'group' => [
            'name' => 'Gestione Contenuti',
            'description' => 'Gestione dei menu di navigazione del sito',
        ],
        'label' => 'Menu',
        'sort' => '20',
        'icon' => 'heroicon-o-bars-3',
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
            'placeholder' => 'ID del menu',
            'description' => 'Identificativo univoco del menu',
            'helper_text' => 'Generato automaticamente dal sistema',
        ],
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Nome del menu',
            'tooltip' => 'Nome identificativo del menu',
            'description' => 'Nome principale del menu',
            'helper_text' => 'Il nome aiuta a identificare il menu nel sistema',
        ],
        'slug' => [
            'label' => 'Slug',
            'placeholder' => 'slug-menu',
            'tooltip' => 'URL amichevole per il menu',
            'description' => 'Identificatore URL del menu',
            'helper_text' => 'Lo slug determina l\'identificatore del menu',
        ],
        'type' => [
            'label' => 'Tipo',
            'placeholder' => 'Seleziona il tipo',
            'tooltip' => 'Tipo di menu',
            'description' => 'Tipo di menu per la navigazione',
            'helper_text' => 'Il tipo determina il comportamento del menu',
            'options' => [
                'main' => 'Principale',
                'footer' => 'Footer',
                'sidebar' => 'Barra laterale',
            ],
        ],
        'status' => [
            'label' => 'Stato',
            'placeholder' => 'Stato del menu',
            'tooltip' => 'Stato di pubblicazione del menu',
            'description' => 'Stato corrente del menu (attivo, inattivo, bozza)',
            'helper_text' => 'Controlla la visibilità del menu',
            'options' => [
                'active' => 'Attivo',
                'inactive' => 'Inattivo',
                'draft' => 'Bozza',
            ],
        ],
        'toggleColumns' => [
            'label' => 'Mostra/Nascondi Colonne',
            'placeholder' => 'Gestisci visibilità colonne',
            'tooltip' => 'Controlla la visibilità delle colonne',
            'description' => 'Azione per mostrare o nascondere le colonne della tabella',
            'helper_text' => 'Personalizza la visualizzazione della tabella',
        ],
        'message' => [
            'label' => 'Messaggio',
            'placeholder' => 'Inserisci un messaggio',
            'tooltip' => 'Messaggio informativo',
            'description' => 'Messaggio di sistema o comunicazione',
            'helper_text' => 'Messaggio da visualizzare all\'utente',
        ],
        'openFilters' => [
            'label' => 'Apri Filtri',
            'placeholder' => 'Clicca per aprire i filtri',
            'tooltip' => 'Mostra i filtri disponibili',
            'description' => 'Azione per aprire il pannello dei filtri',
            'helper_text' => 'Mostra le opzioni di filtro disponibili',
        ],
        'applyFilters' => [
            'label' => 'Applica Filtri',
            'placeholder' => 'Clicca per applicare',
            'tooltip' => 'Applica i filtri selezionati',
            'description' => 'Azione per applicare i filtri configurati',
            'helper_text' => 'Filtra i risultati in base ai criteri selezionati',
        ],
        'resetFilters' => [
            'label' => 'Azzera Filtri',
            'placeholder' => 'Clicca per azzerare',
            'tooltip' => 'Rimuove tutti i filtri applicati',
            'description' => 'Azione per rimuovere tutti i filtri attivi',
            'helper_text' => 'Ripristina la visualizzazione di tutti i record',
        ],
        'reorderRecords' => [
            'label' => 'Riordina Elementi',
            'placeholder' => 'Trascina per riordinare',
            'tooltip' => 'Riordina la sequenza degli elementi',
            'description' => 'Azione per modificare l\'ordine dei record',
            'helper_text' => 'Modifica l\'ordine di visualizzazione dei menu',
        ],
        'delete' => [
            'label' => 'Elimina',
            'placeholder' => 'Conferma eliminazione',
            'tooltip' => 'Rimuove definitivamente l\'elemento',
            'description' => 'Azione per eliminare il record selezionato',
            'helper_text' => 'Elimina definitivamente il menu dal sistema',
        ],
        'title' => [
            'label' => 'Titolo',
            'placeholder' => 'Inserisci il titolo',
            'tooltip' => 'Titolo del menu',
            'description' => 'Titolo principale del menu',
            'helper_text' => 'Il titolo sarà visibile nella navigazione',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Crea Menu',
            'tooltip' => 'Crea un nuovo menu',
            'description' => 'Azione per creare un nuovo menu',
        ],
        'edit' => [
            'label' => 'Modifica Menu',
            'tooltip' => 'Modifica il menu esistente',
            'description' => 'Azione per modificare il menu',
        ],
        'delete' => [
            'label' => 'Elimina Menu',
            'tooltip' => 'Elimina il menu',
            'description' => 'Azione per eliminare il menu',
        ],
        'sort' => [
            'label' => 'Ordina Voci',
            'tooltip' => 'Ordina le voci del menu',
            'description' => 'Azione per ordinare le voci del menu',
        ],
        'add_item' => [
            'label' => 'Aggiungi Voce',
            'tooltip' => 'Aggiungi una nuova voce al menu',
            'description' => 'Azione per aggiungere una voce al menu',
        ],
    ],
    'messages' => [
        'created' => 'Menu creato con successo',
        'updated' => 'Menu aggiornato con successo',
        'deleted' => 'Menu eliminato con successo',
        'sorted' => 'Voci del menu ordinate con successo',
        'item_added' => 'Voce aggiunta con successo',
    ],
    'validation' => [
        'name_required' => 'Il nome è obbligatorio',
        'slug_unique' => 'Lo slug deve essere unico',
        'type_in' => 'Il tipo deve essere uno tra: main, footer, sidebar',
    ],
    'model' => [
        'label' => 'Modello Menu',
        'tooltip' => 'Modello dati del menu',
        'description' => 'Rappresentazione del modello del menu nel sistema',
    ],
];
