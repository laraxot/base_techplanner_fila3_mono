<?php

declare(strict_types=1);

namespace Modules\Predict\Http\Livewire\Widgets;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\Widget;
use Livewire\Attributes\Computed;
use Modules\Predict\Actions\Stocks\GetCurrentRatingsPrice2;
use Modules\Predict\Models\Predict;

class RatingsWithImageWidget extends Widget implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string $view = 'predict::filament.widgets.ratings-with-image-widget';
    protected string $modalIdPrefix = 'modal-rating-';
    protected float $minBetAmount = 0.0;

    public Predict $article;
    public ?float $profile_credits = null;
    public array $ratings = [];
    public string $rating_title = '';
    public array $ratings_percentage = [];
    public array $rating_opts = [];
    public string $ratingchoice = '';
    public string $betAmount = '0.00';

    public array $outstanding = [];
    public array $current_prices = [];

    public function mount(Predict $article, array $ratings = [], ?float $profile_credits = null): void
    {
        $this->article = $article;
        $this->ratings = $ratings;
        $this->profile_credits = $profile_credits;

        // Calcola tutto in una volta
        $ratingIds = array_column($ratings, 'id');

        $this->ratings_percentage = $this->article->getRatingsPercentageByVolume();
        $this->rating_opts = collect($ratings)->pluck('title', 'id')->toArray();
        $this->outstanding = $this->article->getOutstanding($ratingIds);
        $this->current_prices = app(GetCurrentRatingsPrice2::class)->execute(
            $ratingIds,
            $this->outstanding,
            $this->article->stocks_value
        );
    }

    public function getCurrentRatingPrice(): ?float
    {
        return $this->current_prices[$this->ratingchoice] ?? null;
    }

    public function getSelectedRatingTitle(): ?string
    {
        return $this->rating_opts[$this->ratingchoice] ?? null;
    }

    protected function getActions(): array
    {
        return [
            $this->betAction(),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'ratings' => $this->ratings,
        ];
    }

    public function openBetModal(string $ratingId): void
    {
        $this->resetModalState();

        // Usa rating_opts invece di fare una nuova ricerca nell'array
        if (isset($this->rating_opts[$ratingId])) {
            $this->ratingchoice = $ratingId;
            $this->rating_title = $this->rating_opts[$ratingId];
            $this->dispatch('open-modal', id: "{$this->modalIdPrefix}{$ratingId}");
        }
    }

    public function resetModalState(): void
    {
        $this->resetValidation();
        $this->reset(['betAmount', 'ratingchoice', 'rating_title']);
    }

    public function updating(string $name, $value): void
    {
        if ('betAmount' === $name) {
            // Converti il valore in stringa e rimuovi caratteri non validi
            $value = (string) $value;
            $value = preg_replace('/[^0-9,.]/', '', $value);

            // Sostituisci la virgola con il punto
            $value = str_replace(',', '.', $value);

            // Se il valore non è numerico o è vuoto, imposta a 0
            if (! is_numeric($value) || empty($value)) {
                $this->betAmount = '0.00';

                return;
            }

            // Formatta il numero con due decimali
            $this->betAmount = number_format((float) $value, 2, '.', '');
            $this->skipRender();
        }

        if ('ratingchoice' === $name) {
            $this->skipRender();
        }
    }

    #[Computed]
    public function currentPrice()
    {
        return $this->current_prices[$this->ratingchoice] ?? null;
    }

    #[Computed]
    public function getBetAmountFloat(): float
    {
        return (float) str_replace(',', '.', $this->betAmount);
    }

    public function placeBet(): void
    {
        try {
            $this->validate([
                'betAmount' => [
                    'required',
                    'numeric',
                    'min:0',
                    'gt:0',
                    'lte:'.$this->profile_credits,
                ],
                'ratingchoice' => 'required|string',
            ]);

            // Assicurati che il betAmount sia un float valido
            $betAmount = $this->getBetAmountFloat();
            if ($betAmount <= 0) {
                throw new \Exception('Invalid bet amount');
            }

            // Qui il resto della logica per piazzare la scommessa...
            dddx([
                $this->current_prices,
                $this->rating_opts,
                $this->ratingchoice,
                $this->rating_opts[$this->ratingchoice],
                $this->betAmount,
            ]);
        } catch (\Exception $e) {
            $this->addError('betAmount', $e->getMessage());
        }
    }

    protected function messages(): array
    {
        return [
            'betAmount.required' => 'The amount is required.',
            'betAmount.numeric' => 'The amount must be a valid number.',
            'betAmount.min' => 'The amount must be greater than zero.',
            'betAmount.gt' => 'The amount must be greater than zero.',
            'betAmount.lte' => 'The amount cannot exceed your available credits.',
            'ratingchoice.required' => 'Please select a valid rating.',
        ];
    }
}
