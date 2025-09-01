<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Widgets;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Team presence widget showing who's present/absent today.
 * 
 * Displays current team presence status with department filtering
 * and detailed view capabilities.
 */
class TeamPresenceWidget extends XotBaseWidget
{
    protected static ?int $sort = 4;
    protected static ?string $maxHeight = '400px';
    
    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 1,
    ];

    public ?string $selectedDepartment = 'SVILUPPO';

    /**
     * Get the form schema for the widget.
     *
     * @return array<int, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        $presenceData = $this->getPresenceData();
        
        return [
            Section::make(__('employee::widgets.team_presence.title'))
                ->schema([
                    Select::make('department')
                        ->label(__('employee::widgets.team_presence.department'))
                        ->options($this->getDepartmentOptions())
                        ->default($this->selectedDepartment)
                        ->live()
                        ->afterStateUpdated(fn($state) => $this->selectedDepartment = $state),
                    
                    Placeholder::make('presence_stats')
                        ->content(fn() => view('employee::widgets.team-presence.stats-display', [
                            'present' => $presenceData['present'],
                            'absent' => $presenceData['absent'],
                            'presentCount' => count($presenceData['present']),
                            'absentCount' => count($presenceData['absent']),
                        ])),
                    
                    Placeholder::make('presence_list')
                        ->content(fn() => view('employee::widgets.team-presence.presence-list', [
                            'present' => $presenceData['present'],
                            'absent' => $presenceData['absent'],
                        ])),
                    
                    Actions::make([
                        Action::make('view_detail')
                            ->label(__('employee::widgets.team_presence.view_detail'))
                            ->url(fn() => route('filament.admin.resources.employees.index'))
                            ->icon('heroicon-o-eye')
                            ->color('gray')
                            ->size('sm'),
                    ])
                    ->alignment('center'),
                ])
                ->extraAttributes(['class' => 'team-presence-widget']),
        ];
    }

    /**
     * Get department options for select.
     */
    protected function getDepartmentOptions(): array
    {
        return [
            'SVILUPPO' => __('employee::widgets.team_presence.departments.development'),
            'MARKETING' => __('employee::widgets.team_presence.departments.marketing'),
            'VENDITE' => __('employee::widgets.team_presence.departments.sales'),
            'AMMINISTRAZIONE' => __('employee::widgets.team_presence.departments.administration'),
            'RISORSE_UMANE' => __('employee::widgets.team_presence.departments.hr'),
        ];
    }

    /**
     * Get presence data for selected department.
     */
    protected function getPresenceData(): array
    {
        $today = now()->startOfDay();
        $departmentFilter = $this->selectedDepartment;

        // Build base query for employees
        $baseQuery = \Modules\Employee\Models\Employee::where('status', '!=', 'terminated');
        
        if ($departmentFilter) {
            $baseQuery->whereJsonContains('work_data->department', $departmentFilter);
        }

        // Get present employees (who clocked in today and haven't clocked out)
        $present = $baseQuery->clone()
            ->whereHas('workHours', function ($query) use ($today) {
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
                $query->whereDate('timestamp', $today)
                      ->where('type', \Modules\Employee\Models\WorkHour::TYPE_CLOCK_IN)
                      ->latest('timestamp');
            }])
            ->get()
            ->map(function ($employee) {
                $lastEntry = $employee->workHours->first();
                
                return [
                    'name' => $employee->full_name ?? 'N/A',
                    'avatar' => null, // Could be implemented later with photo_url
                    'initials' => $this->generateInitials($employee->full_name ?? ''),
                    'clock_in' => $lastEntry ? $lastEntry->timestamp->format('H:i') : 'N/A',
                    'status' => $this->determineWorkingStatus($employee),
                ];
            })->toArray();

        // Get absent employees (no clock-in today)
        $absent = $baseQuery->clone()
            ->whereDoesntHave('workHours', function ($query) use ($today) {
                $query->where('type', \Modules\Employee\Models\WorkHour::TYPE_CLOCK_IN)
                      ->whereDate('timestamp', $today);
            })
            ->limit(10) // Limit for performance
            ->get()
            ->map(function ($employee) {
                return [
                    'name' => $employee->full_name ?? 'N/A',
                    'avatar' => null,
                    'initials' => $this->generateInitials($employee->full_name ?? ''),
                    'reason' => $this->getAbsenceReason($employee),
                    'status' => $this->determineAbsenceStatus($employee),
                ];
            })->toArray();

        return [
            'present' => $present,
            'absent' => $absent,
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
     * Determine working status for present employee
     */
    protected function determineWorkingStatus(\Modules\Employee\Models\Employee $employee): string
    {
        $today = now()->startOfDay();
        $currentStatus = \Modules\Employee\Models\WorkHour::getCurrentStatus($employee->id, $today);
        
        return match ($currentStatus) {
            'clocked_in' => 'working',
            'on_break' => 'break',
            default => 'working',
        };
    }

    /**
     * Get absence reason for employee
     */
    protected function getAbsenceReason(\Modules\Employee\Models\Employee $employee): string
    {
        return match ($employee->status) {
            'on_leave' => 'Ferie',
            'sick_leave' => 'Malattia',
            'inactive' => 'Permesso',
            default => 'Assente',
        };
    }

    /**
     * Determine absence status for absent employee
     */
    protected function determineAbsenceStatus(\Modules\Employee\Models\Employee $employee): string
    {
        return match ($employee->status) {
            'on_leave' => 'vacation',
            'sick_leave' => 'sick',
            'inactive' => 'permit',
            default => 'unknown',
        };
    }
}
