<?php

declare(strict_types=1);

return [
    'todo' => [
        'title' => 'To Do',
        'description' => 'HR activities that require your attention',
        'priority' => [
            'high' => 'High',
            'medium' => 'Medium',
            'low' => 'Low',
        ],
        'due_date' => 'Due date',
        'action_button' => 'Go',
        'view_all' => 'View all tasks',
        'empty_state' => [
            'title' => 'All done!',
            'description' => 'You have no pending tasks at the moment.',
        ],
    ],

    'upcoming_schedule' => [
        'title' => 'Next 7 days',
        'description' => 'Upcoming events and appointments',
        'tabs' => [
            'all' => 'All',
            'absences' => 'Absences',
            'smart_working' => 'Smart Working',
            'transfers' => 'Transfers',
        ],
        'status' => [
            'approved' => 'Approved',
            'pending' => 'Pending',
            'rejected' => 'Rejected',
        ],
        'types' => [
            'absence' => 'Absence',
            'smart_working' => 'Smart Working',
            'transfer' => 'Transfer',
        ],
        'days' => 'days',
        'view_all' => 'View attendance',
        'empty_state' => [
            'title' => 'No scheduled events',
            'description' => 'There are no events in the next 7 days.',
        ],
    ],

    'time_off_balance' => [
        'title' => 'My balances',
        'description' => 'Leave and permit balances for :month',
        'view_period' => 'Period',
        'monthly' => 'Monthly',
        'annual' => 'Annual',
        'current_balance' => 'Current balance',
        'used' => 'Used',
        'total' => 'Total',
        'no_limit' => 'No limit',
        'negative_balance' => 'Negative balance',
        'exhausted' => 'Exhausted',
        'last_updated' => 'Last updated',
        'view_details' => 'View details',
    ],

    'today_presence' => [
        'title' => 'Who\'s here today',
        'description' => 'Real-time attendance',
        'present' => 'Present',
        'absent' => 'Absent',
        'present_employees' => 'Present employees',
        'absent_employees' => 'Absent employees',
        'return_date' => 'Return',
        'last_updated' => 'Updated at',
        'view_details' => 'View details',
    ],

    'pending_requests' => [
        'title' => 'My pending requests',
        'description' => 'Status of your approval requests',
        'status' => [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'under_review' => 'Under review',
        ],
        'priority' => [
            'high' => 'High',
            'normal' => 'Normal',
            'low' => 'Low',
        ],
        'submitted' => 'Submitted',
        'approver' => 'Approver',
        'days_pending' => 'days pending',
        'view' => 'View',
        'cancel' => 'Cancel',
        'view_all' => 'View all requests',
        'new_request' => 'New request',
        'empty_state' => [
            'title' => 'All managed!',
            'description' => 'All your requests have been handled by the administrator.',
        ],
    ],

    // Existing widgets
    'time_tracking' => [
        'title' => 'Time Tracking',
        'description' => 'Work hours management',
        'current_time' => 'Current time',
        'session_status' => 'Session status',
        'clock_in' => 'Clock in',
        'clock_out' => 'Clock out',
        'break_start' => 'Break',
        'break_end' => 'End break',
        'total_hours' => 'Total hours',
        'break_time' => 'Break time',
        'status' => [
            'out' => 'Out',
            'in' => 'In',
            'break' => 'On break',
        ],
    ],

    'employee_overview' => [
        'title' => 'Employee overview',
        'description' => 'General employee statistics',
        'total_employees' => 'Total employees',
        'active_employees' => 'Active employees',
        'departments' => 'Departments',
        'new_this_month' => 'New this month',
    ],

    'work_hour_stats' => [
        'title' => 'Work hour statistics',
        'description' => 'Time tracking analysis',
        'daily_hours' => 'Daily hours',
        'weekly_hours' => 'Weekly hours',
        'pending_approvals' => 'Pending approvals',
        'overtime_hours' => 'Overtime hours',
    ],
];