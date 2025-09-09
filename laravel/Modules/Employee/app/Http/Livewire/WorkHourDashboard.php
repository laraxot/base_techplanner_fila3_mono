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
        'refreshDashboard' => 'refreshStats'

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

        $this->weeklyStats = [
            'total_hours' => $this->weekHours,
            'days_worked' => $this->getDaysWorkedInPeriod($startOfWeek, $endOfWeek),
            'average_daily' => $this->weekHours / 7,
        ];
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

        $this->monthlyStats = [
            'total_hours' => $this->monthHours,
            'days_worked' => $this->getDaysWorkedInPeriod($startOfMonth, $endOfMonth),
            'average_daily' => $this->monthHours / Carbon::now()->daysInMonth,
        ];
    }

    private function loadRecentEntries(): void
    {
        if (!$this->employee) {
            $this->recentEntries = [];
            return;
        }

        $entries = WorkHour::getTodayEntries($this->employee->id);
        $this->recentEntries = $entries->map(function (WorkHour $entry): array {
            return [
                'id' => $entry->id,
                'time' => $entry->timestamp->format('H:i'),
                'type' => (string) $entry->type,
                'status' => (string) $entry->status,
            ];
        })->toArray();
    }

    private function getDaysWorkedInPeriod(Carbon $start, Carbon $end): int
    {
        if (!$this->employee) {
            return 0;
        }

        $entries = WorkHour::where('employee_id', $this->employee->id)
            ->whereBetween('timestamp', [$start, $end])
            ->where('type', WorkHour::TYPE_CLOCK_IN)
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
