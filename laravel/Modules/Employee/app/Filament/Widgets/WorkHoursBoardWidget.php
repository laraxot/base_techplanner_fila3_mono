<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Widgets;

use Carbon\Carbon;
use Modules\Employee\Actions\BuildWorkHoursForRangeAction;
use Modules\Employee\Actions\BuildTimelineVisualizationAction;
use Modules\Employee\Actions\GetCurrentEmployeeDataAction;
use Modules\Employee\Actions\ExportTimeDataAction;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Weekly Time Table Widget - Replica esatta di dipendentincloud.it
 * 
 * Implementa l'interfaccia complessa mostrata nell'immagine:
 * - Tabella settimanale con dipendente e summary ore
 * - Timeline visualization con fasce orarie 06:00-20:00  
 * - Blocchi colorati per sessioni di lavoro
 * - Indicatori di stato (arancione "Problemi", verde completato, etc.)
 * - Navigazione settimana e export functionality
 */
class WorkHoursBoardWidget extends XotBaseWidget
{
    protected static string $view = 'employee::filament.widgets.work-hours-board';

    protected static ?int $sort = 0;
    
    protected static ?string $maxHeight = '800px';

    // State management per navigazione settimana
    public Carbon $weekStart;
    public Carbon $weekEnd;
    public bool $showToleranceThreshold = false;

    // Dati computati dal widget
    public array $weekData = [];
    public array $timelineData = [];
    public array $employeeInfo = [];
    public array $summaryData = [];

    public function mount(): void
    {
        // Inizializza alla settimana corrente (come dipendentincloud.it)
        $this->weekStart = Carbon::now()->startOfWeek();
        $this->weekEnd = Carbon::now()->endOfWeek();
        
        $this->loadWidgetData();
    }

    /**
     * @return array<string, mixed>
     */
    public function getFormSchema(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    public function getViewData(): array
    {
        return [
            'weekStart' => $this->weekStart,
            'weekEnd' => $this->weekEnd,
            'weekData' => $this->weekData,
            'timelineData' => $this->timelineData,
            'employeeInfo' => $this->employeeInfo,
            'summaryData' => $this->summaryData,
            'showToleranceThreshold' => $this->showToleranceThreshold,
        ];
    }

    /**
     * Carica tutti i dati del widget tramite Actions.
     */
    public function loadWidgetData(): void
    {
        /** @var int $userId */
        $userId = (int) (\Illuminate\Support\Facades\Auth::id() ?? 0);

        // 1. Dati base timbrature (WorkHour-based Action)
        $baseData = app(BuildWorkHoursForRangeAction::class)->execute($userId, $this->weekStart, $this->weekEnd);
        
        // 2. Dati timeline visualization (Action nuova)
        $this->timelineData = app(BuildTimelineVisualizationAction::class)->execute($userId, $this->weekStart, $this->weekEnd);
        
        // 3. Info dipendente corrente
        $this->employeeInfo = app(GetCurrentEmployeeDataAction::class)->execute($userId);
        
        // 4. Costruisci dati settimana per tabella
        $this->weekData = $this->buildWeekTableData($baseData, $this->timelineData);
        
        // 5. Summary data per header tabella
        $this->summaryData = $this->buildSummaryData($baseData);
    }

    /**
     * Costruisce dati per tabella settimanale.
     *
     * @param array<string, mixed> $baseData
     * @param array<string, mixed> $timelineData
     * @return array<string, mixed>
     */
    private function buildWeekTableData(array $baseData, array $timelineData): array
    {
        $days = [];
        
        $current = $this->weekStart->copy();
        while ($current->lte($this->weekEnd)) {
            $dateKey = $current->toDateString();
            $dayBlocks = $timelineData['sessionBlocks'][$dateKey] ?? [];
            $dayStatus = $timelineData['dayStatus'][$dateKey] ?? ['status' => 'no_work', 'indicator' => '', 'color' => 'gray'];
            
            // Calcola ore totali giorno
            $totalHours = collect($dayBlocks)->sum('duration');
            
            $days[$dateKey] = [
                'date' => $current->format('d'),
                'dayName' => $current->locale('it')->format('D'),
                'fullDate' => $current->locale('it')->isoFormat('dddd D MMMM'),
                'totalHours' => $totalHours,
                'status' => $dayStatus['status'],
                'indicator' => $dayStatus['indicator'],
                'color' => $dayStatus['color'],
                'isToday' => $current->isToday(),
                'isWeekend' => $current->isWeekend(),
                'sessions' => $dayBlocks,
            ];
            
            $current->addDay();
        }
        
        return $days;
    }

    /**
     * Costruisce summary data per header tabella.
     *
     * @param array<string, mixed> $baseData
     * @return array<string, mixed>
     */
    private function buildSummaryData(array $baseData): array
    {
        $summary = $baseData['summary'] ?? [];
        
        return [
            'workedHours' => $this->formatMinutesToHours($summary['workedMinutes'] ?? 0),
            'addedHours' => $this->formatMinutesToHours($summary['addedMinutes'] ?? 0),
            'reducedHours' => $this->formatMinutesToHours($summary['reducedMinutes'] ?? 0),
            'contractHours' => $this->formatMinutesToHours($summary['contractMinutes'] ?? 0),
            'hasAdded' => ($summary['addedMinutes'] ?? 0) > 0,
            'hasReduced' => ($summary['reducedMinutes'] ?? 0) > 0,
        ];
    }

    /**
     * Navigazione settimana precedente.
     */
    public function previousWeek(): void
    {
        $this->weekStart = $this->weekStart->copy()->subWeek();
        $this->weekEnd = $this->weekEnd->copy()->subWeek();
        $this->loadWidgetData();
    }

    /**
     * Navigazione settimana successiva.
     */
    public function nextWeek(): void
    {
        $this->weekStart = $this->weekStart->copy()->addWeek();
        $this->weekEnd = $this->weekEnd->copy()->addWeek();
        $this->loadWidgetData();
    }

    /**
     * Torna alla settimana corrente.
     */
    public function currentWeek(): void
    {
        $this->weekStart = Carbon::now()->startOfWeek();
        $this->weekEnd = Carbon::now()->endOfWeek();
        $this->loadWidgetData();
    }

    /**
     * Toggle soglie di tolleranza.
     */
    public function toggleToleranceThreshold(): void
    {
        $this->showToleranceThreshold = !$this->showToleranceThreshold;
        $this->loadWidgetData(); // Ricarica con/senza soglie
    }

    /**
     * Esporta dati settimana corrente.
     */
    public function exportData(): void
    {
        /** @var int $userId */
        $userId = (int) (\Illuminate\Support\Facades\Auth::id() ?? 0);
        
        app(ExportTimeDataAction::class)
            ->onQueue('exports')
            ->execute($userId, $this->weekStart, $this->weekEnd, 'xlsx');
            
        $this->notify('Export avviato. Riceverai una notifica quando completato.');
    }

    /**
     * Formatta minuti in formato ore:minuti.
     */
    public function formatMinutesToHours(int $minutes): string
    {
        if ($minutes === 0) {
            return 'Nessuna'; // Come nell'immagine per "Aggiunte" e "Ridotte"
        }
        
        $hours = intdiv($minutes, 60);
        $mins = $minutes % 60;
        
        if ($mins === 0) {
            return "{$hours}h";
        }
        
        return "{$hours}h {$mins}m";
    }

    /**
     * Calcola posizione temporale per timeline (06:00-20:00).
     */
    public function getTimePosition(string $time): float
    {
        [$hours, $minutes] = explode(':', $time);
        $totalMinutes = ((int) $hours * 60) + (int) $minutes;
        $baseMinutes = 6 * 60; // 06:00
        $maxMinutes = 20 * 60; // 20:00
        
        return (($totalMinutes - $baseMinutes) / ($maxMinutes - $baseMinutes)) * 100;
    }

    /**
     * Ottieni classe CSS per colore sessione.
     */
    public function getSessionColorClass(string $color): string
    {
        return match($color) {
            'green' => 'timeline-session-green',
            'orange' => 'timeline-session-orange', 
            'red' => 'timeline-session-red',
            default => 'bg-gray-200 dark:bg-gray-600 border-gray-400',
        };
    }
}


