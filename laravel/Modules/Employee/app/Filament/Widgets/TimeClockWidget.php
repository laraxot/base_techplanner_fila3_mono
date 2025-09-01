<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Widgets;

use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Modules\Employee\Models\Employee;
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Unified Time Clock Widget - Primary time tracking interface
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
     * Lista timbrature di oggi.
     *
     * @var array<int, array{time: string, type: string}>
     */
    public array $todayEntries = [];

    /**
     * Stato sessione corrente.
     */
    public bool $isClockedIn = false;

    /**
     * Stato descrittivo della sessione.
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
            ->whereDate('timestamp', today())
            ->orderBy('timestamp', 'asc')
            ->get();

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
            $this->sessionStatus = $this->isClockedIn ? 'active' : 'completed';
        } else {
            $this->isClockedIn = false;
            $this->sessionStatus = 'not_started';
        }
    }

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
    }
}
