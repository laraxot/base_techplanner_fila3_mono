<?php

declare(strict_types=1);

return [
    'navigation' => [
        'label' => 'Legal Representatives',
        'group' => 'TechPlanner',
        'icon' => 'heroicon-o-user-group',
        'sort' => 3,
    ],
    'resource' => [
        'label' => 'Legal Representative',
        'plural_label' => 'Legal Representatives',
        'navigation_group' => 'TechPlanner',
        'navigation_icon' => 'heroicon-o-user-group',
        'navigation_sort' => 3,
        'description' => 'Legal representative management',
    ],
    'actions' => [
        'create' => [
            'label' => 'New Representative',
            'icon' => 'heroicon-o-plus',
            'color' => 'primary',
            'tooltip' => 'Add a new legal representative',
        ],
        'edit' => [
            'label' => 'Edit Representative',
            'icon' => 'heroicon-o-pencil',
            'color' => 'warning',
            'tooltip' => 'Edit the selected representative',
        ],
        'delete' => [
            'label' => 'Delete Representative',
            'icon' => 'heroicon-o-trash',
            'color' => 'danger',
            'tooltip' => 'Delete the selected representative',
        ],
        'view' => [
            'label' => 'View Representative',
            'icon' => 'heroicon-o-eye',
            'color' => 'info',
            'tooltip' => 'View representative details',
        ],
    ],
    'fields' => [
        'name' => [
            'label' => 'Name',
            'placeholder' => 'Enter full name',
            'help' => 'Full name of the legal representative',
        ],
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Enter email address',
            'help' => 'Email address of the representative',
        ],
        'phone' => [
            'label' => 'Phone',
            'placeholder' => 'Enter phone number',
            'help' => 'Phone number of the representative',
        ],
        'role' => [
            'label' => 'Role',
            'placeholder' => 'Select role',
            'help' => 'Role of the legal representative',
            'options' => [
                'lawyer' => 'Lawyer',
                'notary' => 'Notary',
                'consultant' => 'Consultant',
            ],
        ],
        'id' => [
            'label' => 'ID',
            'help' => 'Unique identifier of the representative',
        ],
    ],
    'filters' => [
        'name' => [
            'label' => 'Name',
            'placeholder' => 'Search by name',
            'help' => 'Filter by representative name',
        ],
        'role' => [
            'label' => 'Role',
            'placeholder' => 'Select role',
            'help' => 'Filter by representative role',
        ],
    ],
    'messages' => [
        'created' => 'Legal representative created successfully',
        'updated' => 'Legal representative updated successfully',
        'deleted' => 'Legal representative deleted successfully',
    ],
];

