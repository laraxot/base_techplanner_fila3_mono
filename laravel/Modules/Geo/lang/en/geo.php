<?php

declare(strict_types=1);

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
                'sort' => 1,
            ],
            'lat-lng' => [
                'label' => 'Coordinates',
                'description' => 'Geographic coordinates management',
                'sort' => 2,
            ],
            'webbingbrasil-map' => [
                'label' => 'Webbingbrasil Map',
                'description' => 'Map view with Webbingbrasil',
                'sort' => 3,
            ],
            'osm-map' => [
                'label' => 'OSM Map',
                'description' => 'OpenStreetMap view',
                'sort' => 4,
            ],
            'dotswan-map' => [
                'label' => 'Dotswan Map',
                'description' => 'Map view with Dotswan',
                'sort' => 5,
            ],
            'setting-page' => [
                'label' => 'Settings',
                'description' => 'Geo module configuration',
                'sort' => 6,
            ],
        ],
        'name' => 'Geo',
        'group' => 'Maps',
        'sort' => 20,
        'icon' => 'geo-menu',
        'badge' => [
            'color' => 'success',
            'label' => 'Online',
        ],
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
    'sections' => [
        'map' => [
            'navigation' => [
                'name' => 'Map',
                'group' => 'Geo',
                'sort' => 10,
                'icon' => 'geo-map',
                'badge' => [
                    'color' => 'info',
                    'label' => 'Interactive',
                ],
            ],
            'fields' => [
                'zoom' => 'Zoom Level',
                'center' => 'Map Center',
                'type' => 'Map Type',
                'markers' => 'Markers',
                'bounds' => 'Bounds',
            ],
            'types' => [
                'roadmap' => 'Road',
                'satellite' => 'Satellite',
                'hybrid' => 'Hybrid',
                'terrain' => 'Terrain',
            ],
        ],
        'location' => [
            'navigation' => [
                'name' => 'Locations',
                'group' => 'Geo',
                'sort' => 20,
                'icon' => 'geo-location',
                'badge' => [
                    'color' => 'warning',
                    'label' => 'To Verify',
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
            'radius' => 'Radius',
            'category' => 'Category',
            'status' => 'Status',
            'date_range' => 'Date Range',
        ],
    ],
];
