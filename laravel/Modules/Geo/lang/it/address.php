<?php

declare(strict_types=1);

return [
<<<<<<< HEAD
    'singular' => 'Indirizzo',
    'plural' => 'Indirizzi',
    'navigation' => [
        'sort' => 96,
        'icon' => 'heroicon-o-map-pin',
        'group' => 'Geo',
    ],
    'actions' => [
        'create' => 'Crea indirizzo',
        'edit' => 'Modifica indirizzo',
        'view' => 'Visualizza indirizzo',
        'delete' => 'Elimina indirizzo',
        'set_primary' => 'Imposta come principale',
        'verify' => 'Verifica indirizzo',
        'geocode' => 'Geocodifica',
    ],
    'fields' => [
        'model_type' => [
            'label' => 'Tipo modello',
            'placeholder' => 'Seleziona il tipo di modello',
            'help' => 'Tipo di modello associato all\'indirizzo',
            'description' => 'Tipo del modello che possiede questo indirizzo',
            'helper_text' => '',
        ],
        'model_id' => [
            'label' => 'ID modello',
            'placeholder' => 'Inserisci ID del modello',
            'help' => 'Identificativo del modello associato',
            'description' => 'ID del modello che possiede questo indirizzo',
            'helper_text' => '',
        ],
        'name' => [
            'label' => 'Nome',
            'placeholder' => 'Inserisci un nome per l\'indirizzo',
            'help' => 'Un nome identificativo per questo indirizzo, es. "Casa" o "Ufficio"',
            'helper_text' => '',
            'description' => 'Nome identificativo dell\'indirizzo',
        ],
        'description' => [
            'label' => 'Descrizione',
            'placeholder' => 'Inserisci una descrizione',
            'help' => 'Note aggiuntive sull\'indirizzo',
            'description' => 'Descrizione aggiuntiva dell\'indirizzo',
            'helper_text' => '',
        ],
        'route' => [
            'label' => 'Via',
            'placeholder' => 'Inserisci la via',
            'help' => 'Nome della via o strada',
            'description' => 'Nome della strada o via',
            'helper_text' => '',
        ],
        'street_number' => [
            'label' => 'Numero civico',
            'placeholder' => 'Inserisci il numero civico',
            'help' => 'Numero civico dell\'indirizzo',
            'description' => 'Numero civico dell\'edificio',
            'helper_text' => '',
        ],
        'locality' => [
            'label' => 'Località',
            'placeholder' => 'Inserisci la località',
            'help' => 'Nome della località o frazione',
            'description' => 'Località o frazione dell\'indirizzo',
            'helper_text' => '',
        ],
        'administrative_area_level_1' => [
            'label' => 'Regione',
            'placeholder' => 'Seleziona la regione',
            'help' => 'Regione dell\'indirizzo',
            'description' => 'Regione o stato dell\'indirizzo',
            'helper_text' => '',
        ],
        'administrative_area_level_2' => [
            'label' => 'Provincia',
            'placeholder' => 'Seleziona la provincia',
            'help' => 'Provincia dell\'indirizzo',
            'description' => 'Provincia o contea dell\'indirizzo',
            'helper_text' => '',
        ],
        'postal_code' => [
            'label' => 'CAP',
            'placeholder' => 'Inserisci il CAP',
            'help' => 'Codice di avviamento postale',
            'description' => 'Codice postale dell\'indirizzo',
            'helper_text' => '',
        ],
        'country' => [
            'label' => 'Paese',
            'placeholder' => 'Seleziona il paese',
            'help' => 'Paese dell\'indirizzo',
            'description' => 'Paese dell\'indirizzo',
            'helper_text' => '',
        ],
        'latitude' => [
            'label' => 'Latitudine',
            'placeholder' => 'Inserisci la latitudine',
            'help' => 'Coordinate geografiche - latitudine',
            'description' => 'Latitudine dell\'indirizzo',
            'helper_text' => '',
        ],
        'longitude' => [
            'label' => 'Longitudine',
            'placeholder' => 'Inserisci la longitudine',
            'help' => 'Coordinate geografiche - longitudine',
            'description' => 'Longitudine dell\'indirizzo',
            'helper_text' => '',
        ],
        'is_primary' => [
            'label' => 'Indirizzo principale',
            'placeholder' => 'Seleziona se è l\'indirizzo principale',
            'help' => 'Indica se questo è l\'indirizzo principale',
            'description' => 'Indirizzo principale per questa entità',
            'helper_text' => '',
        ],
        'type' => [
            'label' => 'Tipo indirizzo',
            'placeholder' => 'Seleziona il tipo di indirizzo',
            'help' => 'Tipo di indirizzo (casa, ufficio, ecc.)',
            'description' => 'Categoria dell\'indirizzo',
            'helper_text' => '',
        ],
        'formatted_address' => [
            'label' => 'Indirizzo formattato',
            'placeholder' => 'Indirizzo completo formattato',
            'help' => 'Indirizzo completo formattato automaticamente',
            'description' => 'Indirizzo completo in formato leggibile',
            'helper_text' => '',
        ],
        'place_id' => [
            'label' => 'ID luogo',
            'placeholder' => 'ID univoco del luogo',
            'help' => 'Identificativo univoco del luogo da Google Maps',
            'description' => 'ID del luogo da Google Maps',
            'helper_text' => '',
        ],
        'geometry' => [
            'label' => 'Geometria',
            'placeholder' => 'Dati geometrici del luogo',
            'help' => 'Informazioni geometriche del luogo',
            'description' => 'Dati geometrici e coordinate del luogo',
            'helper_text' => '',
        ],
        'viewport' => [
            'label' => 'Viewport',
            'placeholder' => 'Area di visualizzazione della mappa',
            'help' => 'Area di visualizzazione ottimale per la mappa',
            'description' => 'Area di visualizzazione della mappa',
            'helper_text' => '',
        ],
        'bounds' => [
            'label' => 'Limiti',
            'placeholder' => 'Limiti geografici del luogo',
            'help' => 'Limiti geografici del luogo',
            'description' => 'Limiti geografici del luogo',
            'helper_text' => '',
        ],
    ],
    'selects' => [
        'administrative_area_level_1' => [
            'label' => 'Regione',
            'placeholder' => 'Seleziona la regione',
            'helper_text' => 'Regione o stato dell\'indirizzo',
            'description' => 'Regione dell\'indirizzo',
        ],
        'administrative_area_level_2' => [
            'label' => 'Provincia',
            'placeholder' => 'Seleziona la provincia',
            'helper_text' => 'Provincia o contea dell\'indirizzo',
            'description' => 'Provincia dell\'indirizzo',
        ],
        'locality' => [
            'label' => 'Località',
            'placeholder' => 'Seleziona la località',
            'helper_text' => 'Località o frazione dell\'indirizzo',
            'description' => 'Località dell\'indirizzo',
        ],
        'postal_code' => [
            'label' => 'CAP',
            'placeholder' => 'Inserisci il CAP',
            'helper_text' => 'Codice postale dell\'indirizzo',
            'description' => 'CAP dell\'indirizzo',
        ],
    ],
    'validation' => [
        'street_required' => 'La via è obbligatoria',
        'city_required' => 'La città è obbligatoria',
        'postal_code_required' => 'Il CAP è obbligatorio',
        'country_required' => 'Il paese è obbligatorio',
        'coordinates_invalid' => 'Le coordinate geografiche non sono valide',
        'model_type_required' => 'Il tipo di modello è obbligatorio',
        'model_id_required' => 'L\'ID del modello è obbligatorio',
=======
  'singular' => 'Indirizzo',
  'plural' => 'Indirizzi',
  'navigation' => [
    'sort' => 96,
    'icon' => 'heroicon-o-map-pin',
    'group' => 'Geo',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
  ],
  'actions' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
  ),
  'actions' => 
  array (
>>>>>>> a93f634 (.)
    'create' => 'Crea indirizzo',
    'edit' => 'Modifica indirizzo',
    'view' => 'Visualizza indirizzo',
    'delete' => 'Elimina indirizzo',
    'set_primary' => 'Imposta come principale',
    'verify' => 'Verifica indirizzo',
    'geocode' => 'Geocodifica',
  ],
  'fields' => [
    'model_type' => [
      'label' => 'Tipo modello',
      'placeholder' => 'Seleziona il tipo di modello',
      'help' => 'Tipo di modello associato all\'indirizzo',
      'description' => 'Tipo del modello che possiede questo indirizzo',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'model_id' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
    ),
    'model_id' => 
    array (
>>>>>>> a93f634 (.)
      'label' => 'ID modello',
      'placeholder' => 'Inserisci ID del modello',
      'help' => 'Identificativo del modello associato',
      'description' => 'ID del modello che possiede questo indirizzo',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'name' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
    ),
    'name' => 
    array (
>>>>>>> a93f634 (.)
      'label' => 'Nome',
      'placeholder' => 'Inserisci un nome per l\'indirizzo',
      'help' => 'Un nome identificativo per questo indirizzo, es. "Casa" o "Ufficio"',
      'helper_text' => '',
      'description' => 'Nome identificativo dell\'indirizzo',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'description' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
    ),
    'description' => 
    array (
>>>>>>> a93f634 (.)
      'label' => 'Descrizione',
      'placeholder' => 'Inserisci una descrizione',
      'help' => 'Note aggiuntive sull\'indirizzo',
      'description' => 'Descrizione aggiuntiva dell\'indirizzo',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'route' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
    ),
    'route' => 
    array (
>>>>>>> a93f634 (.)
      'label' => 'Via',
      'placeholder' => 'Inserisci la via',
      'help' => 'Nome della via o strada',
      'description' => 'Nome della via o strada',
      'helper_text' => '',
<<<<<<< HEAD
>>>>>>> ea4011f (.)
    ],
    'messages' => [
        'address_created' => 'Indirizzo creato con successo',
        'address_updated' => 'Indirizzo aggiornato con successo',
        'address_deleted' => 'Indirizzo eliminato con successo',
        'geocoding_success' => 'Geocoding completato con successo',
        'geocoding_error' => 'Errore durante il geocoding',
        'address_verified' => 'Indirizzo verificato con successo',
        'address_set_primary' => 'Indirizzo impostato come principale',
    ],
<<<<<<< HEAD
=======
    'locality' => [
=======
    ),
    'street_number' => 
    array (
      'label' => 'Numero civico',
      'placeholder' => 'Inserisci il numero civico',
      'help' => 'Numero civico dell\'edificio',
      'description' => 'Numero civico dell\'edificio',
      'helper_text' => '',
    ),
    'locality' => 
    array (
>>>>>>> f0f95d7 (.)
      'label' => 'Città',
      'placeholder' => 'Inserisci la città',
      'help' => 'Nome della città o località',
      'description' => 'Nome della città o località',
      'helper_text' => '',
    ],
    'administrative_area_level_3' => [
      'label' => 'Comune',
      'placeholder' => 'Inserisci il comune',
      'help' => 'Comune di appartenenza',
      'description' => 'Comune di appartenenza',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'administrative_area_level_2' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
    ),
    'administrative_area_level_2' => 
    array (
>>>>>>> a93f634 (.)
      'label' => 'Provincia',
      'placeholder' => 'Inserisci la provincia',
      'help' => 'Provincia di appartenenza',
      'description' => 'Provincia di appartenenza',
      'helper_text' => '',
    ],
    'administrative_area_level_1' => [
      'label' => 'Regione',
      'placeholder' => 'Inserisci la regione',
      'help' => 'Regione amministrativa',
      'description' => 'Regione di appartenenza',
      'helper_text' => '',
    ],
    'country' => [
      'label' => 'Paese',
      'placeholder' => 'Inserisci il paese',
      'help' => 'Paese di appartenenza',
      'description' => 'Paese di appartenenza',
      'helper_text' => '',
    ],
    'postal_code' => [
      'label' => 'CAP',
      'placeholder' => 'Inserisci il CAP',
      'help' => 'Codice di avviamento postale',
      'description' => 'Codice di avviamento postale',
      'helper_text' => '',
    ],
    'formatted_address' => [
      'label' => 'Indirizzo formattato',
      'placeholder' => 'Indirizzo formattato completo',
      'help' => 'Indirizzo completo formattato',
      'description' => 'Indirizzo completo formattato',
      'helper_text' => '',
    ],
    'place_id' => [
      'label' => 'ID luogo',
      'placeholder' => 'ID riferimento Google Maps',
      'help' => 'Identificativo Google Maps del luogo',
      'description' => 'Identificativo Google Maps del luogo',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'latitude' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
    ),
    'latitude' => 
    array (
>>>>>>> a93f634 (.)
      'label' => 'Latitudine',
      'placeholder' => 'Inserisci la latitudine',
      'help' => 'Coordinate geografiche latitudine',
      'description' => 'Coordinate geografiche latitudine',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'longitude' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
    ),
    'longitude' => 
    array (
>>>>>>> a93f634 (.)
      'label' => 'Longitudine',
      'placeholder' => 'Inserisci la longitudine',
      'help' => 'Coordinate geografiche longitudine',
      'description' => 'Coordinate geografiche longitudine',
      'helper_text' => '',
    ],
    'type' => [
      'label' => 'Tipo',
      'placeholder' => 'Seleziona il tipo di indirizzo',
      'help' => 'Tipo di indirizzo (casa, lavoro, ecc.)',
      'description' => 'Tipo di indirizzo',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      'options' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
      'options' => 
      array (
>>>>>>> a93f634 (.)
        'billing' => 'Fatturazione',
        'shipping' => 'Spedizione',
        'home' => 'Casa',
        'work' => 'Lavoro',
        'other' => 'Altro',
      ],
    ],
    'is_primary' => [
      'label' => 'Principale',
      'helper' => 'Imposta questo indirizzo come indirizzo principale',
      'description' => 'Indirizzo principale',
      'helper_text' => '',
      'placeholder' => 'Imposta come principale',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'extra_data' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
    ),
    'extra_data' => 
    array (
>>>>>>> a93f634 (.)
      'label' => 'Dati aggiuntivi',
      'placeholder' => 'Inserisci dati aggiuntivi',
      'help' => 'Informazioni aggiuntive sull\'indirizzo',
      'description' => 'Dati aggiuntivi dell\'indirizzo',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      'helper_text' => '',
    ],
    'full_address' => [
      'label' => 'Indirizzo completo',
      'placeholder' => '',
      'help' => 'Indirizzo completo formattato',
      'description' => 'Indirizzo completo formattato',
      'helper_text' => '',
    ],
    'street_address' => [
      'label' => 'Indirizzo stradale',
      'placeholder' => '',
      'help' => 'Indirizzo stradale completo',
      'description' => 'Indirizzo stradale completo',
      'helper_text' => '',
    ],
    'map' => [
      'label' => 'Mappa',
      'placeholder' => '',
      'help' => 'Visualizzazione su mappa',
      'description' => 'Visualizzazione su mappa',
      'helper_text' => '',
    ],
    'cap' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
      'helper_text' => '',
    ),
    'full_address' => 
    array (
      'label' => 'Indirizzo completo',
      'placeholder' => '',
      'help' => 'Indirizzo completo formattato',
      'description' => 'Indirizzo completo formattato',
      'helper_text' => '',
    ),
    'street_address' => 
    array (
      'label' => 'Indirizzo stradale',
      'placeholder' => '',
      'help' => 'Indirizzo stradale completo',
      'description' => 'Indirizzo stradale completo',
      'helper_text' => '',
    ),
    'map' => 
    array (
      'label' => 'Mappa',
      'placeholder' => '',
      'help' => 'Visualizzazione su mappa',
      'description' => 'Visualizzazione su mappa',
      'helper_text' => '',
    ),
    'cap' => 
    array (
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> a93f634 (.)
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
      'label' => 'CAP',
      'placeholder' => 'Inserisci il CAP',
      'help' => 'Codice di Avviamento Postale',
      'description' => 'Codice di Avviamento Postale',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'region' => [
=======
    ),
    'region' => 
    array (
>>>>>>> a93f634 (.)
=======
    ),
    'region' => 
    array (
>>>>>>> f90a9bb (.)
=======
    ),
    'region' => 
    array (
>>>>>>> f0f95d7 (.)
      'label' => 'Regione',
      'placeholder' => 'Inserisci la regione',
      'help' => 'Regione di appartenenza',
      'description' => 'Regione di appartenenza',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
    'province' => [
=======
    ),
    'province' => 
    array (
>>>>>>> a93f634 (.)
=======
    ),
    'province' => 
    array (
>>>>>>> f90a9bb (.)
=======
    ),
    'province' => 
    array (
>>>>>>> f0f95d7 (.)
      'label' => 'Provincia',
      'placeholder' => 'Inserisci la provincia',
      'help' => 'Provincia di appartenenza',
      'description' => 'Provincia di appartenenza',
      'helper_text' => '',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ],
  ],
  'columns' => [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
    ),
  ),
  'columns' => 
  array (
>>>>>>> a93f634 (.)
    'name' => 'Nome',
    'full_address' => 'Indirizzo completo',
    'type' => 'Tipo',
    'is_primary' => 'Principale',
    'locality' => 'Città',
    'postal_code' => 'CAP',
    'model' => 'Associato a',
  ],
  'messages' => [
    'primary_set' => 'Indirizzo impostato come principale con successo',
    'address_verified' => 'Indirizzo verificato correttamente',
    'geocoding_success' => 'Geocodifica completata con successo',
    'geocoding_failed' => 'Impossibile geocodificare l\'indirizzo',
  ],
  'sections' => [
    'location' => [
      'label' => 'Informazioni di localizzazione',
      'description' => 'Dati relativi alla posizione geografica',
    ],
    'address' => [
      'label' => 'Dati indirizzo',
      'description' => 'Dettagli dell\'indirizzo',
    ],
    'metadata' => [
      'label' => 'Metadati',
      'description' => 'Informazioni aggiuntive sull\'indirizzo',
    ],
    'map' => [
      'label' => 'Mappa',
      'description' => 'Visualizzazione su mappa',
<<<<<<< HEAD
    ],
  ],
>>>>>>> ea4011f (.)
];
=======
    ),
  ),
  'steps' => 
  array (
    'Is primary' => 
    array (
      'description' => 'Is primary',
      'helper_text' => 'Is primary',
      'placeholder' => 'Is primary',
      'label' => 'Is primary',
    ),
    'Name' => 
    array (
      'label' => 'Name',
      'placeholder' => 'Name',
      'helper_text' => 'Name',
      'description' => 'Name',
    ),
    'Country' => 
    array (
      'label' => 'Country',
      'placeholder' => 'Country',
      'helper_text' => 'Country',
      'description' => 'Country',
    ),
    'Administrative area level 1' => 
    array (
      'label' => 'Administrative area level 1',
      'placeholder' => 'Administrative area level 1',
      'helper_text' => 'Administrative area level 1',
      'description' => 'Administrative area level 1',
    ),
    'Administrative area level 2' => 
    array (
      'label' => 'Administrative area level 2',
      'placeholder' => 'Administrative area level 2',
      'helper_text' => 'Administrative area level 2',
      'description' => 'Administrative area level 2',
    ),
    'Locality' => 
    array (
      'label' => 'Locality',
      'placeholder' => 'Locality',
      'helper_text' => 'Locality',
      'description' => 'Locality',
    ),
    'Postal code' => 
    array (
      'label' => 'Postal code',
      'placeholder' => 'Postal code',
      'helper_text' => 'Postal code',
      'description' => 'Postal code',
    ),
    'Route' => 
    array (
      'label' => 'Route',
      'placeholder' => 'Route',
      'helper_text' => 'Route',
      'description' => 'Route',
    ),
    'Street number' => 
    array (
      'label' => 'Street number',
      'placeholder' => 'Street number',
      'helper_text' => 'Street number',
      'description' => 'Street number',
    ),
  ),
  'toggles' => 
  array (
    'is_primary' => 
    array (
      'description' => 'is_primary',
      'helper_text' => 'is_primary',
      'label' => 'is_primary',
      'placeholder' => 'is_primary',
    ),
  ),
  'text_inputs' => 
  array (
    'name' => 
    array (
      'label' => 'name',
      'placeholder' => 'name',
      'helper_text' => 'name',
      'description' => 'name',
    ),
    'country' => 
    array (
      'label' => 'country',
      'placeholder' => 'country',
      'helper_text' => 'country',
      'description' => 'country',
    ),
    'route' => 
    array (
      'label' => 'route',
      'placeholder' => 'route',
      'helper_text' => 'route',
      'description' => 'route',
    ),
    'street_number' => 
    array (
      'label' => 'street_number',
      'placeholder' => 'street_number',
      'helper_text' => 'street_number',
      'description' => 'street_number',
    ),
  ),
  'selects' => 
  array (
    'administrative_area_level_1' => 
    array (
      'label' => 'administrative_area_level_1',
      'placeholder' => 'administrative_area_level_1',
      'helper_text' => 'administrative_area_level_1',
      'description' => 'administrative_area_level_1',
    ),
    'administrative_area_level_2' => 
    array (
      'label' => 'administrative_area_level_2',
      'placeholder' => 'administrative_area_level_2',
      'helper_text' => 'administrative_area_level_2',
      'description' => 'administrative_area_level_2',
    ),
    'locality' => 
    array (
      'label' => 'locality',
      'placeholder' => 'locality',
      'helper_text' => 'locality',
      'description' => 'locality',
    ),
    'postal_code' => 
    array (
      'label' => 'postal_code',
      'placeholder' => 'postal_code',
      'helper_text' => 'postal_code',
      'description' => 'postal_code',
    ),
  ),
  'steps' => 
  array (
    'Is primary' => 
    array (
      'description' => 'Is primary',
      'helper_text' => 'Is primary',
      'placeholder' => 'Is primary',
      'label' => 'Is primary',
    ),
    'Name' => 
    array (
      'label' => 'Name',
      'placeholder' => 'Name',
      'helper_text' => 'Name',
      'description' => 'Name',
    ),
    'Country' => 
    array (
      'label' => 'Country',
      'placeholder' => 'Country',
      'helper_text' => 'Country',
      'description' => 'Country',
    ),
    'Administrative area level 1' => 
    array (
      'label' => 'Administrative area level 1',
      'placeholder' => 'Administrative area level 1',
      'helper_text' => 'Administrative area level 1',
      'description' => 'Administrative area level 1',
    ),
    'Administrative area level 2' => 
    array (
      'label' => 'Administrative area level 2',
      'placeholder' => 'Administrative area level 2',
      'helper_text' => 'Administrative area level 2',
      'description' => 'Administrative area level 2',
    ),
    'Locality' => 
    array (
      'label' => 'Locality',
      'placeholder' => 'Locality',
      'helper_text' => 'Locality',
      'description' => 'Locality',
    ),
    'Postal code' => 
    array (
      'label' => 'Postal code',
      'placeholder' => 'Postal code',
      'helper_text' => 'Postal code',
      'description' => 'Postal code',
    ),
    'Route' => 
    array (
      'label' => 'Route',
      'placeholder' => 'Route',
      'helper_text' => 'Route',
      'description' => 'Route',
    ),
    'Street number' => 
    array (
      'label' => 'Street number',
      'placeholder' => 'Street number',
      'helper_text' => 'Street number',
      'description' => 'Street number',
    ),
  ),
  'toggles' => 
  array (
    'is_primary' => 
    array (
      'description' => 'is_primary',
      'helper_text' => 'is_primary',
      'label' => 'is_primary',
      'placeholder' => 'is_primary',
    ),
  ),
  'text_inputs' => 
  array (
    'name' => 
    array (
      'label' => 'name',
      'placeholder' => 'name',
      'helper_text' => 'name',
      'description' => 'name',
    ),
    'country' => 
    array (
      'label' => 'country',
      'placeholder' => 'country',
      'helper_text' => 'country',
      'description' => 'country',
    ),
    'route' => 
    array (
      'label' => 'route',
      'placeholder' => 'route',
      'helper_text' => 'route',
      'description' => 'route',
    ),
    'street_number' => 
    array (
      'label' => 'street_number',
      'placeholder' => 'street_number',
      'helper_text' => 'street_number',
      'description' => 'street_number',
    ),
  ),
  'selects' => 
  array (
    'administrative_area_level_1' => 
    array (
      'label' => 'administrative_area_level_1',
      'placeholder' => 'administrative_area_level_1',
      'helper_text' => 'administrative_area_level_1',
      'description' => 'administrative_area_level_1',
    ),
    'administrative_area_level_2' => 
    array (
      'label' => 'administrative_area_level_2',
      'placeholder' => 'administrative_area_level_2',
      'helper_text' => 'administrative_area_level_2',
      'description' => 'administrative_area_level_2',
    ),
    'locality' => 
    array (
      'label' => 'locality',
      'placeholder' => 'locality',
      'helper_text' => 'locality',
      'description' => 'locality',
    ),
    'postal_code' => 
    array (
      'label' => 'postal_code',
      'placeholder' => 'postal_code',
      'helper_text' => 'postal_code',
      'description' => 'postal_code',
    ),
  ),
  'steps' => 
  array (
    'Is primary' => 
    array (
      'description' => 'Is primary',
      'helper_text' => 'Is primary',
      'placeholder' => 'Is primary',
      'label' => 'Is primary',
    ),
    'Name' => 
    array (
      'label' => 'Name',
      'placeholder' => 'Name',
      'helper_text' => 'Name',
      'description' => 'Name',
    ),
    'Country' => 
    array (
      'label' => 'Country',
      'placeholder' => 'Country',
      'helper_text' => 'Country',
      'description' => 'Country',
    ),
    'Administrative area level 1' => 
    array (
      'label' => 'Administrative area level 1',
      'placeholder' => 'Administrative area level 1',
      'helper_text' => 'Administrative area level 1',
      'description' => 'Administrative area level 1',
    ),
    'Administrative area level 2' => 
    array (
      'label' => 'Administrative area level 2',
      'placeholder' => 'Administrative area level 2',
      'helper_text' => 'Administrative area level 2',
      'description' => 'Administrative area level 2',
    ),
    'Locality' => 
    array (
      'label' => 'Locality',
      'placeholder' => 'Locality',
      'helper_text' => 'Locality',
      'description' => 'Locality',
    ),
    'Postal code' => 
    array (
      'label' => 'Postal code',
      'placeholder' => 'Postal code',
      'helper_text' => 'Postal code',
      'description' => 'Postal code',
    ),
    'Route' => 
    array (
      'label' => 'Route',
      'placeholder' => 'Route',
      'helper_text' => 'Route',
      'description' => 'Route',
    ),
    'Street number' => 
    array (
      'label' => 'Street number',
      'placeholder' => 'Street number',
      'helper_text' => 'Street number',
      'description' => 'Street number',
    ),
  ),
  'toggles' => 
  array (
    'is_primary' => 
    array (
      'description' => 'is_primary',
      'helper_text' => 'is_primary',
      'label' => 'is_primary',
      'placeholder' => 'is_primary',
    ),
  ),
  'text_inputs' => 
  array (
    'name' => 
    array (
      'label' => 'name',
      'placeholder' => 'name',
      'helper_text' => 'name',
      'description' => 'name',
    ),
    'country' => 
    array (
      'label' => 'country',
      'placeholder' => 'country',
      'helper_text' => 'country',
      'description' => 'country',
    ),
    'route' => 
    array (
      'label' => 'route',
      'placeholder' => 'route',
      'helper_text' => 'route',
      'description' => 'route',
    ),
    'street_number' => 
    array (
      'label' => 'street_number',
      'placeholder' => 'street_number',
      'helper_text' => 'street_number',
      'description' => 'street_number',
    ),
  ),
  'selects' => 
  array (
    'administrative_area_level_1' => 
    array (
      'label' => 'administrative_area_level_1',
      'placeholder' => 'administrative_area_level_1',
      'helper_text' => 'administrative_area_level_1',
      'description' => 'administrative_area_level_1',
    ),
    'administrative_area_level_2' => 
    array (
      'label' => 'administrative_area_level_2',
      'placeholder' => 'administrative_area_level_2',
      'helper_text' => 'administrative_area_level_2',
      'description' => 'administrative_area_level_2',
    ),
    'locality' => 
    array (
      'label' => 'locality',
      'placeholder' => 'locality',
      'helper_text' => 'locality',
      'description' => 'locality',
    ),
    'postal_code' => 
    array (
      'label' => 'postal_code',
      'placeholder' => 'postal_code',
      'helper_text' => 'postal_code',
      'description' => 'postal_code',
    ),
  ),
);
>>>>>>> a93f634 (.)
