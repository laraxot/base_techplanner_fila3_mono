<?php

declare(strict_types=1);

namespace Modules\Predict\Http\Livewire\Article\Chart;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Modules\Predict\Datas\RatingInfoData;
use Modules\Predict\Models\Predict;
use Webmozart\Assert\Assert;

class Line extends ChartWidget
{
    public Predict $model;
    public array $data = [];
    public ?string $filter = '-7';

    // Usa la traduzione per il titolo
    // protected static ?string $heading = __('predict::chart.title.daily_forecasts');

    public function getHeading(): string
    {
        return __('predict::chart.title.daily_forecasts');
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $orders = $this->model->orders;
        $ratings = $this->model->getOptionRatingsIdTitle();
        $ratingsColor = $this->model->getOptionRatingsIdColor();

        $data = [];
        for ($i = (int) $activeFilter; $i <= 0; ++$i) {
            $date = Carbon::now()->addDays($i);
            $key = $date->format('Y-m-d');
            $tmp = [
                'date' => $date,
                'key' => $key,
                'label' => $date->format('d/m/Y'),
            ];

            $tmp1 = [];
            foreach ($ratings as $ratingId => $ratingTitle) {
                $tmp1[] = RatingInfoData::from([
                    'ratingId' => $ratingId,
                    'title' => $ratingTitle,
                    'credit' => $orders
                        ->where('date', $key)
                        ->where('rating_id', $ratingId)
                        ->first()->credits ?? 0,
                ]);
            }

            $tmp['ratings'] = $tmp1;
            $data[] = $tmp;
        }

        $dataChart = [];

        $dataChart['labels'] = collect($data)->pluck('label')->toArray();
        $dataChart['datasets'] = [];
        foreach ($ratings as $ratingId => $ratingTitle) {
            $dataChart['datasets'][] = [
                'label' => $ratingTitle,
                'data' => collect($data)->map(function (array $item) use ($ratingId) {
                    Assert::notNull($ratingInfo = collect($item['ratings'])->firstWhere('ratingId', $ratingId));

                    return $ratingInfo->credit;
                })->toArray(),
                'backgroundColor' => $ratingsColor[$ratingId],
                'borderColor' => $ratingsColor[$ratingId],
            ];
        }

        return $dataChart;
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            '-1' => __('predict::chart.filters.last_day'),
            '-7' => __('predict::chart.filters.last_week'),
            '-30' => __('predict::chart.filters.last_month'),
            '-90' => __('predict::chart.filters.last_3_months'),
            '-180' => __('predict::chart.filters.last_6_months'),
        ];
    }
}
