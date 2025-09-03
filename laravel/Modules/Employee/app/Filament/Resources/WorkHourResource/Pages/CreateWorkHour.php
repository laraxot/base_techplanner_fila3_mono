<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Resources\WorkHourResource\Pages;

use Carbon\Carbon;
use Filament\Notifications\Notification;
use Modules\Employee\Filament\Resources\WorkHourResource;
use Modules\Employee\Models\WorkHour;
use Modules\Employee\Enums\WorkHourStatusEnum;
use Modules\Employee\Enums\WorkHourTypeEnum;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateWorkHour extends XotBaseCreateRecord
{
    protected static string $resource = WorkHourResource::class;

    protected function getRedirectUrl(): string
    {
        /** @var string */
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set default status if not provided
        if (! isset($data['status'])) {
            $data['status'] = WorkHourStatusEnum::PENDING->value;
        }

        return $data;
    }

    protected function beforeCreate(): void
    {
        $data = $this->form->getState();

        // Validate if this entry is allowed based on the last entry
        $timestampValue = $data['timestamp'] ?? null;
        if (!is_string($timestampValue) && !($timestampValue instanceof \DateTimeInterface)) {
            throw new \InvalidArgumentException('Invalid timestamp format');
        }
        
        $employeeIdValue = $data['employee_id'] ?? null;
        if (!is_numeric($employeeIdValue)) {
            throw new \InvalidArgumentException('Invalid employee ID');
        }
        $employeeId = (int) $employeeIdValue;

        $timestamp = Carbon::parse($timestampValue);
        $lastEntry = WorkHour::getLastEntryForEmployee($employeeId, $timestamp);
        $expectedAction = WorkHour::getNextAction($employeeId, $timestamp);

        if ($data['type'] !== $expectedAction->value) {
            $lastEntryType = $lastEntry ? (string) match ($lastEntry->type) {
                WorkHourTypeEnum::CLOCK_IN => 'Clock In',
                WorkHourTypeEnum::CLOCK_OUT => 'Clock Out',
                WorkHourTypeEnum::BREAK_START => 'Break Start',
                WorkHourTypeEnum::BREAK_END => 'Break End',
            } : 'None';

            $expectedActionLabel = (string) match ($expectedAction) {
                WorkHourTypeEnum::CLOCK_IN => 'Clock In',
                WorkHourTypeEnum::CLOCK_OUT => 'Clock Out',
                WorkHourTypeEnum::BREAK_START => 'Break Start',
                WorkHourTypeEnum::BREAK_END => 'Break End',
            };

            Notification::make()
                ->title('Invalid Entry Sequence')
                ->body("Last entry was: {$lastEntryType}. Expected next action: {$expectedActionLabel}")
                ->danger()
                ->send();

            $this->halt();
        }

        // Check for duplicate entries within the same minute
        /** @var WorkHour|null $existingEntry */
        $existingEntry = WorkHour::query()
            ->where('employee_id', $employeeId)
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
