<?php

declare(strict_types=1);

namespace Modules\Predict\Http\Livewire\Article\Ratings;

use Filament\Facades\Filament;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Modules\Blog\Models\Profile;
use Modules\Predict\Actions\Article\MakeBetAction;
use Modules\Predict\Actions\Stocks\GetCurrentRatingsPrice2;
use Modules\Predict\Actions\Stocks\GetPurchasableSingleStocks;
use Modules\Predict\Models\Predict;
use Modules\Xot\Actions\GetViewAction;
use Webmozart\Assert\Assert;

class ForImage extends Component implements HasForms
{
    use InteractsWithForms;

    public Predict $article;

    public string $tpl = 'v1';

    public string $rating_title = '';

    public int $rating_id = 0;

    public array $article_ratings = [];

    // #[Validate('required|gt:0')]
    public int $import = 0;

    public string $type = 'show';

    public array $outstanding;
    public array $current_prices;

    // public array $form_data = ['credit' => 6];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function mount(Predict $article, string $tpl = 'v1'): void
    {
        $this->article = $article;
        $this->tpl = $tpl;
        $this->article_ratings = $article->getOptionRatingsIdTitle();
        $this->outstanding = $article->getOutstanding(array_keys($this->article_ratings));
        // $this->current_prices = $this->article->getCurrentPriceRatings();
        $this->current_prices = app(GetCurrentRatingsPrice2::class)->execute(array_keys($this->article_ratings), $this->outstanding, $this->article->stocks_value);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /** @phpstan-var view-string */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'view' => $view,
            'ratingTitle' => $this->rating_title,
            // 'chosen_bet_title' => $this->chosen_bet['rating_title'] ?? 'aaaaaaaa'
        ];

        return view($view, $view_params);
    }

    #[On('bet-created')]
    public function updateRating(
        int $rating_id,
        string $rating_title): void
    {
        $this->rating_id = $rating_id;
        $this->rating_title = $rating_title;

        $this->dispatch('update-current-prices',
            rating_id: $rating_id,
        );
    }

    public function save(): void
    {
        Assert::notNull($user = Auth::user(), '['.__LINE__.']['.__FILE__.']');
        Assert::notNull($profile = $user->profile, '['.__LINE__.']['.__FILE__.']');
        Assert::isInstanceOf($profile, Profile::class, '['.__LINE__.']['.__FILE__.']');
        // @phpstan-ignore-next-line
        $this->validate([
            // 'import' => ['required|gt:0|lte:'.$profile->credits],
            // 'rating_title' => ['required'],
            'import' => 'required|gt:0|lte:'.$profile->credits,
            'rating_title' => 'required',
        ], [
            'import.required' => __('blog::article.rating.no_import'),
            'import.gt' => __('blog::article.rating.import_zero'),
            'import.lte' => __('blog::article.rating.import_min'),
            'rating_title.required' => __('blog::article.rating.no_choice'),
        ]);

        $stock_purchased = app(GetPurchasableSingleStocks::class)->execute(
            $this->outstanding,
            (string) $this->rating_id,
            (float) $this->import,
            $this->article->stocks_value
        );

        $price_stock_purchased = round($this->current_prices[$this->rating_id], 2);

        app(MakeBetAction::class)->execute(
            $this->article->id,
            $this->import,
            $this->rating_id,
            $stock_purchased,
            $price_stock_purchased
        );

        // $article_aggregate = ArticleAggregate::retrieve($this->article->id);
        // if (0 != $this->import && 0 != $this->rating_id) {
        //     $command = RatingArticleData::from([
        //         'userId' => (string) Filament::auth()->id(),
        //         'articleId' => $this->article->id,
        //         'ratingId' => $this->rating_id,
        //         'credit' => $this->import,
        //     ]);

        //     $article_aggregate->rating($command);
        // }

        $this->rating_id = 0;
        $this->rating_title = '';
        $this->import = 0;

        $this->dispatch('update-user-ratings');
        $this->dispatch('refresh-credits');
        $this->dispatch('reset-price-stock');

        Notification::make()
            ->title('Saved successfully')
            ->color('success')
            ->success()
            ->send();
    }

    public function change(): void
    {
        $this->dispatch('update-current-amount', amount: $this->import);
    }
}
