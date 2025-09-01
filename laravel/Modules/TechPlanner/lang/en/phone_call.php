<?php

declare(strict_types=1);

return [
    'navigation' => [
        'label' => 'Phone Calls',
        'group' => 'TechPlanner',
        'icon' => 'heroicon-o-phone',
        'sort' => 2,
    ],
    'resource' => [
        'label' => 'Phone Call',
        'plural_label' => 'Phone Calls',
        'navigation_group' => 'TechPlanner',
        'navigation_icon' => 'heroicon-o-phone',
        'navigation_sort' => 2,
        'description' => 'Phone call management',
    ],
    'enums' => [
        'inbound' => [
            'label' => 'Incoming',
            'color' => 'success',
            'icon' => 'heroicon-o-arrow-down',
        ],
        'outbound' => [
            'label' => 'Outgoing',
            'color' => 'warning',
            'icon' => 'heroicon-o-arrow-up',
        ],
        'missed' => [
            'label' => 'Missed',
            'color' => 'danger',
            'icon' => 'heroicon-o-x-circle',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'New Call',
            'icon' => 'heroicon-o-plus',
            'color' => 'primary',
            'tooltip' => 'Record a new phone call',
        ],
        'edit' => [
            'label' => 'Edit Call',
            'icon' => 'heroicon-o-pencil',
            'color' => 'warning',
            'tooltip' => 'Edit the selected call',
        ],
        'delete' => [
            'label' => 'Delete Call',
            'icon' => 'heroicon-o-trash',
            'color' => 'danger',
            'tooltip' => 'Delete the selected call',
        ],
        'view' => [
            'label' => 'View Call',
            'icon' => 'heroicon-o-eye',
            'color' => 'info',
            'tooltip' => 'View call details',
        ],
        'import' => [
            'label' => 'Import Calls',
            'icon' => 'heroicon-o-arrow-up-tray',
            'color' => 'secondary',
            'tooltip' => 'Import calls from external file',
        ],
    ],
    'fields' => [
        'client_id' => [
            'label' => 'Client',
            'placeholder' => 'Select client',
            'help' => 'The client with whom the call was made',
        ],
        'date' => [
            'label' => 'Date',
            'placeholder' => 'Select date',
            'help' => 'Date of the call',
        ],
        'duration' => [
            'label' => 'Duration',
            'placeholder' => 'Enter duration in minutes',
            'help' => 'Duration of the call in minutes',
        ],
        'notes' => [
            'label' => 'Notes',
            'placeholder' => 'Enter call notes',
            'help' => 'Notes and details about the call',
        ],
        'call_type' => [
            'label' => 'Call Type',
            'placeholder' => 'Select type',
            'help' => 'Type of call made',
            'options' => [
                'inbound' => 'Incoming',
                'outbound' => 'Outgoing',
                'missed' => 'Missed',
            ],
        ],
        'id' => [
            'label' => 'ID',
            'help' => 'Unique identifier of the call',
        ],
    ],
    'filters' => [
        'client' => [
            'label' => 'Client',
            'placeholder' => 'Select client',
            'help' => 'Filter by specific client',
        ],
        'call_type' => [
            'label' => 'Call Type',
            'placeholder' => 'Select type',
            'help' => 'Filter by call type',
        ],
        'date_range' => [
            'label' => 'Period',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'help' => 'Select the period of interest',
        ],
    ],
    'messages' => [
        'created' => 'Call recorded successfully',
        'updated' => 'Call updated successfully',
        'deleted' => 'Call deleted successfully',
        'imported' => 'Calls imported successfully',
    ],
];

