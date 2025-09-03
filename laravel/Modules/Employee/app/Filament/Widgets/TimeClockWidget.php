<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Widgets;

use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Modules\Employee\Enums\WorkHourStatusEnum;
use Modules\Employee\Enums\WorkHourTypeEnum;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\WorkHour;
use Modules\Employee\Models\User;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Unified Time Clock Widget - Primary time tracking interface.
 *
 * Features:
 * - 3-column responsive layout: [Time+Date] | [Daily Entries] | [Action Button]
 * - Real-time updates with polling
 * - Smart Clock In/Out logic
 * - Native Filament components
 * - Complete time tracking functionality
 *
 * This is the ONLY time tracking widget - consolidates all time tracking features.
 */
class TimeClockWidget extends XotBaseWidget
{
    /**
     * Vista del widget.
     */
    protected static string $view = 'employee::filament.widgets.time-clock-widget';

    /**
     * Ordine di visualizzazione (primo widget).
     */
    protected static ?int $sort = 0;

    /**
     * Polling per aggiornamento real-time.
     */
    protected static ?string $pollingInterval = '1s';

    /**
     * Ora corrente per display.
     */
    public string $currentTime = '';

    /**
     * Data formattata in italiano.
     */
    public string $todayDate = '';

    /**
     * Today's work-hour entries.
     *
     * @var array<int, array{time: string, type: string, status: string}>
     */
    public array $todayEntries = [];

    /**
     * Day sessions (in/out pairs).
     *
     * @var array<int, array{status: string, in?: string|null, out?: string|null}>
     */
    public array $sessions = [];

    /**
     * Current session state.
     */
    public bool $isClockedIn = false;

    /**
     * Descriptive session status.
     */
    public string $sessionStatus = 'not_started';

    /**
     * Inizializzazione del widget.
     */
    public function mount(): void
    {
        $this->updateData();
    }

    /**
     * Schema form (vuoto per questo widget).
     *
     * @return array<string, mixed>
     */
    public function getFormSchema(): array
    {
        return [];
    }

    /**
     * Aggiorna tutti i dati del widget.
     */
    public function updateData(): void
    {
        // Aggiorna ora e data
        $this->currentTime = Carbon::now()->format('H:i');
        $carbon = Carbon::now();
        $carbon->locale('it');
        $this->todayDate = $carbon->isoFormat('dddd D MMMM YYYY');

        $userId = Auth::id();
        if ($userId === null) {
            $this->todayEntries = [];
            $this->sessions = [];

            return;
        }

        $this->loadTodayEntries((string) $userId);
        $this->updateSessionStatus();
    }

    

    /**
     * Load today's entries.
     */
    private function loadTodayEntries(string $userId): void
    {
        /** @var \Illuminate\Database\Eloquent\Collection<int, WorkHour> $entries */
        $entries = WorkHour::query()
            ->where('employee_id', $userId)
            ->whereDate('timestamp', today())
            ->orderBy('timestamp', 'asc')
            ->get();

        /** @var array<int, array{time: string, type: string, status: string}> $todayEntries */
        $todayEntries = $entries->map(function (WorkHour $entry): array {
            return [
                'time' => $entry->timestamp->format('H:i'),
                'type' => $entry->type->value,
                'status' => $entry->status->value,
            ];
        })->values()->all();
        $this->todayEntries = $todayEntries;

        $this->buildSessions($entries);
    }

    /**
     * Update current session state.
     */
    private function updateSessionStatus(): void
    {
        if (empty($this->todayEntries)) {
            $this->isClockedIn = false;
            $this->sessionStatus = 'not_started';

            return;
        }

        $lastEntry = end($this->todayEntries);
        if (is_array($lastEntry) && isset($lastEntry['type']) && is_string($lastEntry['type'])) {
            $this->isClockedIn = 'clock_in' === $lastEntry['type'];
            $this->sessionStatus = $this->isClockedIn ? 'active' : 'completed';
        } else {
            $this->isClockedIn = false;
            $this->sessionStatus = 'not_started';
        }
    }

    /**
     * Build day sessions by pairing clock in/out.
     *
     * @param Collection<int, WorkHour> $entries
     */
    private function buildSessions(Collection $entries): void
    {
        /** @var array<int, array{status: string, in?: string|null, out?: string|null}> $sessions */
        $sessions = [];

        foreach ($entries as $entry) {
            if (WorkHourTypeEnum::CLOCK_IN === $entry->type) {
                $sessions[] = [
                    'status' => 'active',
                    'in' => $entry->timestamp->format('H:i'),
                    'out' => null,
                ];

                continue;
            }

            if (WorkHourTypeEnum::CLOCK_OUT === $entry->type) {
                $lastIndex = count($sessions) - 1;
                if ($lastIndex >= 0 && ($sessions[$lastIndex]['out'] ?? null) === null) {
                    $sessions[$lastIndex]['out'] = $entry->timestamp->format('H:i');
                    $sessions[$lastIndex]['status'] = 'completed';
                } else {
                    $sessions[] = [
                        'status' => 'completed',
                        'in' => null,
                        'out' => $entry->timestamp->format('H:i'),
                    ];
                }
            }
        }

        $this->sessions = $sessions;
    }

    /**
     * Clock-in action.
     */
    public function clockIn(): void
    {
        if ($this->isClockedIn) {
            $this->notifyWarning('Sei già in sessione');

            return;
        }

        $this->createWorkHour(WorkHourTypeEnum::CLOCK_IN, 'Entrata registrata');
    }

    /**
     * Clock-out action.
     */
    public function clockOut(): void
    {
        if (! $this->isClockedIn) {
            $this->notifyWarning('Devi prima timbrare l\'entrata');

            return;
        }

        $this->createWorkHour(WorkHourTypeEnum::CLOCK_OUT, 'Uscita registrata');
    }

    /**
     * Create a work-hour entry.
     */
    private function createWorkHour(WorkHourTypeEnum $type, string $successMessage): void
    {
        $userId = Auth::id();

        WorkHour::query()->create([
            'employee_id' => $userId,
            'type' => $type,
            'timestamp' => Carbon::now(),
            'status' => WorkHourStatusEnum::PENDING,
            'notes' => $successMessage.' da dashboard widget',
        ]);

        $this->updateData();
        $this->notifySuccess($successMessage.' alle '.Carbon::now()->format('H:i'));
    }

    /**
     * Notifica di successo (DRY principle).
     */
    private function notifySuccess(string $message): void
    {
        Notification::make()->title('Successo')->body($message)->success()->send();
    }

    /**
     * Notifica di avviso (DRY principle).
     */
    private function notifyWarning(string $message): void
    {
        Notification::make()->title('Attenzione')->body($message)->warning()->send();
    }

    /**
     * Notifica di errore (DRY principle).
     */
    private function notifyError(string $message): void
    {
        Notification::make()->title('Errore')->body($message)->danger()->send();
    }
}
