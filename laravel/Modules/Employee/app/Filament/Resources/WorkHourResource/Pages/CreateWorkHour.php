<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Resources\WorkHourResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Modules\Employee\Filament\Resources\WorkHourResource;
use Modules\Employee\Models\WorkHour;
use Filament\Notifications\Notification;
use Carbon\Carbon;

class CreateWorkHour extends XotBaseCreateRecord
{
    protected static string $resource = WorkHourResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set default status if not provided
        if (!isset($data['status'])) {
            $data['status'] = WorkHour::STATUS_PENDING;
        }

        return $data;
    }

    protected function beforeCreate(): void
    {
        $data = $this->form->getState();
        
        // Validate if this entry is allowed based on the last entry
        $timestamp = Carbon::parse($data['timestamp']);
        $lastEntry = WorkHour::getLastEntryForEmployee($data['employee_id'], $timestamp);
        $expectedAction = WorkHour::getNextAction($data['employee_id'], $timestamp);
        
        if ($data['type'] !== $expectedAction) {
            $lastEntryType = $lastEntry ? match ($lastEntry->type) {
                WorkHour::TYPE_CLOCK_IN => 'Clock In',
                WorkHour::TYPE_CLOCK_OUT => 'Clock Out',
                WorkHour::TYPE_BREAK_START => 'Break Start',
                WorkHour::TYPE_BREAK_END => 'Break End',
                default => $lastEntry->type,
            } : 'None';
            
            $expectedActionLabel = match ($expectedAction) {
                WorkHour::TYPE_CLOCK_IN => 'Clock In',
                WorkHour::TYPE_CLOCK_OUT => 'Clock Out',
                WorkHour::TYPE_BREAK_START => 'Break Start',
                WorkHour::TYPE_BREAK_END => 'Break End',
                default => $expectedAction,
            };

            Notification::make()
                ->title('Invalid Entry Sequence')
                ->body("Last entry was: {$lastEntryType}. Expected next action: {$expectedActionLabel}")
                ->danger()
                ->send();

            $this->halt();
        }

        // Check for duplicate entries within the same minute
        $existingEntry = WorkHour::where('employee_id', $data['employee_id'])
            ->where('timestamp', $timestamp)
            ->where('type', $data['type'])
            ->first();

        if ($existingEntry) {
            Notification::make()
                ->title('Duplicate Entry')
                ->body('An entry with the same timestamp and type already exists for this employee.')
                ->danger()
                ->send();

            $this->halt();
        }
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Work hour entry created successfully';
    }
}
