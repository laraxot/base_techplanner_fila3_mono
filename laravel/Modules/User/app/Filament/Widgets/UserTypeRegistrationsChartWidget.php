<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets;

use Modules\Xot\Filament\Widgets\XotBaseChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
use Modules\SaluteOra\Models\Patient;

class UserTypeRegistrationsChartWidget extends XotBaseChartWidget
{
    protected static ?string $heading = null;
    protected static ?int $sort = 1;
    protected static bool $isLazy = true;
    

    public string $model;

    public function getHeading(): ?string
    {
        return static::transClass($this->model, 'widgets.user_type_registrations_chart.heading');
        
    }

    protected function getData(): array
    {
        // Debug: Verifica se i filtri sono disponibili
        $filters = $this->getFilters();
        
        // Accesso sicuro ai filtri della pagina con fallback appropriati
        $startDate = null;
        $endDate = null;
        
        // Verifica se i filtri sono disponibili e validi
        if (is_array($filters) && !empty($filters)) {
            /** @phpstan-ignore-next-line */
            $startDate = !empty($filters['startDate']) ? Carbon::parse($filters['startDate']) : null;
            /** @phpstan-ignore-next-line */
            $endDate = !empty($filters['endDate']) ? Carbon::parse($filters['endDate']) : null;
        }
        
        // Fallback ai valori di default se i filtri non sono disponibili
        if ($startDate === null) {
            $startDate = now()->subDays(30);
        }
        if ($endDate === null) {
            $endDate = now();
        }

        try {
            $data = Trend::model($this->model)
                ->between(
                    start: $startDate,
                    end: $endDate,
                )
                ->perDay()
                ->count();

            return [
                'datasets' => [
                    [
                        'label' => static::transClass($this->model, 'widgets.user_type_registrations_chart.label'),
                        'data' => $data->map(function (mixed $value): int {
                            /** @phpstan-ignore-next-line */
                            return $value instanceof TrendValue ? $value->aggregate : 0;
                        }),
                        'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                        'borderColor' => 'rgb(59, 130, 246)',
                        'borderWidth' => 2,
                        'tension' => 0.4,
                    ],
                ],
                'labels' => $data->map(function (mixed $value): string {
                    return $value instanceof TrendValue ? \Carbon\Carbon::parse($value->date)->format('d/m') : '';
                }),
            ];
        } catch (\Exception $e) {
            // Fallback appropriato senza logging inutile
            return [
                'datasets' => [
                    [
                        'label' => static::transClass($this->model, 'widgets.user_type_registrations_chart.label'),
                        'data' => [],
                        'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                        'borderColor' => 'rgb(59, 130, 246)',
                        'borderWidth' => 2,
                        'tension' => 0.4,
                    ],
                ],
                'labels' => [],
            ];
        }
    }

    protected function getType(): string
    {
        return 'line';
    }
} 