<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Widgets;

use Carbon\Carbon;
use Filament\Notifications\Notification;
<<<<<<< HEAD
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\Employee\Enums\WorkHourStatusEnum;
use Modules\Employee\Enums\WorkHourTypeEnum;
=======
use Illuminate\Support\Facades\Auth;
use Modules\Employee\Models\Employee;
>>>>>>> cda86dd (.)
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
<<<<<<< HEAD
 * Enhanced Time Clock Widget - Primary time tracking interface with improved UI/UX.
 *
 * Features (2025 Enhanced Version):
 * - 3-column responsive layout: [Time+Date+Stats] | [Enhanced Sessions] | [Smart Action Button]
 * - Interactive session cards with status badges
 * - Action buttons with count badges
 * - Real-time statistics and duration tracking
 * - Enhanced accessibility with proper ARIA labels
 * - Native Filament components (badges, buttons, icons)
 * - Smart Clock In/Out logic with visual feedback
 * - Complete time tracking functionality
 *
 * UI/UX Improvements:
 * - Badge-based time entries display for clear visual hierarchy
 * - Color-coded session status (success, danger, warning, info, gray)
 * - Duration calculation and display
 * - Enhanced mobile responsiveness
 * - Improved information architecture
 *
=======
 * Unified Time Clock Widget - Primary time tracking interface
 *
 * Features:
 * - 3-column responsive layout: [Time+Date] | [Daily Entries] | [Action Button]
 * - Real-time updates with polling
 * - Smart Clock In/Out logic
 * - Native Filament components
 * - Complete time tracking functionality
 *
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD
     * Occupa tutta la larghezza della riga.
     */
    protected int|string|array $columnSpan = 'full';

    /**
=======
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD
     * Today's work-hour entries.
     *
     * @var array<int, array{time: string, type: string, status: string}>
=======
     * Lista timbrature di oggi.
     *
     * @var array<int, array{time: string, type: string}>
>>>>>>> cda86dd (.)
     */
    public array $todayEntries = [];

    /**
<<<<<<< HEAD
     * Current session blocks.
     *
     * @var array<int, array{start: string, end: string|null, duration: float, status: string}>
     */
    public array $sessions = [];

    /**
     * Current session state.
=======
     * Stato sessione corrente.
>>>>>>> cda86dd (.)
     */
    public bool $isClockedIn = false;

    /**
<<<<<<< HEAD
     * Descriptive session status.
=======
     * Stato descrittivo della sessione.
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD
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
=======
        $this->todayDate = Carbon::now()->locale('it')->isoFormat('dddd D MMMM YYYY');

        // Trova employee dell'utente corrente
        $user = Auth::user();
        if (! $user) {
            return;
        }

        $employee = Employee::where('user_id', $user->id)->first();
        if (! $employee) {
            return;
        }

        // Query timbrature di oggi (logica reale)
        $entries = WorkHour::where('employee_id', $employee->id)
>>>>>>> cda86dd (.)
            ->whereDate('timestamp', today())
            ->orderBy('timestamp', 'asc')
            ->get();

<<<<<<< HEAD
        /** @var array<int, array{time: string, type: string, status: string}> $todayEntries */
        $todayEntries = $entries->map(function (WorkHour $entry): array {
            $type = $entry->type;
            $status = $entry->status;
            
            return [
                'time' => $entry->timestamp->format('H:i'),
                'type' => is_object($type) && method_exists($type, 'value') ? $type->value : (is_string($type) ? $type : ''),
                'status' => is_object($status) && method_exists($status, 'value') ? $status->value : (is_string($status) ? $status : ''),
            ];
        })->values()->all();
        $this->todayEntries = $todayEntries;
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
            $this->isClockedIn = $lastEntry['type'] === 'clock_in';
=======
        // Popola array per la vista
        $this->todayEntries = $entries->map(function (WorkHour $entry): array {
            return [
                'time' => $entry->timestamp->format('H:i'),
                'type' => $entry->type,
            ];
        })->toArray();

        // Determina stato sessione
        $lastEntry = $entries->last();
        if ($lastEntry) {
            $this->isClockedIn = $lastEntry->type === 'clock_in';
>>>>>>> cda86dd (.)
            $this->sessionStatus = $this->isClockedIn ? 'active' : 'completed';
        } else {
            $this->isClockedIn = false;
            $this->sessionStatus = 'not_started';
        }
    }

<<<<<<< HEAD

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
=======
    /**
     * Azione timbratura entrata.
     */
    public function clockIn(): void
    {
        try {
            $user = Auth::user();
            if (! $user) {
                Notification::make()
                    ->title('Errore')
                    ->body('Utente non autenticato')
                    ->danger()
                    ->send();

                return;
            }

            $employee = Employee::where('user_id', $user->id)->first();
            if (! $employee) {
                Notification::make()
                    ->title('Errore')
                    ->body('Profilo dipendente non trovato')
                    ->danger()
                    ->send();

                return;
            }

            // Verifica che non sia già in clock-in
            if ($this->isClockedIn) {
                Notification::make()
                    ->title('Attenzione')
                    ->body('Sei già in sessione')
                    ->warning()
                    ->send();

                return;
            }

            // Crea timbratura entrata
            WorkHour::create([
                'employee_id' => $employee->id,
                'type' => 'clock_in',
                'timestamp' => Carbon::now(),
                'status' => 'pending',
                'notes' => 'Entrata da dashboard widget',
            ]);

            $this->updateData();

            Notification::make()
                ->title('Successo')
                ->body('Entrata registrata alle '.Carbon::now()->format('H:i'))
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Errore')
                ->body('Errore durante la timbratura: '.$e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Azione timbratura uscita.
     */
    public function clockOut(): void
    {
        try {
            $user = Auth::user();
            if (! $user) {
                Notification::make()
                    ->title('Errore')
                    ->body('Utente non autenticato')
                    ->danger()
                    ->send();

                return;
            }

            $employee = Employee::where('user_id', $user->id)->first();
            if (! $employee) {
                Notification::make()
                    ->title('Errore')
                    ->body('Profilo dipendente non trovato')
                    ->danger()
                    ->send();

                return;
            }

            // Verifica che sia in clock-in
            if (! $this->isClockedIn) {
                Notification::make()
                    ->title('Attenzione')
                    ->body('Devi prima timbrare l\'entrata')
                    ->warning()
                    ->send();

                return;
            }

            // Crea timbratura uscita
            WorkHour::create([
                'employee_id' => $employee->id,
                'type' => 'clock_out',
                'timestamp' => Carbon::now(),
                'status' => 'pending',
                'notes' => 'Uscita da dashboard widget',
            ]);

            $this->updateData();

            Notification::make()
                ->title('Successo')
                ->body('Uscita registrata alle '.Carbon::now()->format('H:i'))
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Errore')
                ->body('Errore durante la timbratura: '.$e->getMessage())
                ->danger()
                ->send();
        }
>>>>>>> cda86dd (.)
    }
}
