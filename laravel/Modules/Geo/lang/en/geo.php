<?php

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
declare(strict_types=1);

=======
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
                'sort' => '1',
=======
                'sort' => 1,
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
                'sort' => 1,
=======
                'sort' => '1',
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
                'sort' => '1',
>>>>>>> 6f0eea5 (.)
            ],
            'lat-lng' => [
                'label' => 'Coordinates',
                'description' => 'Geographic coordinates management',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                'sort' => '2',
=======
                'sort' => 2,
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
                'sort' => 2,
=======
                'sort' => '2',
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
                'sort' => '2',
>>>>>>> 6f0eea5 (.)
            ],
            'webbingbrasil-map' => [
                'label' => 'Webbingbrasil Map',
                'description' => 'Map view with Webbingbrasil',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                'sort' => '3',
=======
                'sort' => 3,
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
                'sort' => 3,
=======
                'sort' => '3',
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
                'sort' => '3',
>>>>>>> 6f0eea5 (.)
            ],
            'osm-map' => [
                'label' => 'OSM Map',
                'description' => 'OpenStreetMap view',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                'sort' => '4',
=======
                'sort' => 4,
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
                'sort' => 4,
=======
                'sort' => '4',
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
                'sort' => '4',
>>>>>>> 6f0eea5 (.)
            ],
            'dotswan-map' => [
                'label' => 'Dotswan Map',
                'description' => 'Map view with Dotswan',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                'sort' => '5',
=======
                'sort' => 5,
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
                'sort' => 5,
=======
                'sort' => '5',
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
                'sort' => '5',
>>>>>>> 6f0eea5 (.)
            ],
            'setting-page' => [
                'label' => 'Settings',
                'description' => 'Geo module configuration',
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
                'sort' => 6,
            ],
        ],
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
                'sort' => 6,
            ],
        ],
=======
=======
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
];
