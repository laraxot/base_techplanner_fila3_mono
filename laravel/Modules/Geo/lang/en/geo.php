<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 3c5e1ea (.)
return [
    'navigation' => [
        'icons' => [
            'location-map' => [
                'default' => 'heroicon-o-map-pin',
                'hover' => 'heroicon-o-map-pin animate-bounce',
                'title' => 'Location icon',
            ],
            'lat-lng' => [
                'default' => 'heroicon-o-map-pin',
                'hover' => 'heroicon-o-map-pin animate-pulse',
                'title' => 'Coordinates icon',
            ],
            'webbingbrasil-map' => [
                'default' => 'heroicon-o-map',
                'hover' => 'heroicon-o-map animate-spin',
                'title' => 'Webbingbrasil map icon',
            ],
            'osm-map' => [
                'default' => 'heroicon-o-globe-alt',
                'hover' => 'heroicon-o-globe-alt animate-spin',
                'title' => 'Global map icon',
            ],
            'dotswan-map' => [
                'default' => 'heroicon-o-map',
                'hover' => 'heroicon-o-map animate-spin',
                'title' => 'Dotswan map icon',
            ],
            'setting-page' => [
                'default' => 'heroicon-o-cog-6-tooth',
                'hover' => 'heroicon-o-cog-6-tooth animate-spin',
                'title' => 'Settings icon',
            ],
        ],
        'groups' => [
            'geo' => [
                'name' => 'Geo',
                'description' => 'Maps and location management',
            ],
        ],
        'pages' => [
            'location-map' => [
                'label' => 'Location Map',
                'description' => 'View and manage locations on the map',
<<<<<<< HEAD
                'sort' => 1,
=======
                'sort' => '1',
>>>>>>> 3c5e1ea (.)
            ],
            'lat-lng' => [
                'label' => 'Coordinates',
                'description' => 'Geographic coordinates management',
<<<<<<< HEAD
                'sort' => 2,
=======
                'sort' => '2',
>>>>>>> 3c5e1ea (.)
            ],
            'webbingbrasil-map' => [
                'label' => 'Webbingbrasil Map',
                'description' => 'Map view with Webbingbrasil',
<<<<<<< HEAD
                'sort' => 3,
=======
                'sort' => '3',
>>>>>>> 3c5e1ea (.)
            ],
            'osm-map' => [
                'label' => 'OSM Map',
                'description' => 'OpenStreetMap view',
<<<<<<< HEAD
                'sort' => 4,
=======
                'sort' => '4',
>>>>>>> 3c5e1ea (.)
            ],
            'dotswan-map' => [
                'label' => 'Dotswan Map',
                'description' => 'Map view with Dotswan',
<<<<<<< HEAD
                'sort' => 5,
=======
                'sort' => '5',
>>>>>>> 3c5e1ea (.)
            ],
            'setting-page' => [
                'label' => 'Settings',
                'description' => 'Geo module configuration',
<<<<<<< HEAD
                'sort' => 6,
            ],
        ],
=======
                'sort' => '6',
            ],
        ],
        'name' => 'Geo',
        'group' => 'Mappe',
        'sort' => '20',
        'icon' => 'geo-menu',
        'badge' => [
            'color' => 'success',
            'label' => 'Online',
        ],
>>>>>>> 3c5e1ea (.)
    ],
    'status' => [
        'waiting' => 'Waiting...',
        'loading' => 'Loading...',
        'error' => 'Error',
        'success' => 'Completed',
    ],
    'actions' => [
        'save' => 'Save',
        'cancel' => 'Cancel',
        'delete' => 'Delete',
        'edit' => 'Edit',
        'view' => 'View',
    ],
    'messages' => [
        'saved' => 'Successfully saved',
        'deleted' => 'Successfully deleted',
        'error' => 'An error occurred',
    ],
<<<<<<< HEAD
=======
    'sections' => [
        'map' => [
            'navigation' => [
                'name' => 'Mappa',
                'group' => 'Geo',
                'sort' => '10',
                'icon' => 'geo-map',
                'badge' => [
                    'color' => 'info',
                    'label' => 'Interattiva',
                ],
            ],
            'fields' => [
                'zoom' => 'Livello Zoom',
                'center' => 'Centro Mappa',
                'type' => 'Tipo Mappa',
                'markers' => 'Marcatori',
                'bounds' => 'Confini',
            ],
            'types' => [
                'roadmap' => 'Stradale',
                'satellite' => 'Satellite',
                'hybrid' => 'Ibrida',
                'terrain' => 'Terreno',
            ],
        ],
        'location' => [
            'navigation' => [
                'name' => 'Posizioni',
                'group' => 'Geo',
                'sort' => '20',
                'icon' => 'geo-location',
                'badge' => [
                    'color' => 'warning',
                    'label' => 'Da Verificare',
                ],
            ],
            'fields' => [
                'name' => 'Name',
                'address' => 'Address',
                'latitude' => 'Latitude',
                'longitude' => 'Longitude',
                'category' => 'Category',
                'status' => 'Status',
            ],
            'categories' => [
                'business' => 'Business',
                'residence' => 'Residence',
                'point_of_interest' => 'Point of Interest',
                'public_service' => 'Public Service',
            ],
        ],
    ],
    'common' => [
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'pending' => 'Pending',
            'verified' => 'Verified',
        ],
        'actions' => [
            'locate' => 'Locate',
            'center' => 'Center Map',
            'zoom' => 'Zoom',
            'pan' => 'Pan',
            'measure' => 'Measure',
            'directions' => 'Directions',
        ],
        'messages' => [
            'success' => [
                'located' => 'Location found',
                'saved' => 'Location saved',
                'updated' => 'Location updated',
                'deleted' => 'Location deleted',
            ],
            'error' => [
                'not_found' => 'Location not found',
                'invalid_coords' => 'Invalid coordinates',
                'geocoding_failed' => 'Geocoding failed',
                'network_error' => 'Network error',
            ],
        ],
        'filters' => [
            'radius' => 'Raggio',
            'category' => 'Categoria',
            'status' => 'Stato',
            'date_range' => 'Periodo',
        ],
    ],
>>>>>>> 3c5e1ea (.)
];
