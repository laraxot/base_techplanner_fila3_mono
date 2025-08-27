<?php

declare(strict_types=1);

return [
    'navigation' => [
        'label' => 'Work Hours',
        'group' => 'Employee Management',
        'icon' => 'heroicon-o-clock',
        'sort' => 50,
    ],

    'resource' => [
        'label' => 'Time Entry',
        'plural_label' => 'Time Entries',
        'navigation_label' => 'Work Hours',
        'description' => 'Complete management of employee time tracking records',
    ],

    'fields' => [
        'employee_id' => [
            'label' => 'Employee',
            'placeholder' => 'Select employee',
            'help' => 'The employee this time entry belongs to',
            'tooltip' => 'Identify the employee for the record',
            'description' => 'Required field to associate the entry with the correct employee',
        ],
        'type' => [
            'label' => 'Entry Type',
            'placeholder' => 'Select entry type',
            'help' => 'Type of time entry',
            'tooltip' => 'Specify the type of record',
            'description' => 'Determines the nature of the time entry',
            'options' => [
                'clock_in' => 'Clock In',
                'clock_out' => 'Clock Out',
                'break_start' => 'Break Start',
                'break_end' => 'Break End',
            ],
        ],
        'timestamp' => [
            'label' => 'Date and Time',
            'placeholder' => 'Select date and time',
            'help' => 'Date and time of the time entry',
            'tooltip' => 'Exact moment of the record',
            'description' => 'Timestamp of the time entry',
        ],
        'location_lat' => [
            'label' => 'Latitude',
            'placeholder' => 'GPS latitude coordinate',
            'help' => 'GPS position - latitude',
            'tooltip' => 'GPS coordinates for position verification',
            'description' => 'Latitude coordinate for position tracking',
        ],
        'location_lng' => [
            'label' => 'Longitude',
            'placeholder' => 'GPS longitude coordinate',
            'help' => 'GPS position - longitude',
            'tooltip' => 'GPS coordinates for position verification',
            'description' => 'Longitude coordinate for position tracking',
        ],
        'location_name' => [
            'label' => 'Location Name',
            'placeholder' => 'E.g.: Office, Home, Client...',
            'help' => 'Description of the work location',
            'tooltip' => 'Descriptive name of the position',
            'description' => 'Human-readable identifier of the work location',
        ],
        'device_info' => [
            'label' => 'Device Info',
            'placeholder' => 'Device details used',
            'help' => 'Information about the recording device',
            'tooltip' => 'Technical details of the device',
            'description' => 'Technical metadata of the device used',
        ],
        'photo_path' => [
            'label' => 'Verification Photo',
            'placeholder' => 'Upload optional photo',
            'help' => 'Verification photo for this entry',
            'tooltip' => 'Photo to document presence',
            'description' => 'Optional verification image for the entry',
        ],
        'status' => [
            'label' => 'Approval Status',
            'placeholder' => 'Select status',
            'help' => 'Approval status of the entry',
            'tooltip' => 'Current status of the time entry',
            'description' => 'Approval status by the supervisor',
            'options' => [
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ],
        ],
        'approved_by' => [
            'label' => 'Approved By',
            'placeholder' => 'User who approved',
            'help' => 'Who approved this entry',
            'tooltip' => 'Responsible for approval',
            'description' => 'User who approved the time entry',
        ],
        'approved_at' => [
            'label' => 'Approval Date',
            'placeholder' => 'When it was approved',
            'help' => 'Date and time of approval',
            'tooltip' => 'Approval timestamp',
            'description' => 'Date and time when the entry was approved',
        ],
        'notes' => [
            'label' => 'Notes',
            'placeholder' => 'Add optional notes...',
            'help' => 'Additional notes for this entry',
            'tooltip' => 'Optional additional comments',
            'description' => 'Notes and comments for the record',
        ],
        'created_at' => [
            'label' => 'Created At',
            'help' => 'Record creation date',
            'tooltip' => 'Creation timestamp',
            'description' => 'Date and time of entry creation',
        ],
        'updated_at' => [
            'label' => 'Updated At',
            'help' => 'Last update date',
            'tooltip' => 'Last update timestamp',
            'description' => 'Date and time of last update',
        ],
    ],

    'actions' => [
        'create' => [
            'label' => 'Create Time Entry',
            'success' => 'Time entry created successfully',
            'error' => 'Unable to create time entry',
            'confirmation' => 'Confirm creation of this time entry?',
            'tooltip' => 'Create a new time record',
            'modal_heading' => 'Create New Time Entry',
            'modal_description' => 'Fill in details for the new entry',
        ],
        'edit' => [
            'label' => 'Edit Time Entry',
            'success' => 'Time entry updated successfully',
            'error' => 'Unable to update time entry',
            'confirmation' => 'Confirm changes to this time entry?',
            'tooltip' => 'Edit existing record',
            'modal_heading' => 'Edit Time Entry',
            'modal_description' => 'Update entry details',
        ],
        'delete' => [
            'label' => 'Delete Time Entry',
            'success' => 'Time entry deleted successfully',
            'error' => 'Unable to delete time entry',
            'confirmation' => 'Are you sure you want to delete this time entry? This action is irreversible.',
            'tooltip' => 'Permanently delete the record',
            'modal_heading' => 'Delete Time Entry',
            'modal_description' => 'This action will permanently delete the time entry',
        ],
        'view' => [
            'label' => 'View Details',
            'tooltip' => 'View all entry details',
            'modal_heading' => 'Time Entry Details',
            'modal_description' => 'Complete information about the entry',
        ],
        'approve' => [
            'label' => 'Approve Entry',
            'success' => 'Time entry approved successfully',
            'error' => 'Unable to approve time entry',
            'confirmation' => 'Confirm approval of this time entry?',
            'tooltip' => 'Approve the time entry',
            'modal_heading' => 'Approve Time Entry',
            'modal_description' => 'Confirm approval of this entry',
        ],
        'reject' => [
            'label' => 'Reject Entry',
            'success' => 'Time entry rejected',
            'error' => 'Unable to reject time entry',
            'confirmation' => 'Confirm rejection of this time entry?',
            'tooltip' => 'Reject the time entry',
            'modal_heading' => 'Reject Time Entry',
            'modal_description' => 'Confirm rejection of this entry',
        ],
        'bulk_approve' => [
            'label' => 'Approve Selected',
            'success' => ':count time entries approved successfully',
            'error' => 'Unable to approve selected entries',
            'confirmation' => 'Confirm approval of :count time entries?',
            'tooltip' => 'Approve all selected entries',
        ],
        'bulk_reject' => [
            'label' => 'Reject Selected',
            'success' => ':count time entries rejected successfully',
            'error' => 'Unable to reject selected entries',
            'confirmation' => 'Confirm rejection of :count time entries?',
            'tooltip' => 'Reject all selected entries',
        ],
    ],

    'sections' => [
        'time_entry_details' => [
            'heading' => 'Time Entry Details',
            'description' => 'Information about the time entry',
            'subtitle' => 'Fill in entry details',
            'collapsible' => true,
            'collapsed' => false,
        ],
        'location_info' => [
            'heading' => 'Location Information',
            'description' => 'Work location data',
            'subtitle' => 'Specify work location',
            'collapsible' => true,
            'collapsed' => true,
        ],
        'approval_info' => [
            'heading' => 'Approval Information',
            'description' => 'Status and approval details',
            'subtitle' => 'Manage entry approval',
            'collapsible' => true,
            'collapsed' => true,
        ],
        'metadata' => [
            'heading' => 'Metadata',
            'description' => 'Technical information and notes',
            'subtitle' => 'Additional details and notes',
            'collapsible' => true,
            'collapsed' => true,
        ],
    ],

    'filters' => [
        'employee' => [
            'label' => 'Employee',
            'placeholder' => 'Select employee',
            'help' => 'Filter by specific employee',
        ],
        'entry_type' => [
            'label' => 'Entry Type',
            'placeholder' => 'Select type',
            'help' => 'Filter by entry type',
        ],
        'date_range' => [
            'label' => 'Period',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'help' => 'Select period of interest',
        ],
        'status' => [
            'label' => 'Status',
            'placeholder' => 'Select status',
            'help' => 'Filter by approval status',
        ],
        'today_only' => [
            'label' => 'Today Only',
            'help' => 'Show only today\'s entries',
        ],
        'pending_approval' => [
            'label' => 'Pending Approval',
            'help' => 'Show only entries pending approval',
        ],
    ],

    'tabs' => [
        'all' => [
            'label' => 'All Entries',
            'description' => 'View all records',
            'icon' => 'heroicon-o-list-bullet',
        ],
        'today' => [
            'label' => 'Today',
            'description' => 'Today\'s entries',
            'icon' => 'heroicon-o-calendar-days',
        ],
        'this_week' => [
            'label' => 'This Week',
            'description' => 'Current week entries',
            'icon' => 'heroicon-o-calendar',
        ],
        'pending' => [
            'label' => 'Pending',
            'description' => 'Entries pending approval',
            'icon' => 'heroicon-o-clock',
        ],
        'approved' => [
            'label' => 'Approved',
            'description' => 'Approved entries',
            'icon' => 'heroicon-o-check-circle',
        ],
        'rejected' => [
            'label' => 'Rejected',
            'description' => 'Rejected entries',
            'icon' => 'heroicon-o-x-circle',
        ],
    ],

    'pages' => [
        'timeclock' => [
            'title' => 'Employee Time Clock',
            'subtitle' => 'Record your work hours easily',
            'heading' => 'Time Clock System',
            'description' => 'Interface for recording work hours',
            'welcome_message' => 'Welcome to the time clock system',
            'instructions' => 'Select entry type and confirm',
        ],
        'list' => [
            'title' => 'Work Hours',
            'subtitle' => 'Time entry management',
            'heading' => 'Time Entries List',
            'description' => 'View and manage all time entries',
            'empty_state' => 'No time entries found',
            'loading_message' => 'Loading time entries...',
        ],
        'create' => [
            'title' => 'New Time Entry',
            'subtitle' => 'Create a new time entry',
            'heading' => 'Create Time Entry',
            'description' => 'Fill in details for the new entry',
            'success_message' => 'Time entry created successfully',
        ],
        'edit' => [
            'title' => 'Edit Time Entry',
            'subtitle' => 'Edit existing entry',
            'heading' => 'Edit Time Entry',
            'description' => 'Update entry details',
            'success_message' => 'Time entry updated successfully',
        ],
        'view' => [
            'title' => 'Time Entry Details',
            'subtitle' => 'View all details',
            'heading' => 'Time Entry Details',
            'description' => 'Complete information about the entry',
        ],
    ],

    'widgets' => [
        'stats' => [
            'title' => 'Work Hours Statistics',
            'description' => 'Overview of time entries',
            'today_entries' => [
                'label' => 'Today\'s Entries',
                'description' => 'Number of entries today',
                'tooltip' => 'Count of entries recorded today',
            ],
            'this_week' => [
                'label' => 'This Week',
                'description' => 'Total hours this week',
                'tooltip' => 'Total hours worked this week',
            ],
            'avg_daily' => [
                'label' => 'Daily Average',
                'description' => 'Average hours per day',
                'tooltip' => 'Average of hours worked per day',
            ],
            'pending_approval' => [
                'label' => 'Pending Approval',
                'description' => 'Entries to approve',
                'tooltip' => 'Number of entries pending approval',
            ],
            'total_hours' => [
                'label' => 'Total Hours',
                'description' => 'Total hours worked',
                'tooltip' => 'Total sum of hours worked',
            ],
        ],
        'recent_activity' => [
            'title' => 'Recent Activity',
            'description' => 'Latest time entries',
            'empty_state' => 'No recent activity',
            'view_all' => 'View All',
            'refresh' => 'Refresh',
        ],
        'quick_actions' => [
            'title' => 'Quick Actions',
            'description' => 'Quick access to main functions',
            'clock_in' => [
                'label' => 'Clock In',
                'description' => 'Record clock in',
                'icon' => 'heroicon-o-play',
            ],
            'clock_out' => [
                'label' => 'Clock Out',
                'description' => 'Record clock out',
                'icon' => 'heroicon-o-stop',
            ],
            'break_start' => [
                'label' => 'Start Break',
                'description' => 'Start break',
                'icon' => 'heroicon-o-pause',
            ],
            'break_end' => [
                'label' => 'End Break',
                'description' => 'End break',
                'icon' => 'heroicon-o-play',
            ],
        ],
    ],

    'status' => [
        'not_clocked_in' => [
            'label' => 'Not Clocked In',
            'description' => 'Employee has not clocked in yet',
            'color' => 'gray',
            'icon' => 'heroicon-o-clock',
        ],
        'clocked_in' => [
            'label' => 'Clocked In',
            'description' => 'Employee has clocked in',
            'color' => 'green',
            'icon' => 'heroicon-o-check-circle',
        ],
        'on_break' => [
            'label' => 'On Break',
            'description' => 'Employee is on break',
            'color' => 'yellow',
            'icon' => 'heroicon-o-pause',
        ],
        'clocked_out' => [
            'label' => 'Clocked Out',
            'description' => 'Employee has clocked out',
            'color' => 'red',
            'icon' => 'heroicon-o-x-circle',
        ],
        'pending' => [
            'label' => 'Pending',
            'description' => 'Entry pending approval',
            'color' => 'orange',
            'icon' => 'heroicon-o-clock',
        ],
        'approved' => [
            'label' => 'Approved',
            'description' => 'Entry approved by supervisor',
            'color' => 'green',
            'icon' => 'heroicon-o-check-circle',
        ],
        'rejected' => [
            'label' => 'Rejected',
            'description' => 'Entry rejected by supervisor',
            'color' => 'red',
            'icon' => 'heroicon-o-x-circle',
        ],
    ],

    'messages' => [
        'validation' => [
            'invalid_sequence' => 'Invalid entry sequence. Last entry: :last_entry',
            'duplicate_entry' => 'Entry with this timestamp already exists for the employee',
            'outside_working_hours' => 'Recording available from :start to :end',
            'invalid_time' => 'Invalid time for work shift',
            'employee_required' => 'Employee field is required',
            'type_required' => 'Entry type is required',
            'timestamp_required' => 'Date and time are required',
            'timestamp_future' => 'Cannot record future entries',
            'timestamp_past_limit' => 'Cannot record entries older than :days days',
        ],
        'success' => [
            'entry_recorded' => 'Recording completed: :action at :time',
            'data_refreshed' => 'Data updated successfully',
            'entry_created' => 'Time entry created successfully',
            'entry_updated' => 'Time entry updated successfully',
            'entry_deleted' => 'Time entry deleted successfully',
            'entry_approved' => 'Time entry approved successfully',
            'entry_rejected' => 'Time entry rejected successfully',
            'bulk_approved' => ':count time entries approved successfully',
            'bulk_rejected' => ':count time entries rejected successfully',
        ],
        'error' => [
            'user_not_found' => 'Employee not found',
            'invalid_action' => 'Invalid action for current status',
            'failed_to_record' => 'Recording error: :error',
            'permission_denied' => 'You don\'t have permission for this operation',
            'entry_not_found' => 'Time entry not found',
            'invalid_status_transition' => 'Invalid status transition',
            'approval_failed' => 'Unable to approve entry: :error',
            'rejection_failed' => 'Unable to reject entry: :error',
            'bulk_operation_failed' => 'Bulk operation failed: :error',
        ],
        'empty_states' => [
            'no_entries_today' => 'No entries recorded today',
            'no_recent_entries' => 'No recent entries available',
            'no_entries_found' => 'No time entries found',
            'no_pending_approvals' => 'No entries pending approval',
            'no_approved_entries' => 'No approved entries found',
            'no_rejected_entries' => 'No rejected entries found',
        ],
        'confirmations' => [
            'delete_entry' => 'Are you sure you want to delete this time entry?',
            'bulk_delete' => 'Are you sure you want to delete :count time entries?',
            'approve_entry' => 'Confirm approval of this time entry?',
            'reject_entry' => 'Confirm rejection of this time entry?',
            'bulk_approve' => 'Confirm approval of :count time entries?',
            'bulk_reject' => 'Confirm rejection of :count time entries?',
        ],
    ],

    'summary' => [
        'total_hours_worked' => [
            'label' => 'Total Hours Worked',
            'description' => 'Total sum of hours worked',
            'tooltip' => 'Calculation based on clock in/out',
        ],
        'current_status' => [
            'label' => 'Current Status',
            'description' => 'Current employee status',
            'tooltip' => 'Status based on last entry',
        ],
        'total_entries' => [
            'label' => 'Total Entries',
            'description' => 'Total number of entries',
            'tooltip' => 'Count of all entries',
        ],
        'todays_summary' => [
            'label' => 'Today\'s Summary',
            'description' => 'Overview of today\'s entries',
            'tooltip' => 'Daily statistics',
        ],
        'todays_entries' => [
            'label' => 'Today\'s Entries',
            'description' => 'Entries made today',
            'tooltip' => 'List of today\'s entries',
        ],
        'last_entry' => [
            'label' => 'Last entry: :type at :time',
            'description' => 'Last entry made',
            'tooltip' => 'Details of last entry',
        ],
        'work_time' => [
            'label' => 'Work Time: :hours hours',
            'description' => 'Total time worked',
            'tooltip' => 'Work hours calculation',
        ],
        'break_time' => [
            'label' => 'Break Time: :hours hours',
            'description' => 'Total break time',
            'tooltip' => 'Break time calculation',
        ],
        'overtime' => [
            'label' => 'Overtime: :hours hours',
            'description' => 'Hours beyond standard schedule',
            'tooltip' => 'Overtime calculation',
        ],
    ],

    'quick_actions' => [
        'title' => 'Quick Actions',
        'description' => 'Quick access to main functions',
        'refresh_data' => [
            'label' => 'Refresh Data',
            'description' => 'Reload latest data',
            'tooltip' => 'Sync with database',
        ],
        'export_data' => [
            'label' => 'Export Data',
            'description' => 'Export data to Excel/CSV format',
            'tooltip' => 'Download report in Excel format',
        ],
        'view_reports' => [
            'label' => 'View Reports',
            'description' => 'Access reports and statistics',
            'tooltip' => 'Open reporting dashboard',
        ],
        'time_clock' => [
            'label' => 'Go to Time Clock',
            'description' => 'Access time clock system',
            'tooltip' => 'Open time clock interface',
        ],
        'view_all' => [
            'label' => 'View All Entries',
            'description' => 'Show all entries',
            'tooltip' => 'Open complete list',
        ],
        'create_entry' => [
            'label' => 'New Entry',
            'description' => 'Create new entry',
            'tooltip' => 'Open creation form',
        ],
        'bulk_approve' => [
            'label' => 'Approve Selected',
            'description' => 'Approve all selected entries',
            'tooltip' => 'Bulk approval operation',
        ],
        'bulk_reject' => [
            'label' => 'Reject Selected',
            'description' => 'Reject all selected entries',
            'tooltip' => 'Bulk rejection operation',
        ],
    ],
];
