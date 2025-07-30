<?php

declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'Scheduler',
        'plural' => 'Schedulers',
        'group' => [
            'name' => 'Jobs',
            'description' => 'Scheduled jobs management',
        ],
        'label' => 'Scheduler',
        'sort' => '55',
        'icon' => 'job-schedule-animated',
    ],
    'resource' => [
        'single' => 'Schedule',
        'plural' => 'Schedules',
        'navigation' => 'Settings',
        'history' => 'Show run history',
    ],
    'fields' => [
        'name' => [
            'label' => 'Name',
            'tooltip' => 'Enter the scheduled job name',
            'placeholder' => 'Job name',
        ],
        'guard_name' => [
            'label' => 'Guard',
            'tooltip' => 'Select the guard for the job',
            'placeholder' => 'Guard name',
        ],
        'permissions' => [
            'label' => 'Permissions',
            'tooltip' => 'Assign necessary permissions to the job',
            'placeholder' => 'Permissions',
        ],
        'first_name' => [
            'label' => 'First Name',
            'tooltip' => 'Responsible person first name',
            'placeholder' => 'Responsible first name',
        ],
        'last_name' => [
            'label' => 'Last Name',
            'tooltip' => 'Responsible person last name',
            'placeholder' => 'Responsible last name',
        ],
        'command' => [
            'label' => 'Command',
            'tooltip' => 'Enter the command to execute',
            'placeholder' => 'Command',
        ],
        'arguments' => [
            'label' => 'Arguments',
            'tooltip' => 'Specify any arguments for the command',
            'placeholder' => 'Arguments',
        ],
        'options' => [
            'label' => 'Options',
            'tooltip' => 'Enter any options for the command',
            'placeholder' => 'Options',
        ],
        'expression' => [
            'label' => 'Cron Expression',
            'tooltip' => 'Set the cron expression for scheduling',
            'placeholder' => 'Cron Expression',
        ],
        'log_filename' => [
            'label' => 'Log Filename',
            'tooltip' => 'Log file name',
            'placeholder' => 'Log filename',
        ],
        'status' => [
            'label' => 'Status',
            'tooltip' => 'Current job status',
            'placeholder' => 'Status',
        ],
        'actions' => [
            'label' => 'Actions',
            'tooltip' => 'Available actions for the job',
            'icon' => 'action-icon',
            'color' => 'blue',
        ],
        'run_in_background' => [
            'label' => 'Run in Background',
            'tooltip' => 'Run the job in background',
            'placeholder' => 'Run in background',
        ],
        'created_at' => [
            'label' => 'Created At',
            'tooltip' => 'Job creation date',
            'placeholder' => 'Creation date',
        ],
        'updated_at' => [
            'label' => 'Updated At',
            'tooltip' => 'Last update date',
            'placeholder' => 'Update date',
        ],
        'timezone' => [
            'label' => 'Timezone',
            'tooltip' => 'Set the timezone for the job',
            'placeholder' => 'Timezone',
        ],
        'toggleColumns' => [
            'label' => 'toggleColumns',
        ],
        'reorderRecords' => [
            'label' => 'reorderRecords',
        ],
        'resetFilters' => [
            'label' => 'resetFilters',
        ],
    ],
    'messages' => [
        'no-records-found' => 'No records found.',
        'save-success' => 'Data saved successfully.',
        'save-error' => 'Error saving data.',
        'timezone' => 'All schedules will be executed in the timezone: ',
        'select' => 'Select a command',
        'custom' => 'Custom Command',
        'custom-command-here' => 'Custom Command here (e.g. `cat /proc/cpuinfo` or `artisan db:migrate`)',
    ],
    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'trashed' => 'Trashed',
        'running' => 'Running',
        'failed' => 'Failed',
    ],
    'buttons' => [
        'inactivate' => [
            'label' => 'Inactivate',
            'icon' => 'icon-inactivate',
            'color' => 'gray',
        ],
        'activate' => [
            'label' => 'Activate',
            'icon' => 'icon-activate',
            'color' => 'green',
        ],
        'history' => [
            'label' => 'History',
            'icon' => 'icon-history',
            'color' => 'purple',
        ],
        'run' => [
            'label' => 'Run Now',
            'modal' => [
                'heading' => 'Run Schedule',
                'description' => 'Do you want to run this schedule now?',
            ],
            'messages' => [
                'success' => 'Schedule executed successfully',
            ],
            'icon' => 'icon-run',
            'color' => 'blue',
        ],
        'toggle' => [
            'label' => 'Activate/Deactivate',
            'modal' => [
                'heading' => 'Modify Status',
                'description' => 'Do you want to modify the status of this schedule?',
            ],
            'messages' => [
                'success' => 'Status modified successfully',
            ],
            'icon' => 'icon-toggle',
            'color' => 'orange',
        ],
        'delete' => [
            'label' => 'Delete',
            'modal' => [
                'heading' => 'Delete Schedule',
                'description' => 'Are you sure you want to delete this schedule?',
            ],
            'messages' => [
                'success' => 'Schedule deleted successfully',
            ],
            'icon' => 'icon-delete',
            'color' => 'red',
        ],
    ],
    'validation' => [
        'cron' => 'The field must be filled in the cron expression format.',
        'regex' => 'The :attribute field must only contain letters, numbers, dashes, and underscores. Comma is also allowed.',
    ],
    'frequencies' => [
        'everyMinute' => 'Every Minute',
        'everyFiveMinutes' => 'Every 5 Minutes',
        'everyTenMinutes' => 'Every 10 Minutes',
        'everyFifteenMinutes' => 'Every 15 Minutes',
        'everyThirtyMinutes' => 'Every 30 Minutes',
        'hourly' => 'Every Hour',
        'daily' => 'Every Day',
        'weekly' => 'Every Week',
        'monthly' => 'Every Month',
        'quarterly' => 'Every Quarter',
        'yearly' => 'Every Year',
    ],
    'days' => [
        'sunday' => 'Sunday',
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
    ],
    'cron' => [
        'help' => [
            'title' => 'Cron Expressions Help',
            'minute' => 'Minute (0-59)',
            'hour' => 'Hour (0-23)',
            'day_of_month' => 'Day of Month (1-31)',
            'month' => 'Month (1-12)',
            'day_of_week' => 'Day of Week (0-6)',
            'examples' => [
                'every_minute' => '* * * * * - Every minute',
                'every_hour' => '0 * * * * - Every hour',
                'every_day' => '0 0 * * * - Every day at midnight',
                'every_monday' => '0 0 * * 1 - Every Monday at midnight',
            ],
        ],
    ],
    'model' => [
        'label' => 'schedule.model',
    ],
];
