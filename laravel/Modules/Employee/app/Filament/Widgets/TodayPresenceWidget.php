<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Widgets;

<<<<<<< HEAD
use Modules\Employee\Models\Employee;
=======
>>>>>>> cda86dd (.)
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * TodayPresenceWidget - Real-time Presence Tracking Widget
 *
 * Displays who is present today with real-time counters,
 * employee avatars, and detailed presence information.
 */
class TodayPresenceWidget extends XotBaseWidget
{
    protected static string $view = 'employee::filament.widgets.today-presence-widget';

<<<<<<< HEAD
    protected int|string|array $columnSpan = 1;
=======
    protected int|string|array $columnSpan = 'full';
>>>>>>> cda86dd (.)

    protected static ?int $sort = 4;

    /**
     * Get the form schema for the widget.
     *
     * @return array<int|string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [];
    }

    /**
     * Get today's presence data
     *
     * @return array<string, mixed>
     */
    protected function getTodayPresence(): array
    {
<<<<<<< HEAD
        // Mock implementation since Employee->workHours relation doesn't exist
        $employees = Employee::limit(10)->get();

        $presentEmployees = [];
        $absentEmployees = [];

        foreach ($employees as $index => $employee) {
            $employeeData = [
                'id' => $employee->id,
                'name' => $employee->full_name ?? 'N/A',
                'initials' => $this->generateInitials($employee->full_name ?? ''),
            ];

            // Mock logic: first 6 are present, rest absent
            if ($index < 6) {
                $presentEmployees[] = array_merge($employeeData, [
                    'department' => 'SVILUPPO',
                    'check_in_time' => '08:'.str_pad((string) (30 + $index * 5), 2, '0', STR_PAD_LEFT),
                    'location' => 'Ufficio',
                    'status' => 'present',
                    'work_type' => $index % 2 === 0 ? 'office' : 'remote',
                ]);
            } else {
                $absentEmployees[] = array_merge($employeeData, [
                    'department' => 'MARKETING',
                    'absence_type' => 'vacation',
                    'absence_reason' => 'Ferie',
                    'return_date' => now()->addDays(rand(1, 5))->format('Y-m-d'),
                ]);
            }
        }
=======
        $today = now()->startOfDay();

        // Get employees who clocked in today (present employees)
        $presentEmployees = \Modules\Employee\Models\Employee::whereHas('workHours', function ($query) use ($today) {
            $query->where('type', \Modules\Employee\Models\WorkHour::TYPE_CLOCK_IN)
                ->whereDate('timestamp', $today)
                ->whereNotExists(function ($subQuery) use ($today) {
                    $subQuery->from('time_entries as te2')
                        ->whereColumn('te2.employee_id', 'time_entries.employee_id')
                        ->where('te2.type', \Modules\Employee\Models\WorkHour::TYPE_CLOCK_OUT)
                        ->whereDate('te2.timestamp', $today)
                        ->where('te2.timestamp', '>', \DB::raw('time_entries.timestamp'));
                });
        })
            ->with(['workHours' => function ($query) use ($today) {
                $query->whereDate('timestamp', $today)->latest('timestamp');
            }])
            ->get()
            ->map(function ($employee) {
                $lastEntry = $employee->workHours->first();
                $workType = $this->determineWorkType($lastEntry);

                return [
                    'id' => $employee->id,
                    'name' => $employee->full_name ?? 'N/A',
                    'initials' => $this->generateInitials($employee->full_name ?? ''),
                    'department' => $employee->work_data['department'] ?? 'N/A',
                    'check_in_time' => $lastEntry ? $lastEntry->timestamp->format('H:i') : 'N/A',
                    'location' => $lastEntry->location_name ?? $workType['default_location'],
                    'status' => 'present',
                    'work_type' => $workType['type'],
                ];
            })->toArray();

        // Get employees who are absent (no clock-in today or on leave)
        $absentEmployees = \Modules\Employee\Models\Employee::whereDoesntHave('workHours', function ($query) use ($today) {
            $query->where('type', \Modules\Employee\Models\WorkHour::TYPE_CLOCK_IN)
                ->whereDate('timestamp', $today);
        })
            ->where('status', '!=', 'terminated') // Don't show terminated employees
            ->limit(10) // Limit for performance
            ->get()
            ->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'name' => $employee->full_name ?? 'N/A',
                    'initials' => $this->generateInitials($employee->full_name ?? ''),
                    'department' => $employee->work_data['department'] ?? 'N/A',
                    'absence_type' => $this->determineAbsenceType($employee),
                    'absence_reason' => $this->getAbsenceReason($employee),
                    'return_date' => $this->getEstimatedReturnDate($employee),
                ];
            })->toArray();
>>>>>>> cda86dd (.)

        return [
            'present' => $presentEmployees,
            'absent' => $absentEmployees,
            'total_present' => count($presentEmployees),
            'total_absent' => count($absentEmployees),
        ];
    }

    /**
     * Generate initials from full name
     */
    protected function generateInitials(string $fullName): string
    {
        $parts = explode(' ', trim($fullName));
        if (empty($parts) || $fullName === '') {
            return 'N/A';
        }

        $initials = '';
        foreach (array_slice($parts, 0, 2) as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }

        return $initials;
    }

    /**
<<<<<<< HEAD
=======
     * Determine work type based on last entry
     *
     * @return array<string, string>
     */
    protected function determineWorkType(?\Modules\Employee\Models\WorkHour $lastEntry): array
    {
        if (! $lastEntry) {
            return ['type' => 'office', 'default_location' => 'Ufficio'];
        }

        if ($lastEntry->location_name) {
            if (str_contains(strtolower($lastEntry->location_name), 'smart') ||
                str_contains(strtolower($lastEntry->location_name), 'remote') ||
                str_contains(strtolower($lastEntry->location_name), 'casa')) {
                return ['type' => 'remote', 'default_location' => 'Smart Working'];
            }

            if (str_contains(strtolower($lastEntry->location_name), 'trasferta') ||
                str_contains(strtolower($lastEntry->location_name), 'viaggio')) {
                return ['type' => 'travel', 'default_location' => 'Trasferta'];
            }
        }

        return ['type' => 'office', 'default_location' => 'Ufficio'];
    }

    /**
     * Determine absence type for employee
     */
    protected function determineAbsenceType(\Modules\Employee\Models\Employee $employee): string
    {
        // This would typically check a leaves/absences table
        // For now, return a default based on status
        return match ($employee->status) {
            'on_leave' => 'vacation',
            'sick_leave' => 'sick',
            'inactive' => 'permit',
            default => 'unknown',
        };
    }

    /**
     * Get absence reason for employee
     */
    protected function getAbsenceReason(\Modules\Employee\Models\Employee $employee): string
    {
        return match ($this->determineAbsenceType($employee)) {
            'vacation' => 'Ferie programmate',
            'sick' => 'Malattia',
            'permit' => 'Permesso personale',
            default => 'Non specificato',
        };
    }

    /**
     * Get estimated return date for employee
     */
    protected function getEstimatedReturnDate(\Modules\Employee\Models\Employee $employee): string
    {
        // This would typically come from a leaves table
        // For now, provide reasonable defaults
        return match ($this->determineAbsenceType($employee)) {
            'sick' => now()->addDays(1)->format('d/m/Y'),
            'vacation' => now()->addDays(rand(1, 5))->format('d/m/Y'),
            default => now()->addDay()->format('d/m/Y'),
        };
    }

    /**
>>>>>>> cda86dd (.)
     * Get avatar background color based on initials
     */
    protected function getAvatarColor(string $initials): string
    {
        $colors = [
            'bg-red-500', 'bg-blue-500', 'bg-green-500', 'bg-yellow-500',
            'bg-purple-500', 'bg-pink-500', 'bg-indigo-500', 'bg-teal-500',
            'bg-orange-500', 'bg-cyan-500', 'bg-lime-500', 'bg-amber-500',
        ];

        $hash = array_sum(array_map('ord', str_split($initials)));

        return $colors[$hash % count($colors)];
    }

    /**
     * Get work type configuration
     *
     * @return array<string, string>
     */
    protected function getWorkTypeConfig(string $type): array
    {
        return match ($type) {
            'office' => [
                'icon' => 'heroicon-o-building-office',
                'color' => 'text-blue-600',
                'bg' => 'bg-blue-50',
            ],
            'remote' => [
                'icon' => 'heroicon-o-home',
                'color' => 'text-green-600',
                'bg' => 'bg-green-50',
            ],
            'travel' => [
                'icon' => 'heroicon-o-map-pin',
                'color' => 'text-purple-600',
                'bg' => 'bg-purple-50',
            ],
            default => [
                'icon' => 'heroicon-o-user',
                'color' => 'text-gray-600',
                'bg' => 'bg-gray-50',
            ],
        };
    }

    /**
     * Get absence type configuration
     *
     * @return array<string, string>
     */
    protected function getAbsenceTypeConfig(string $type): array
    {
        return match ($type) {
            'vacation' => [
                'icon' => 'heroicon-o-sun',
                'color' => 'text-orange-600',
                'bg' => 'bg-orange-50',
            ],
            'sick' => [
                'icon' => 'heroicon-o-heart',
                'color' => 'text-red-600',
                'bg' => 'bg-red-50',
            ],
            'permit' => [
                'icon' => 'heroicon-o-document-text',
                'color' => 'text-blue-600',
                'bg' => 'bg-blue-50',
            ],
            default => [
                'icon' => 'heroicon-o-x-circle',
                'color' => 'text-gray-600',
                'bg' => 'bg-gray-50',
            ],
        };
    }

    /**
     * Get data for the widget view
     *
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        return [
            'presenceData' => $this->getTodayPresence(),
        ];
    }

    /**
     * Get full name from Employee model using real database fields
     */
    protected function getEmployeeFullName(Employee $employee): string
    {
        // Use full_name mutator if available
        if (! empty($employee->full_name)) {
            return $employee->full_name;
        }

        // Combine first_name + last_name
        if (! empty($employee->first_name) || ! empty($employee->last_name)) {
            return trim(($employee->first_name ?? '').' '.($employee->last_name ?? ''));
        }

        // Fallback to name field
        return $employee->name ?? 'Dipendente #'.$employee->id;
    }

    /**
     * Get initials from full name
     */
    protected function getInitialsFromName(string $fullName): string
    {
        $parts = explode(' ', trim($fullName));
        $initials = '';

        foreach ($parts as $part) {
            if (! empty($part)) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
        }

        return substr($initials, 0, 2) ?: 'DP';
    }
}
