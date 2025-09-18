<?php

declare(strict_types=1);

namespace Modules\Predict\Http\Livewire\Widgets;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets\Widget;
use Livewire\Attributes\On;
use Modules\Predict\Actions\Article\GetOutstanding;
use Modules\Predict\Actions\Stocks\GetCurrentRatingsPrice2;
use Modules\Predict\Models\Transaction;

class RatingsDoneWidget extends Widget implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string $view = 'predict::filament.widgets.ratings-done-widget';

    public array $article_data;
    public array $user_ratings = [];
    public string $user_id;
    public array $current_prices;

    public function mount(array $article_data = [], string $user_id): void
    {
        $this->article_data = $article_data;
        $this->user_id = $user_id;
        $this->setUserRatings();

        $outstanding = app(GetOutstanding::class)->execute(array_column($this->article_data['ratings'], 'id'));
        // $outstanding = $this->article->getOutstanding(array_keys($this->article_data['ratings']));
        $this->current_prices = app(GetCurrentRatingsPrice2::class)->execute(
            array_column($this->article_data['ratings'], 'id'),
            $outstanding,
            $this->article_data['stocks_value']
        );
    }

    public function setUserRatings(): void
    {
        $transactions = Transaction::where('note', 'rating_article')
            ->where('user_id', $this->user_id)
            ->get();

        // $transactions = Transaction::whereIn('note', ['rating_article', 'sold'])
        // ->where('user_id', $this->user_id)
        // ->get();
        // // Raggruppa le transazioni per il valore di "note"
        // $groupedTransactions = $transactions->groupBy('note');
        // // Accesso ai gruppi separati
        // $ratingArticleTransactions = $groupedTransactions->get('rating_article', collect());
        // $soldTransactions = $groupedTransactions->get('sold', collect());

        $this->user_ratings = [];
        foreach ($this->article_data['ratings'] as $rating) {
            $trans_tmp = $transactions->where('model_id', $rating['id']);
            $rating['credit'] = $trans_tmp->sum('credits') * -1;
            $rating['predict_victory'] = $trans_tmp->sum('stocks_count');
            if ($rating['credit'] > 0) {
                $this->user_ratings[] = $rating;
            }
        }
    }

    #[On('update-user-ratings')]
    public function updateUserRatings(): void
    {
        $this->setUserRatings();
    }

    // public static function canView(): bool
    // {
    //     dddx('a');
    //     // Logica per determinare se il widget può essere visualizzato
    //     return false;
    // }

    // Passa i dati alla vista
    protected function getViewData(): array
    {
        return [
            'user_ratings' => $this->user_ratings,
        ];
    }

    public function sell(string $predict_victory): void
    {
        $this->mountAction('sell', ['predict_victory' => $predict_victory]);
    }

    // modal di filament
    public function sellAction(): Action
    {
        return Action::make('sell')
        ->action(function (array $arguments, array $data): void {
            dddx([$arguments, $data]);
        })
            ->fillForm(fn ($arguments): array => [
                'stocks' => $arguments['predict_victory'],
            ])
            ->form([
                TextInput::make('stocks')
                    ->hiddenLabel()
                    ->numeric()
                    // ->suffixIcon('heroicon-o-banknotes')
                    // ->rules('gt:0')
                    // ->rules('lte:'.$profile->credits)
                    // ->validationMessages([
                        //     'gt' => __('blog::article.rating.no_import'),
                        //     'lte' => __('blog::article.rating.import_min'),
                    // ])

                    ->reactive()
                    // ->afterStateUpdated(function (?string $state) {
                        //     $this->dispatch('update-current-stock', amount: $state);
                    // }),
                    ->afterStateUpdated(function () {
                        // $this->dispatch('update-current-stock');
                    }),
            ])
            ->modalHeading('Vendi')
            ->modalDescription('Quante Azioni vuoi vendere?')
            ->modalSubmitActionLabel('Vendi')
            ->modalWidth(MaxWidth::Small)
            // ->stickyModalHeader()
            // ->stickyModalFooter()
        ;
    }
}
