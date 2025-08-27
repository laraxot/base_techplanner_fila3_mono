<?php

declare(strict_types=1);

return [
    'navigation' => [
        'label' => 'Work Hours',
        'group' => 'Employee Management',
    ],

    'resource' => [
        'label' => 'Work Hour',
        'plural_label' => 'Work Hours',
        'navigation_label' => 'Work Hours',
    ],

    'fields' => [
        'employee_id' => [
            'label' => 'Employee',
            'placeholder' => 'Select employee',
            'help' => 'The employee this work hour entry belongs to',
        ],
        'type' => [
            'label' => 'Entry Type',
            'placeholder' => 'Select entry type',
            'help' => 'Type of work hour entry',
            'options' => [
                'clock_in' => 'Clock In',
                'clock_out' => 'Clock Out',
                'break_start' => 'Break Start',
                'break_end' => 'Break End',
            ],
        ],
        'timestamp' => [
            'label' => 'Date & Time',
            'placeholder' => 'Select date and time',
            'help' => 'Date and time of the work hour entry',
        ],
        'location_lat' => [
            'label' => 'Latitude',
            'placeholder' => 'GPS latitude',
            'help' => 'GPS latitude coordinate',
        ],
        'location_lng' => [
            'label' => 'Longitude',
            'placeholder' => 'GPS longitude',
            'help' => 'GPS longitude coordinate',
        ],
        'location_name' => [
            'label' => 'Location Name',
            'placeholder' => 'Office, Home, Client site...',
            'help' => 'Descriptive name of the location',
        ],
        'device_info' => [
            'label' => 'Device Information',
            'placeholder' => 'Device details',
            'help' => 'Information about the device used for this entry',
        ],
        'photo_path' => [
            'label' => 'Photo',
            'placeholder' => 'Upload photo',
            'help' => 'Optional photo verification for this entry',
        ],
        'status' => [
            'label' => 'Status',
            'placeholder' => 'Select status',
            'help' => 'Approval status of this entry',
            'options' => [
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ],
        ],
        'approved_by' => [
            'label' => 'Approved By',
            'placeholder' => 'Select approver',
            'help' => 'User who approved this entry',
        ],
        'approved_at' => [
            'label' => 'Approved At',
            'placeholder' => 'Approval date',
            'help' => 'Date and time when this entry was approved',
        ],
        'notes' => [
            'label' => 'Notes',
            'placeholder' => 'Add optional notes...',
            'help' => 'Optional notes for this entry',
        ],
        'created_at' => [
            'label' => 'Created At',
        ],
        'updated_at' => [
            'label' => 'Updated At',
        ],
    ],

    'actions' => [
        'create' => [
            'label' => 'Create Work Hour',
            'success' => 'Work hour entry created successfully',
            'error' => 'Failed to create work hour entry',
        ],
        'edit' => [
            'label' => 'Edit Work Hour',
            'success' => 'Work hour entry updated successfully',
            'error' => 'Failed to update work hour entry',
        ],
        'delete' => [
            'label' => 'Delete Work Hour',
            'success' => 'Work hour entry deleted successfully',
            'error' => 'Failed to delete work hour entry',
            'confirmation' => 'Are you sure you want to delete this work hour entry?',
        ],
        'view' => [
            'label' => 'View Work Hour',
        ],
        'timeclock' => [
            'label' => 'Time Clock',
        ],
        'clock_in' => [
            'label' => 'Clock In',
            'success' => 'Successfully clocked in',
            'error' => 'Failed to clock in',
        ],
        'clock_out' => [
            'label' => 'Clock Out',
            'success' => 'Successfully clocked out',
            'error' => 'Failed to clock out',
        ],
        'break_start' => [
            'label' => 'Start Break',
            'success' => 'Break started successfully',
            'error' => 'Failed to start break',
        ],
        'break_end' => [
            'label' => 'End Break',
            'success' => 'Break ended successfully',
            'error' => 'Failed to end break',
        ],
        'refresh' => [
            'label' => 'Refresh',
        ],
        'back_to_list' => [
            'label' => 'Back to Work Hours',
        ],
        'view_all_entries' => [
            'label' => 'View All Entries',
        ],
    ],

    'filters' => [
        'employee' => [
            'label' => 'Employee',
        ],
        'entry_type' => [
            'label' => 'Entry Type',
        ],
        'date_range' => [
            'label' => 'Date Range',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
        ],
        'today' => [
            'label' => 'Today Only',
        ],
    ],

    'tabs' => [
        'all' => 'All Entries',
        'today' => 'Today',
        'this_week' => 'This Week',
        'clock_in' => 'Clock In',
        'clock_out' => 'Clock Out',
    ],

    'pages' => [
        'timeclock' => [
            'title' => 'Employee Time Clock',
            'subtitle' => 'Track your work hours with a simple click',
            'heading' => 'Time Clock',
        ],
        'dashboard' => [
            'title' => 'Work Hours Dashboard',
            'subtitle' => 'Overview of work hours and statistics',
        ],
    ],

    'widgets' => [
        'stats' => [
            'today' => [
                'label' => 'Today',
            ],
            'this_week' => [
                'label' => 'This Week',
            ],
            'avg_day' => [
                'label' => 'Avg/Day',
            ],
            'work_days' => [
                'label' => 'Work Days',
            ],
        ],
        'progress' => [
            'weekly_progress' => 'Weekly Progress',
            'target_hours' => ':percentage% of :target h target',
        ],
        'breakdown' => [
            'daily_breakdown' => 'Daily Breakdown',
            'weekly_breakdown' => 'Weekly Breakdown',
        ],
        'recent_entries' => [
            'title' => 'Recent Entries',
            'empty_state' => 'No recent entries',
        ],
    ],

    'status' => [
        'not_clocked_in' => 'Not Clocked In',
        'clocked_in' => 'Clocked In',
        'on_break' => 'On Break',
        'clocked_out' => 'Clocked Out',
    ],

    'messages' => [
        'validation' => [
            'invalid_sequence' => 'Invalid entry sequence. Last entry was: :last_entry. Expected next action: :expected_action',
            'duplicate_entry' => 'An entry with the same timestamp and type already exists for this employee.',
            'outside_working_hours' => 'Time clock is only available between :start and :end',
            'invalid_time' => 'Work hours must be between :start and :end',
        ],
        'success' => [
            'entry_recorded' => 'Successfully recorded: :action',
            'data_refreshed' => 'Data refreshed successfully',
        ],
        'error' => [
            'user_not_found' => 'User not found',
            'invalid_action' => 'This action is not valid based on your current status',
            'failed_to_record' => 'Failed to record time entry: :error',
        ],
        'empty_states' => [
            'no_entries_today' => 'No entries recorded today',
            'no_recent_entries' => 'No recent entries',
        ],
    ],

    'summary' => [
        'total_hours_worked' => 'Total Hours Worked',
        'current_status' => 'Current Status',
        'total_entries' => 'Total Entries',
        'todays_summary' => "Today's Summary",
        'todays_entries' => "Today's Entries",
        'last_entry' => 'Last entry: :type at :time',
    ],

    'quick_actions' => [
        'title' => 'Quick Actions',
        'refresh_data' => 'Refresh Data',
        'time_clock' => 'Time Clock',
        'view_all' => 'View All Entries',
    ],
];
