<?php

declare(strict_types=1);

namespace Modules\Employee\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Modules\Employee\Models\WorkHour;
use Modules\Employee\Models\Employee;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class TimeClock extends Component
{
    public ?Employee $employee = null;
    public string $currentTime = '';
    public string $currentDate = '';
    public string $nextAction = '';
    public string $currentStatus = '';
    public ?WorkHour $lastEntry = null;
    public $todayEntries = [];
    public float $workedHours = 0.0;
    public string $notes = '';

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(?int $employeeId = null): void
    {
        $this->employee = $employeeId 
            ? Employee::find($employeeId) 
            : (Auth::user()->employee ?? null);
        $this->updateTimeAndStatus();
        $this->loadTodayData();
    }

    public function render()
    {
        return view('employee::livewire.time-clock');
    }

    public function updatedNotes(): void
    {
        $this->notes = trim($this->notes);
    }

    public function clockAction(): void
    {
        if (!$this->employee) {
            $this->showNotification('Error', 'Employee not found', 'danger');
            return;
        }

        try {
            // Validate working hours (6 AM to 10 PM)
            $now = Carbon::now();
            if ($now->hour < 6 || $now->hour > 22) {
                $this->showNotification(
                    'Outside Working Hours',
                    'Time clock is only available between 6:00 AM and 10:00 PM',
                    'warning'
                );
                return;
            }

            // Check if the next action is valid
            if (!WorkHour::isValidNextEntry($this->employee->id, $this->nextAction)) {
                $this->showNotification(
                    'Invalid Action',
                    'This action is not valid based on your current status',
                    'danger'
                );
                return;
            }

            // Create the work hour entry
            WorkHour::create([
                'employee_id' => $this->employee->id,
                'badge_id' => $this->employee->employee_code,
                'timestamp' => $now,
                'type' => $this->nextAction,
                'notes' => $this->notes ?: null,
                'status' => 'pending',
            ]);

            // Clear notes after successful entry
            $this->notes = '';

            // Show success notification
            $actionLabel = $this->getActionLabel($this->nextAction);
            $this->showNotification(
                'Success',
                "Successfully recorded: {$actionLabel}",
                'success'
            );

            // Refresh data
            $this->updateTimeAndStatus();
            $this->loadTodayData();

            // Emit event to refresh other components
            $this->dispatch('workHourRecorded');

        } catch (\Exception $e) {
            $this->showNotification(
                'Error',
                'Failed to record time entry: ' . $e->getMessage(),
                'danger'
            );
        }
    }

    public function refreshData(): void
    {
        $this->updateTimeAndStatus();
        $this->loadTodayData();
    }

    private function updateTimeAndStatus(): void
    {
        $now = Carbon::now();
        $this->currentTime = $now->format('H:i:s');
        $this->currentDate = $now->format('d/m/Y');

        if ($this->employee) {
            $this->lastEntry = WorkHour::getLastEntryForEmployee($this->employee->id);
            $this->nextAction = WorkHour::getNextAction($this->employee->id);
            $this->currentStatus = WorkHour::getCurrentStatus($this->employee->id);
        }
    }

    private function loadTodayData(): void
    {
        if ($this->employee) {
            $this->todayEntries = WorkHour::getTodayEntries($this->employee->id)->toArray();
            $this->workedHours = WorkHour::calculateWorkedHours($this->employee->id);
        }
    }

    private function showNotification(string $title, string $body, string $type): void
    {
        Notification::make()
            ->title($title)
            ->body($body)
            ->color($type)
            ->send();
    }

    public function getActionLabel(string $action): string
    {
        return match ($action) {
            WorkHour::TYPE_CLOCK_IN => 'Clock In',
            WorkHour::TYPE_CLOCK_OUT => 'Clock Out',
            WorkHour::TYPE_BREAK_START => 'Start Break',
            WorkHour::TYPE_BREAK_END => 'End Break',
            default => $action,
        };
    }

    public function getStatusLabel(): string
    {
        return match ($this->currentStatus) {
            'not_clocked_in' => 'Not Clocked In',
            'clocked_in' => 'Clocked In',
            'on_break' => 'On Break',
            'clocked_out' => 'Clocked Out',
            default => 'Unknown',
        };
    }

    public function getStatusColor(): string
    {
        return match ($this->currentStatus) {
            'not_clocked_in' => 'gray',
            'clocked_in' => 'green',
            'on_break' => 'orange',
            'clocked_out' => 'red',
            default => 'gray',
        };
    }

    public function getActionButtonColor(): string
    {
        return match ($this->nextAction) {
            WorkHour::TYPE_CLOCK_IN => 'success',
            WorkHour::TYPE_CLOCK_OUT => 'danger',
            WorkHour::TYPE_BREAK_START => 'warning',
            WorkHour::TYPE_BREAK_END => 'info',
            default => 'primary',
        };
    }

    public function getActionButtonIcon(): string
    {
        return match ($this->nextAction) {
            WorkHour::TYPE_CLOCK_IN => 'heroicon-o-play',
            WorkHour::TYPE_CLOCK_OUT => 'heroicon-o-stop',
            WorkHour::TYPE_BREAK_START => 'heroicon-o-pause',
            WorkHour::TYPE_BREAK_END => 'heroicon-o-play',
            default => 'heroicon-o-clock',
        };
    }

    public function formatTime(string $time): string
    {
        return Carbon::parse($time)->format('H:i:s');
    }

    public function formatEntryType(string $type): string
    {
        return match ($type) {
            WorkHour::TYPE_CLOCK_IN => 'Clock In',
            WorkHour::TYPE_CLOCK_OUT => 'Clock Out',
            WorkHour::TYPE_BREAK_START => 'Break Start',
            WorkHour::TYPE_BREAK_END => 'Break End',
            default => $type,
        };
    }

    public function getEntryTypeColor(string $type): string
    {
        return match ($type) {
            WorkHour::TYPE_CLOCK_IN => 'success',
            WorkHour::TYPE_CLOCK_OUT => 'danger',
            WorkHour::TYPE_BREAK_START => 'warning',
            WorkHour::TYPE_BREAK_END => 'info',
            default => 'gray',
        };
    }
}
