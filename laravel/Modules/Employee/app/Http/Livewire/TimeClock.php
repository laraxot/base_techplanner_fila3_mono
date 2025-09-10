<?php

declare(strict_types=1);

namespace Modules\Employee\Http\Livewire;

use Carbon\Carbon;
use Filament\Notifications\Notification;
<<<<<<< HEAD
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Employee\Enums\WorkHourTypeEnum;
=======
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
>>>>>>> cda86dd (.)
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\WorkHour;

class TimeClock extends Component
{
    public ?Employee $employee = null;

    public string $currentTime = '';

    public string $currentDate = '';

    public string $nextAction = '';

    public string $currentStatus = '';

    public ?WorkHour $lastEntry = null;

<<<<<<< HEAD
    /** @var array<int, array{time:string,type:string}> */
    public array $todayEntries = [];
=======
    public $todayEntries = [];
>>>>>>> cda86dd (.)

    public float $workedHours = 0.0;

    public string $notes = '';

<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> cda86dd (.)
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(?int $employeeId = null): void
    {
<<<<<<< HEAD
        $employee = $employeeId ? Employee::find($employeeId) : (Auth::user()->employee ?? null);
        $this->employee = $employee instanceof Employee ? $employee : null;

=======
        $this->employee = $employeeId
            ? Employee::find($employeeId)
            : (Auth::user()->employee ?? null);
>>>>>>> cda86dd (.)
        $this->updateTimeAndStatus();
        $this->loadTodayData();
    }

<<<<<<< HEAD
    public function render(): View
=======
    public function render()
>>>>>>> cda86dd (.)
    {
        return view('employee::livewire.time-clock');
    }

    public function updatedNotes(): void
    {
        $this->notes = trim($this->notes);
    }

    public function clockAction(): void
    {
        if (! $this->employee) {
            $this->showNotification('Error', 'Employee not found', 'danger');
<<<<<<< HEAD
=======

>>>>>>> cda86dd (.)
            return;
        }

        try {
<<<<<<< HEAD
            $now = Carbon::now();
            if ($now->hour < 6 || $now->hour > 22) {
                $this->showNotification('Outside Working Hours', 'Time clock is only available between 6:00 AM and 10:00 PM', 'warning');
                return;
            }

            if (! WorkHour::isValidNextEntry($this->employee->id, $this->nextAction)) {
                $this->showNotification('Invalid Action', 'This action is not valid based on your current status', 'danger');
                return;
            }

=======
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
            if (! WorkHour::isValidNextEntry($this->employee->id, $this->nextAction)) {
                $this->showNotification(
                    'Invalid Action',
                    'This action is not valid based on your current status',
                    'danger'
                );

                return;
            }

            // Create the work hour entry
>>>>>>> cda86dd (.)
            WorkHour::create([
                'employee_id' => $this->employee->id,
                'badge_id' => $this->employee->employee_code,
                'timestamp' => $now,
                'type' => $this->nextAction,
<<<<<<< HEAD
                'notes' => $this->notes !== '' ? $this->notes : null,
                'status' => 'pending',
            ]);

            $this->notes = '';

            $actionLabel = $this->getActionLabel($this->nextAction);
            $this->showNotification('Success', "Successfully recorded: {$actionLabel}", 'success');

            $this->updateTimeAndStatus();
            $this->loadTodayData();
            $this->dispatch('workHourRecorded');
        } catch (\Throwable $e) {
            $this->showNotification('Error', 'Failed to record time entry: '.$e->getMessage(), 'danger');
=======
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
                'Failed to record time entry: '.$e->getMessage(),
                'danger'
            );
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD
            $this->nextAction = (string) WorkHour::getNextAction($this->employee->id);
            $this->currentStatus = (string) WorkHour::getCurrentStatus($this->employee->id);
            $this->workedHours = (float) WorkHour::calculateWorkedHours($this->employee->id);
=======
            $this->nextAction = WorkHour::getNextAction($this->employee->id);
            $this->currentStatus = WorkHour::getCurrentStatus($this->employee->id);
>>>>>>> cda86dd (.)
        }
    }

    private function loadTodayData(): void
    {
<<<<<<< HEAD
        if (! $this->employee) {
            $this->todayEntries = [];
            return;
        }

        $entries = WorkHour::getTodayEntries($this->employee->id);
        /** @var array<int, array{time:string,type:string}> */
        $mappedEntries = $entries->map(function (WorkHour $entry): array {
            return [
                'time' => $entry->timestamp->format('H:i'),
                'type' => (string) $entry->type,
            ];
        })->toArray();
        /** @var array<int, array{time:string,type:string}> $mappedEntries */
        $this->todayEntries = array_values($mappedEntries);
=======
        if ($this->employee) {
            $this->todayEntries = WorkHour::getTodayEntries($this->employee->id)->toArray();
            $this->workedHours = WorkHour::calculateWorkedHours($this->employee->id);
        }
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD
            WorkHourTypeEnum::CLOCK_IN->value => 'Clock In',
            WorkHourTypeEnum::CLOCK_OUT->value => 'Clock Out',
            WorkHourTypeEnum::BREAK_START->value => 'Start Break',
            WorkHourTypeEnum::BREAK_END->value => 'End Break',
=======
            WorkHour::TYPE_CLOCK_IN => 'Clock In',
            WorkHour::TYPE_CLOCK_OUT => 'Clock Out',
            WorkHour::TYPE_BREAK_START => 'Start Break',
            WorkHour::TYPE_BREAK_END => 'End Break',
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD
            WorkHourTypeEnum::CLOCK_IN->value => 'success',
            WorkHourTypeEnum::CLOCK_OUT->value => 'danger',
            WorkHourTypeEnum::BREAK_START->value => 'warning',
            WorkHourTypeEnum::BREAK_END->value => 'info',
=======
            WorkHour::TYPE_CLOCK_IN => 'success',
            WorkHour::TYPE_CLOCK_OUT => 'danger',
            WorkHour::TYPE_BREAK_START => 'warning',
            WorkHour::TYPE_BREAK_END => 'info',
>>>>>>> cda86dd (.)
            default => 'primary',
        };
    }

    public function getActionButtonIcon(): string
    {
        return match ($this->nextAction) {
<<<<<<< HEAD
            WorkHourTypeEnum::CLOCK_IN->value => 'heroicon-o-play',
            WorkHourTypeEnum::CLOCK_OUT->value => 'heroicon-o-stop',
            WorkHourTypeEnum::BREAK_START->value => 'heroicon-o-pause',
            WorkHourTypeEnum::BREAK_END->value => 'heroicon-o-play',
=======
            WorkHour::TYPE_CLOCK_IN => 'heroicon-o-play',
            WorkHour::TYPE_CLOCK_OUT => 'heroicon-o-stop',
            WorkHour::TYPE_BREAK_START => 'heroicon-o-pause',
            WorkHour::TYPE_BREAK_END => 'heroicon-o-play',
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD
            WorkHourTypeEnum::CLOCK_IN->value => 'Clock In',
            WorkHourTypeEnum::CLOCK_OUT->value => 'Clock Out',
            WorkHourTypeEnum::BREAK_START->value => 'Break Start',
            WorkHourTypeEnum::BREAK_END->value => 'Break End',
=======
            WorkHour::TYPE_CLOCK_IN => 'Clock In',
            WorkHour::TYPE_CLOCK_OUT => 'Clock Out',
            WorkHour::TYPE_BREAK_START => 'Break Start',
            WorkHour::TYPE_BREAK_END => 'Break End',
>>>>>>> cda86dd (.)
            default => $type,
        };
    }

    public function getEntryTypeColor(string $type): string
    {
        return match ($type) {
<<<<<<< HEAD
            WorkHourTypeEnum::CLOCK_IN->value => 'success',
            WorkHourTypeEnum::CLOCK_OUT->value => 'danger',
            WorkHourTypeEnum::BREAK_START->value => 'warning',
            WorkHourTypeEnum::BREAK_END->value => 'info',
=======
            WorkHour::TYPE_CLOCK_IN => 'success',
            WorkHour::TYPE_CLOCK_OUT => 'danger',
            WorkHour::TYPE_BREAK_START => 'warning',
            WorkHour::TYPE_BREAK_END => 'info',
>>>>>>> cda86dd (.)
            default => 'gray',
        };
    }
}
