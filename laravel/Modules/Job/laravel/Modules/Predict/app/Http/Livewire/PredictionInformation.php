<?php

declare(strict_types=1);

namespace Modules\Predict\Http\Livewire;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\Isolate;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Modules\Predict\Actions\Stocks\GetPurchasableSingleStocks;
use Modules\Xot\Actions\GetViewAction;

// #[Lazy]
// #[Isolate]
class PredictionInformation extends Component
{
    public string $tpl = 'v1';
    public array $current_prices = [];
    public float $price = 0;
    #[Reactive]
    public string $rating_id;
    public float $stock = 0;
    public array $outstanding;
    #[Reactive]
    public float $amount = 0;
    public float $stocks_value;

    public function mount(
        // string $predict_uuid,
        string $rating_id,
        array $outstanding,
        array $current_prices,
        float $stocks_value,
    ): void {
        $this->rating_id = $rating_id;
        $this->outstanding = $outstanding;
        $this->stocks_value = $stocks_value;

        $this->current_prices = $current_prices;
        if (0 != $rating_id) {
            $this->price = round($this->current_prices[$rating_id], 2);
        }
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        // dddx($view);
        $view_params = [
            // 'credits' => $credits,
        ];

        return view($view, $view_params);
    }

    #[On('update-current-prices')]
    public function getCurrentPrices(): void
    {
        $this->getCurrentstock($this->amount);
        $this->price = round($this->current_prices[$this->rating_id], 2);
    }

    #[On('update-current-stock')]
    public function getCurrentstock(): void
    {
        if (0 != $this->rating_id) {
            $this->stock = app(GetPurchasableSingleStocks::class)->execute($this->outstanding, $this->rating_id, $this->amount, $this->stocks_value);
        }
    }

    #[On('update-current-amount')]
    public function updateCurrentAmount(float $amount): void
    {
        $this->amont = $amount;
        $this->getCurrentstock($this->amount);
    }

    #[On('reset-price-stock')]
    public function resetPriceStock(): void
    {
        $this->stock = 0;
        $this->price = 0;
        $this->amont = 0;
    }
}
