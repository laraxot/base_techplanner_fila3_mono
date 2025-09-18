<?php

declare(strict_types=1);

namespace Modules\Predict\Http\Livewire\Article;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Modules\Blog\Models\Profile;
use Modules\Predict\Actions\Article\MakeBetAction;
use Modules\Predict\Actions\Stocks\GetCurrentRatingsPrice2;
use Modules\Predict\Actions\Stocks\GetPurchasableSingleStocks;
use Modules\Predict\Http\Livewire\PredictionInformation;
use Modules\Predict\Models\Predict;
use Modules\Rating\Models\RatingMorph;
use Modules\Xot\Actions\GetViewAction;
use Webmozart\Assert\Assert;

class RatingsWithImage extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?Predict $article = null;

    // public string $tpl = 'v1';
    // public string $user_id;
    public array $datas;

    // public Profile $profile;
    public int $rating_id = 0;

    public string $rating_title = '';

    public string $type = 'show';

    public int $credit = 0;

    public array $article_ratings = [];

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public int $import = 0;

    public ?string $article_uuid = null;

    public array $rating_opts = [];

    public array $ratings_percentage = [];

    public array $outstanding;
    public array $current_prices;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';;

    public function mount(string $type, string $article_uuid, array $ratings = []): void
    {
        // $this->tpl = $tpl;
        $this->type = $type;
        // $this->article = $article;
        // if ('show' === $type) {
        //     $this->datas = $this->article->getArrayRatingsWithImage();
        // // $this->article_ratings = $article->getOptionRatingsIdTitle();
        // } else {
        Assert::notNull($ratings, '['.__LINE__.']['.__FILE__.']');
        $this->datas = $ratings;
        // $this->article_uuid = $article_uuid;
        $this->article = Predict::where('uuid', $article_uuid)->first();
        // }

        $this->rating_opts = collect($this->datas)->pluck('title', 'id')->toArray();
        Assert::notNull($this->article, '['.__LINE__.']['.__FILE__.']');
        // $this->ratings_percentage = $this->article->getRatingsPercentageByUser();
        $this->ratings_percentage = $this->article->getRatingsPercentageByVolume();

        // se sono sloggato non mi servono queste proprietà
        if (\Auth::check()) {
            $this->outstanding = $this->article->getOutstanding(array_keys($this->rating_opts));
            // $this->current_prices = $this->article->getCurrentPriceRatings();
            $this->current_prices = app(GetCurrentRatingsPrice2::class)->execute(array_keys($this->rating_opts), $this->outstanding, $this->article->stocks_value);
        }
    }

    public function render(): View
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute();

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function bet(int $rating_id, string $rating_title): void
    {
        $this->rating_id = $rating_id;
        $this->rating_title = $rating_title;
        // dovrebbe aggiornare le percentuali, ma non mi sembra lo facia
        // $this->ratings_percentage = $this->article->getRatingsPercentageByUser();
        if ('index' === $this->type) {
            $this->mountAction('bet', ['rating_id' => $rating_id]);
        }

        $this->dispatch('bet-created',
            rating_id: $rating_id,
            rating_title: $rating_title
        );
        // $this->dispatch('bet-prediction',
        //     rating_id: $rating_id,
        // );
    }

    // modal di filament
    public function betAction(): Action
    {
        if (Auth::guest()) {
            return $this->guestModal();
        }

        Assert::notNull($article = $this->article, '['.__LINE__.']['.__FILE__.']');
        if ('expired' === $article->getTimeLeftForHumans()) {
            return $this->checkExpired();
        }

        return $this->checkModal();
    }

    public function guestModal(): Action
    {
        return Action::make('bet')
            ->modalContent(function (array $arguments): View {
                $view = 'predict::livewire.article.ratings.for-image.v1.guest';

                return view($view);
            })
            ->modalHeading(__('predict::bet.place-bet'))
            ->closeModalByClickingAway(false)
            ->modalCloseButton(false)
            ->modalWidth(MaxWidth::Small)
            ->modalCancelActionLabel('Cancel')
            ->color('primary')
            // ->modalIcon('heroicon-o-banknotes')
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalSubmitAction(false);
    }

    public function checkExpired(): Action
    {
        return Action::make('bet')
            ->modalContent(function (array $arguments): View {
                $view = 'predict::livewire.article.ratings.for-image.v1.check_expired';

                return view($view);
            })
            ->modalHeading('Place bet')
            ->closeModalByClickingAway(false)
            ->modalCloseButton(false)
            ->modalWidth(MaxWidth::Small)
            ->modalCancelActionLabel('Cancel')
            ->color('primary')
            // ->modalIcon('heroicon-o-banknotes')
            ->stickyModalHeader()
            ->stickyModalFooter()
            ->modalSubmitAction(false);
    }

    public function checkModal(): Action
    {
        Assert::notNull($user = Auth::user(), '['.__LINE__.']['.__FILE__.']');
        Assert::notNull($profile = $user->profile, '['.__LINE__.']['.__FILE__.']');
        Assert::isInstanceOf($profile, Profile::class, '['.__LINE__.']['.__FILE__.']');

        return Action::make('bet')
            ->action(function (array $arguments, array $data): void {
                // Assert::notNull($rating_morph = RatingMorph::where('rating_id', $data['rating_id'])->first(), '['.__LINE__.']['.__FILE__.']');
                // $article_id = $rating_morph->model_id;
                Assert::notNull($this->article, '['.__LINE__.']['.__FILE__.']');
                $article_id = $this->article->id;
                // dddx([
                //     $arguments,
                //     // $this->article->id,
                //     $article_id,
                //     // $rating_morph,
                //     $data,
                //     $this->outstanding,
                //     $this->article
                // ]);

                // visto che (per ora) non riesco a prendermi i valori di PredictionInformation, me li ricalcolo
                $stock_purchased = app(GetPurchasableSingleStocks::class)->execute(
                    $this->outstanding,
                    (string) $data['rating_id'],
                    (float) $data['credits'],
                    $this->article->stocks_value
                );

                $price_stock_purchased = round($this->current_prices[$data['rating_id']], 2);

                app(MakeBetAction::class)->execute(
                    (string) $article_id,
                    (int) $data['credits'],
                    (int) $data['rating_id'],
                    $stock_purchased,
                    $price_stock_purchased
                );

                $this->dispatch('update-user-ratings');
                $this->dispatch('refresh-credits');

                Notification::make()
                    ->title('Saved successfully')
                    ->color('success')
                    ->success()
                    ->send();
            })
            ->fillForm(fn ($record, $arguments): array => [
                'rating_id' => $arguments['rating_id'],
                'credits' => 0,
            ])
            ->form([
                Select::make('rating_id')

                    ->prefix(__('predict::article.your_bet'))
                    ->hiddenLabel()
                    ->options($this->rating_opts)
                    ->required()
                    ->reactive()
                    // ->afterStateUpdated(function (?string $state) {
                    //     $this->dispatch('update-current-prices', rating_id: $state);
                    // }),
                    ->afterStateUpdated(function () {
                        $this->dispatch('update-current-prices');
                    }),
                TextInput::make('credits')
                    ->hiddenLabel()
                    ->numeric()
                    // ->suffixIcon('heroicon-o-banknotes')
                    ->rules('gt:0')
                    ->rules('lte:'.$profile->credits)
                    ->validationMessages([
                        'gt' => __('blog::article.rating.no_import'),
                        'lte' => __('blog::article.rating.import_min'),
                    ])

                    ->reactive()
                    // ->afterStateUpdated(function (?string $state) {
                    //     $this->dispatch('update-current-stock', amount: $state);
                    // }),
                    ->afterStateUpdated(function () {
                        $this->dispatch('update-current-stock');
                    }),
                // Livewire::make(PredictionInformation::class, [
                //     'predict_uuid' => $this->article_uuid,
                //     'rating_id' => $this->rating_id,
                //     'rating_options' => $this->article->ratings()->where('user_id', null)
                //             ->get()
                //             ->pluck('id')
                //             ->toArray(),
                //     ])->lazy()

                Livewire::make(PredictionInformation::class, fn (Get $get) => [
                    'amount' => $get('credits'),
                    // 'predict_uuid' => $this->article_uuid,
                    'rating_id' => $get('rating_id'),
                    // 'rating_options' => array_keys($this->rating_opts),
                    'outstanding' => $this->outstanding,
                    'current_prices' => $this->current_prices,
                    'stocks_value' => $this->article->stocks_value,
                ]),
            ])
            ->modalHeading(__('predict::article.place-bet'))
            ->closeModalByClickingAway(false)
            ->modalCloseButton(false)
            ->modalWidth(MaxWidth::Small)
            ->modalSubmitActionLabel(__('predict::bet.select-an-outcome'))
            ->modalCancelActionLabel(__('predict::bet.cancel'))
            ->color('primary')
            // ->modalIcon('heroicon-o-banknotes')
            ->stickyModalHeader()
            ->stickyModalFooter();
    }

    // protected function onValidationError(ValidationException $exception): void
    // {
    //     Notification::make()
    //         ->title($exception->getMessage())
    //         ->danger()
    //         ->send();
    // }

    // modal con custom blade
    // public function betAction(): Action
    // {
    //     return Action::make('bet')
    //         // ->action(fn (array $arguments, array $data) => dddx([$arguments, $data]))
    //         ->action(function (array $arguments, array $data) {
    //             dddx([$arguments, $data]);
    //             $article_id = RatingMorph::where('rating_id', $arguments['rating_id'])->first()->model_id;
    //             // dddx($article_id);
    //             app(MakeBetAction::class)->execute((string) $article_id, 3, $arguments['rating_id']);
    //             // dddx([$arguments, $data]);
    //         })
    //         // ->action(fn (array $arguments) => app(MakeBetAction::class)->execute($this->article->id, $this->import, $this->rating_id))
    //         // ->fillForm(fn ($record, $arguments): array => [
    //         //     'rating_id' => $arguments['rating_id'],
    //         // ])
    //         // ->form([
    //         //     Select::make('rating_id')
    //         //         //
    //         //         ->options($this->rating_opts)
    //         //         ->required(),
    //         //     TextInput::make('credits'),
    //         // ])

    //         ->closeModalByClickingAway(false)
    //         ->modalCloseButton(false)
    //         // ->modalSubmitActionLabel('confermo')
    //         // ->modalIcon('heroicon-o-banknotes')
    //         // ->stickyModalHeader()
    //         // ->stickyModalFooter()

    //         ->modalContent(function (array $arguments): View {
    //             $view = 'blog::livewire.article.ratings.for-image.v1.check';
    //             $view_params = [
    //                 'rating_title' => $arguments['rating_id'],
    //                 'type' => 'index',
    //             ];

    //             return view($view, $view_params);
    //         })
    //         ->form([
    //                 TextInput::make('credits'),
    //             ])

    //     ;
    // }
}
