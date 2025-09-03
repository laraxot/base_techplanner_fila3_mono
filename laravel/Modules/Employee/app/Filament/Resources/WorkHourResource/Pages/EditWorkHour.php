<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Resources\WorkHourResource\Pages;

use Carbon\Carbon;
use Filament\Actions;
use Filament\Notifications\Notification;
use Modules\Employee\Filament\Resources\WorkHourResource;
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditWorkHour extends XotBaseEditRecord
{
    protected static string $resource = WorkHourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        /** @var string */
        return $this->getResource()::getUrl('index');
    }

    protected function beforeSave(): void
    {
        $data = $this->form->getState();
        $currentRecord = $this->record;

        // Ensure we have a WorkHour record
        if (!($currentRecord instanceof WorkHour)) {
            throw new \InvalidArgumentException('Expected WorkHour record');
        }

        // Validate and cast form data
        $timestampValue = $data['timestamp'] ?? null;
        if (!is_string($timestampValue) && !($timestampValue instanceof \DateTimeInterface)) {
            throw new \InvalidArgumentException('Invalid timestamp format');
        }
        
        $employeeIdValue = $data['employee_id'] ?? null;
        if (!is_numeric($employeeIdValue)) {
            throw new \InvalidArgumentException('Invalid employee ID');
        }
        $employeeId = (int) $employeeIdValue;

        $newTimestamp = Carbon::parse($timestampValue);

        // Skip validation if no changes to critical fields
        if (
            $currentRecord->employee_id === $employeeId &&
            $currentRecord->type === $data['type'] &&
            $currentRecord->timestamp->eq($newTimestamp)
        ) {
            return;
        }

        // Check for duplicate entries within the same minute (excluding current record)
        /** @var WorkHour|null $existingEntry */
        $existingEntry = WorkHour::query()
            ->where('employee_id', $employeeId)
            ->where('timestamp', $newTimestamp)
            ->where('type', $data['type'])
            ->where('id', '!=', $currentRecord->id)
            ->first();

        if ($existingEntry) {
            Notification::make()
                ->title('Duplicate Entry')
                ->body('An entry with the same timestamp and type already exists for this employee.')
                ->danger()
                ->send();

            $this->halt();
        }

        // Validate working hours (6 AM to 10 PM)
        if ($newTimestamp->hour < 6 || $newTimestamp->hour > 22) {
            Notification::make()
                ->title('Invalid Time')
                ->body('Work hours must be between 6:00 AM and 10:00 PM.')
                ->warning()
                ->send();

            $this->halt();
        }
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Work hour entry updated successfully';
    }
}
