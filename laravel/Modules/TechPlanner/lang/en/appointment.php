<?php

return [
    'navigation' => [
        'group' => 'techplanner',
        'label' => 'Appointments',
        'icon' => 'techplanner-appointment',
        'sort' => 10,
    ],
    'resource' => [
        'label' => 'Appointment',
        'plural' => 'Appointments',
        'description' => 'Appointment management and technical planning',
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
            'description' => 'Unique appointment identifier',
        ],
        'client_id' => [
            'label' => 'Client',
            'placeholder' => 'Select client',
            'help' => 'The client for whom the appointment is scheduled',
            'description' => 'Client associated with the appointment',
        ],
        'client' => [
            'label' => 'Client',
            'description' => 'Client information',
        ],
        'date' => [
            'label' => 'Date',
            'placeholder' => 'Select date',
            'help' => 'Appointment date',
            'description' => 'Scheduled date for the appointment',
        ],
        'time' => [
            'label' => 'Time',
            'placeholder' => 'Select time',
            'help' => 'Appointment time',
            'description' => 'Scheduled time for the appointment',
        ],
        'datetime' => [
            'label' => 'Date and Time',
            'description' => 'Complete date and time of the appointment',
        ],
        'status' => [
            'label' => 'Status',
            'placeholder' => 'Select status',
            'help' => 'Current appointment status',
            'description' => 'Appointment status',
            'options' => [
                'scheduled' => 'Scheduled',
                'confirmed' => 'Confirmed',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ],
        ],
        'notes' => [
            'label' => 'Notes',
            'placeholder' => 'Enter additional notes...',
            'help' => 'Additional notes and details about the appointment',
            'description' => 'Notes and comments about the appointment',
        ],
        'machines_count' => [
            'label' => 'Machines Count',
            'description' => 'Number of machines associated with the appointment',
        ],
        'created_at' => [
            'label' => 'Created At',
            'description' => 'Appointment creation date',
        ],
        'updated_at' => [
            'label' => 'Updated At',
            'description' => 'Last modification date',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'New Appointment',
            'description' => 'Create a new appointment',
        ],
        'edit' => [
            'label' => 'Edit Appointment',
            'description' => 'Edit the selected appointment',
        ],
        'delete' => [
            'label' => 'Delete Appointment',
            'description' => 'Delete the selected appointment',
        ],
        'confirm' => [
            'label' => 'Confirm Appointment',
            'description' => 'Confirm the selected appointment',
        ],
        'complete' => [
            'label' => 'Complete Appointment',
            'description' => 'Mark the appointment as completed',
        ],
        'cancel' => [
            'label' => 'Cancel Appointment',
            'description' => 'Cancel the selected appointment',
        ],
        'view' => [
            'label' => 'View Appointment',
            'description' => 'View appointment details',
        ],
        'bulk_confirm' => [
            'label' => 'Confirm Selected',
            'description' => 'Confirm all selected appointments',
        ],
        'bulk_complete' => [
            'label' => 'Complete Selected',
            'description' => 'Mark all selected appointments as completed',
        ],
        'bulk_cancel' => [
            'label' => 'Cancel Selected',
            'description' => 'Cancel all selected appointments',
        ],
        'export' => [
            'label' => 'Export Appointments',
            'description' => 'Export appointments to CSV format',
        ],
    ],
    'filters' => [
        'status' => [
            'label' => 'Status',
            'placeholder' => 'Filter by status',
        ],
        'date_range' => [
            'label' => 'Date Range',
            'placeholder' => 'Select date range',
        ],
        'client' => [
            'label' => 'Client',
            'placeholder' => 'Filter by client',
        ],
        'created_date' => [
            'label' => 'Created Date',
            'placeholder' => 'Filter by creation date',
        ],
    ],
    'pages' => [
        'list' => [
            'title' => 'Appointments',
            'description' => 'Appointment management and display',
        ],
        'create' => [
            'title' => 'New Appointment',
            'description' => 'Create a new appointment',
        ],
        'edit' => [
            'title' => 'Edit Appointment',
            'description' => 'Edit the selected appointment',
        ],
    ],
    'status' => [
        'scheduled' => [
            'label' => 'Scheduled',
            'color' => 'warning',
            'description' => 'Appointment scheduled but not yet confirmed',
        ],
        'confirmed' => [
            'label' => 'Confirmed',
            'color' => 'info',
            'description' => 'Appointment confirmed and ready',
        ],
        'completed' => [
            'label' => 'Completed',
            'color' => 'success',
            'description' => 'Appointment completed successfully',
        ],
        'cancelled' => [
            'label' => 'Cancelled',
            'color' => 'danger',
            'description' => 'Appointment cancelled',
        ],
    ],
    'messages' => [
        'created' => 'Appointment created successfully',
        'updated' => 'Appointment updated successfully',
        'deleted' => 'Appointment deleted successfully',
        'confirmed' => 'Appointment confirmed successfully',
        'completed' => 'Appointment completed successfully',
        'cancelled' => 'Appointment cancelled successfully',
        'bulk_updated' => ':count appointments updated successfully',
        'bulk_deleted' => ':count appointments deleted successfully',
        'bulk_confirmed' => ':count appointments confirmed successfully',
        'bulk_completed' => ':count appointments completed successfully',
        'bulk_cancelled' => ':count appointments cancelled successfully',
        'export_success' => 'Appointments exported successfully',
        'no_appointments' => 'No appointments found',
        'no_selected' => 'No appointments selected',
    ],
    'summary' => [
        'total' => 'Total Appointments',
        'scheduled' => 'Scheduled',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'today' => 'Today',
        'this_week' => 'This Week',
        'this_month' => 'This Month',
    ],
];
