<?php

declare(strict_types=1);

namespace Modules\Employee\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Modules\Employee\Models\WorkHour;
use Spatie\QueueableAction\QueueableAction;

/**
 * Export time data for employee in various formats.
 *
 * Replicates dipendentincloud.it export functionality with enhanced features.
 */
class ExportTimeDataAction
{
    use QueueableAction;

    /**
     * Execute time data export.
     */
    public function execute(int $userId, Carbon $startDate, Carbon $endDate, string $format = 'xlsx'): string
    {
        // Ottieni dati completi per il periodo
        $timeData = $this->getTimeDataForExport($userId, $startDate, $endDate);

        // Genera file in base al formato
        return match ($format) {
            'xlsx' => $this->exportToExcel($timeData, $userId, $startDate, $endDate),
            'csv' => $this->exportToCsv($timeData, $userId, $startDate, $endDate),
            'pdf' => $this->exportToPdf($timeData, $userId, $startDate, $endDate),
            default => throw new \InvalidArgumentException("Unsupported export format: {$format}"),
        };
    }

    /**
     * Ottieni dati strutturati per export.
     *
     * @return array<string, mixed>
     */
    private function getTimeDataForExport(int $userId, Carbon $startDate, Carbon $endDate): array
    {
        // Usa Action esistente per ottenere dati base
        $baseData = app(BuildWorkHoursForRangeAction::class)->execute($userId, $startDate, $endDate);

        // Aggiungi dati dettagliati per export
        $weekData = app(BuildWeeklyTimeTableAction::class)->execute($userId, $startDate, $endDate);
        $employeeData = app(GetCurrentEmployeeDataAction::class)->execute($userId);

        // Ottieni tutte le timbrature del periodo per dettagli
        $allEntries = WorkHour::query()
            ->where('employee_id', $userId)
            ->whereBetween('timestamp', [$startDate, $endDate])
            ->orderBy('timestamp', 'asc')
            ->get();

        return [
            'employee' => $employeeData,
            'period' => [
                'start' => $startDate->format('d/m/Y'),
                'end' => $endDate->format('d/m/Y'),
                'days' => $startDate->diffInDays($endDate) + 1,
            ],
            'summary' => $baseData['summary'],
            'weekData' => $weekData,
            'entries' => $allEntries->map(fn (WorkHour $entry): array => [
                    'date' => $entry->timestamp->format('d/m/Y'),
                    'time' => $entry->timestamp->format('H:i'),
                    'type' => ($entry->type instanceof \BackedEnum) ? $entry->type->value : ((string) $entry->type),
                    'status' => ($entry->status instanceof \BackedEnum)
                        ? $entry->status->value
                        : ((string) $entry->status),
                    'location' => $entry->location_name ?? '',
                    'notes' => $entry->notes ?? '',
                ])->toArray(),
            'generatedAt' => Carbon::now()->format('d/m/Y H:i'),
        ];
    }

    /**
     * Export to Excel format (replicating dipendentincloud.it).
     */
    private function exportToExcel(array $data, int $userId, Carbon $startDate, Carbon $endDate): string
    {
        $filename = "timbrature_{$userId}_{$startDate->format('Ymd')}_{$endDate->format('Ymd')}.xlsx";

        // Qui implementeresti l'export Excel usando Laravel Excel o simile
        // Per ora creo un CSV strutturato
        $csvData = $this->buildCsvData($data);

        Storage::put("exports/time_data/{$filename}", $csvData);

        return Storage::path("exports/time_data/{$filename}");
    }

    /**
     * Export to CSV format.
     */
    private function exportToCsv(array $data, int $userId, Carbon $startDate, Carbon $endDate): string
    {
        $filename = "timbrature_{$userId}_{$startDate->format('Ymd')}_{$endDate->format('Ymd')}.csv";
        $csvData = $this->buildCsvData($data);

        Storage::put("exports/time_data/{$filename}", $csvData);

        return Storage::path("exports/time_data/{$filename}");
    }

    /**
     * Export to PDF format.
     */
    private function exportToPdf(array $data, int $userId, Carbon $startDate, Carbon $endDate): string
    {
        $filename = "timbrature_{$userId}_{$startDate->format('Ymd')}_{$endDate->format('Ymd')}.pdf";

        // Qui implementeresti l'export PDF usando DomPDF o simile
        $pdfContent = $this->buildPdfContent($data);

        Storage::put("exports/time_data/{$filename}", $pdfContent);

        return Storage::path("exports/time_data/{$filename}");
    }

    /**
     * Costruisce contenuto CSV.
     */
    private function buildCsvData(array $data): string
    {
        $csv = [];

        // Header
        $csv[] = [
            'Data',
            'Ora',
            'Tipo',
            'Stato',
            'Ubicazione',
            'Note',
        ];

        // Dati entries
        foreach ($data['entries'] as $entry) {
            $csv[] = [
                $entry['date'],
                $entry['time'],
                $this->translateEntryType($entry['type']),
                $this->translateEntryStatus($entry['status']),
                $entry['location'],
                $entry['notes'],
            ];
        }

        // Summary
        $csv[] = ['', '', '', '', '', ''];
        $csv[] = ['RIEPILOGO', '', '', '', '', ''];
        $csv[] = ['Ore Lavorate', $this->formatHours($data['summary']['workedMinutes']), '', '', '', ''];
        $csv[] = ['Ore Contrattuali', $this->formatHours($data['summary']['contractMinutes']), '', '', '', ''];

        // Converti in stringa CSV
        $output = '';
        foreach ($csv as $row) {
            $output .= '"' . implode('","', $row) . '"' . "\n";
        }

        return $output;
    }

    /**
     * Costruisce contenuto PDF (placeholder).
     */
    private function buildPdfContent(array $data): string
    {
        // Placeholder per implementazione PDF futura
        return "PDF Export - Employee: {$data['employee']['name']}\nPeriod: {$data['period']['start']} - {$data['period']['end']}\n";
    }

    /**
     * Traduce tipo entry per export.
     */
    private function translateEntryType(string $type): string
    {
        return match ($type) {
            'clock_in' => 'Entrata',
            'clock_out' => 'Uscita',
            'break_start' => 'Inizio Pausa',
            'break_end' => 'Fine Pausa',
            default => ucfirst($type),
        };
    }

    /**
     * Traduce stato entry per export.
     */
    private function translateEntryStatus(string $status): string
    {
        return match ($status) {
            'pending' => 'In Attesa',
            'approved' => 'Approvata',
            'rejected' => 'Rifiutata',
            'cancelled' => 'Cancellata',
            default => ucfirst($status),
        };
    }

    /**
     * Formatta minuti in ore:minuti.
     */
    private function formatHours(int $minutes): string
    {
        $hours = intdiv($minutes, 60);
        $mins = $minutes % 60;

        return sprintf('%d:%02d', $hours, $mins);
    }
}
