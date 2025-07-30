<?php

declare(strict_types=1);

namespace Modules\FormBuilder\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Modules\FormBuilder\Models\Response;

/**
 * Widget per il grafico delle risposte dei form.
 * 
 * Mostra:
 * - Trend risposte nel tempo
 * - Confronto periodi
 * - Previsioni future
 * 
 * @see \Modules\FormBuilder\docs\filament\widgets\form-submissions-chart-widget.md Documentazione
 */
class FormSubmissionsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Risposte Form';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(function ($day) {
            $date = Carbon::now()->subDays($day);
            
            return [
                'date' => $date->format('M d'),
                'responses' => Response::whereDate('created_at', $date)->count(),
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Risposte',
                    'data' => $days->pluck('responses')->toArray(),
                    'borderColor' => '#10B981',
                    'backgroundColor' => '#10B981',
                    'fill' => false,
                ],
            ],
            'labels' => $days->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}