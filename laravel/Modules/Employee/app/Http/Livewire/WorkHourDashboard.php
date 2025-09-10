<?php

declare(strict_types=1);

namespace Modules\Employee\Http\Livewire;

use Carbon\Carbon;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Employee\Enums\WorkHourStatusEnum;
use Modules\Employee\Enums\WorkHourTypeEnum;
use Modules\Employee\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Modules\Employee\Models\WorkHour;

class WorkHourDashboard extends Component
{
    public ?Employee $employee = null;


    /** @var array<int, array{date: string, day: string, hours: float, formatted_hours: string}> */
    public array $weeklyStats = [];

    /** @var array<int, array{week: int, start_date: string, end_date: string, hours: float, formatted_hours: string}> */
    public array $monthlyStats = [];

    public float $todayHours = 0.0;

    public float $weekHours = 0.0;

    public float $monthHours = 0.0;

    /** @var array<int, array{id: int, date: string, time: string, type: WorkHourTypeEnum, type_label: string, type_color: string, notes: string|null, status: WorkHourStatusEnum, status_color: string}> */
    public array $recentEntries = [];

    public string $selectedPeriod = 'week';

    /** @var array<string, string> */
    protected $listeners = [
        'workHourRecorded' => 'refreshStats',
        'refreshDashboard' => 'refreshStats',
    ];
    public function mount(?int $employeeId = null): void
    {
        $this->employee = $employeeId 
            ? Employee::find($employeeId) 
            : (Auth::user()->employee ?? null);
        $this->refreshStats();
    }

    public function getProgressPercentage(): int
    {
        // Assuming 40 hours per week as target
        $targetHours = 40;
        $percentage = ($this->weekHours / $targetHours) * 100;

        return min(100, (int) round($percentage));
    }

    public function getProgressColor(): string
    {
        $percentage = $this->getProgressPercentage();
        

        
        if ($percentage >= 90) {
            return 'success';
        } elseif ($percentage >= 70) {
            return 'warning';
        } else {
            return 'danger';
        }
    }

    public function refreshStats(): void
    {
        if (!$this->employee) {
            return;
        }

        $this->calculateTodayHours();
        $this->calculateWeeklyStats();
        $this->calculateMonthlyStats();
        $this->loadRecentEntries();
    }

    private function calculateTodayHours(): void
    {
        if (!$this->employee) {
            $this->todayHours = 0.0;
            return;
        }

        $this->todayHours = (float) WorkHour::calculateWorkedHours($this->employee->id);
    }

    private function calculateWeeklyStats(): void
    {
        if (!$this->employee) {
            $this->weekHours = 0.0;
            $this->weeklyStats = [];
            return;
        }

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        $this->weekHours = (float) WorkHour::calculateWorkedHours(
            $this->employee->id, 
            $startOfWeek
        );

        $this->weeklyStats = [];
        
        // Build proper weekly stats array
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dayHours = WorkHour::calculateWorkedHours($this->employee->id, $date);
            $this->weeklyStats[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->format('D'),
                'hours' => (float) $dayHours,
                'formatted_hours' => number_format($dayHours, 2) . 'h',
            ];
        }
    }

    private function calculateMonthlyStats(): void
    {
        if (!$this->employee) {
            $this->monthHours = 0.0;
            $this->monthlyStats = [];
            return;
        }

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        $this->monthHours = (float) WorkHour::calculateWorkedHours(
            $this->employee->id, 
            $startOfMonth
        );

        $this->monthlyStats = [];
        
        // Build proper monthly stats array by weeks
        $currentWeek = $startOfMonth->copy();
        $weekNumber = 1;
        while ($currentWeek->lte($endOfMonth)) {
            $weekEnd = $currentWeek->copy()->endOfWeek();
            if ($weekEnd->gt($endOfMonth)) {
                $weekEnd = $endOfMonth->copy();
            }
            
            $weekHours = 0.0;
            $tempDate = $currentWeek->copy();
            while ($tempDate->lte($weekEnd)) {
                $weekHours += WorkHour::calculateWorkedHours($this->employee->id, $tempDate);
                $tempDate->addDay();
            }
            
            $this->monthlyStats[] = [
                'week' => $weekNumber,
                'start_date' => $currentWeek->format('d/m'),
                'end_date' => $weekEnd->format('d/m'),
                'hours' => $weekHours,
                'formatted_hours' => number_format($weekHours, 2) . 'h',
            ];
            
            $currentWeek->addWeek();
            $weekNumber++;
        }
    }

    private function loadRecentEntries(): void
    {
        if (!$this->employee) {
            $this->recentEntries = [];
            return;
        }

        $entries = WorkHour::getTodayEntries($this->employee->id);
        /** @var array<int, array{id: int, date: string, time: string, type: WorkHourTypeEnum, type_label: string, type_color: string, notes: string|null, status: WorkHourStatusEnum, status_color: string}> $mappedEntries */
        $mappedEntries = $entries->map(function (WorkHour $entry): array {
            return [
                'id' => $entry->id,
                'date' => $entry->timestamp->format('Y-m-d'),
                'time' => $entry->timestamp->format('H:i'),
                'type' => $entry->type,
                'type_label' => $entry->type instanceof WorkHourTypeEnum ? $entry->type->getLabel() : (string) $entry->type,
                'type_color' => $entry->type instanceof WorkHourTypeEnum ? $entry->type->getColor() : 'gray',
                'notes' => $entry->notes,
                'status' => $entry->status,
                'status_color' => $entry->status instanceof WorkHourStatusEnum ? $entry->status->getColor() : 'gray',
            ];
        })->toArray();
        $this->recentEntries = $mappedEntries;
    }

    private function getDaysWorkedInPeriod(Carbon $start, Carbon $end): int
    {
        if (!$this->employee) {
            return 0;
        }

        $entries = WorkHour::where('employee_id', $this->employee->id)
            ->whereBetween('timestamp', [$start, $end])
            ->where('type', WorkHourTypeEnum::CLOCK_IN->value)
            ->get();

        return $entries->groupBy(function (WorkHour $entry): string {
            return $entry->timestamp->format('Y-m-d');
        })->count();
    }

    public function render(): View
    {
        return view('employee::livewire.work-hour-dashboard');
    }
}
