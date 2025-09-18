<?php

declare(strict_types=1);

namespace Modules\Predict\Http\Livewire\Article;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Predict\Actions\Rating\GetUserRatings;
use Modules\Xot\Actions\GetViewAction;
use Webmozart\Assert\Assert;

class RatingsDone extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public array $user_ratings;

    public array $article_data;

    public array $user;

    public function mount(array $article_data): void
    {
        $this->article_data = $article_data;

        Assert::notNull($user = Auth::user(), '['.__LINE__.']['.__FILE__.']');
        $this->user = $user->toArray();

        $this->user_ratings = $this->getUserRatings();
    }

    // utilizzando il RatingMorph
    public function getUserRatings(): array
    {
        return app(GetUserRatings::class)->execute($this->user['id'], $this->article_data);
    }

    #[On('update-user-ratings')]
    public function updateUserRatings(): void
    {
        $this->user_ratings = $this->getUserRatings();
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

    public function sell(string $rating_id): void
    {
        $this->mountAction('sell', ['rating_id' => $rating_id]);
    }

    // modal di filament
    public function sellAction(): Action
    {
        return Action::make('sell')
            ->action(function () {
                dddx('a');
            })
            // ->modalContent(function (array $arguments): View {
            //     $view = 'predict::livewire.article.ratings-done.sell';

            //     return view($view);
            // })
            ->modalHeading('Delete post')
            ->modalDescription('Are you sure you\'d like to delete this post? This cannot be undone.')
            ->modalSubmitActionLabel('Yes, delete it')
            ->modalWidth(MaxWidth::Small)
            ->stickyModalHeader()
            ->stickyModalFooter()
        ;
    }
}
