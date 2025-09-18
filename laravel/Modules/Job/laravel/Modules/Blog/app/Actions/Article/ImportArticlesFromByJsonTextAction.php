<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Illuminate\Support\Collection;
use Modules\Blog\DataObjects\ArticleData;
use Modules\Blog\Models\Article;
use Modules\Rating\Models\Rating;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class ImportArticlesFromByJsonTextAction
{
    use QueueableAction;

    /**
     * Execute the action.
     *
     * @throws \JsonException
     */
    public function execute(string $json_text): Collection
    {
        /** @var array<string,mixed> $data */
        $data = \Safe\json_decode($json_text, true, 512, JSON_THROW_ON_ERROR);
        Assert::isArray($data);

        /** @var Collection<int,Article> */
        $articles = new Collection();

        foreach ($data as $item) {
            Assert::isArray($item);
            $articleData = ArticleData::fromArray($item);
            
            $article = Article::query()
                ->where('slug', $articleData->slug)
                ->first();

            if (null === $article) {
                $article = new Article();
            }

            $this->updateArticle($article, $articleData);
            $articles->push($article);
        }

        return $articles;
    }

    /**
     * Update article with data.
     */
    protected function updateArticle(Article $article, ArticleData $data): void
    {
        $article->title = $data->title;
        $article->slug = $data->slug;
        $article->status = $data->status->value;
        $article->status_display = (int)$data->status_display;
        $article->bet_end_date = $data->bet_end_date?->format('Y-m-d H:i:s');
        $article->event_start_date = $data->event_start_date?->format('Y-m-d H:i:s');
        $article->event_end_date = $data->event_end_date?->format('Y-m-d H:i:s');
        $article->is_wagerable = (int)$data->is_wagerable;
        $article->brier_score = (string)$data->brier_score;
        $article->brier_score_play_money = (string)$data->brier_score_play_money;
        $article->brier_score_real_money = (string)$data->brier_score_real_money;
        $article->wagers_count = $data->wagers_count;
        $article->wagers_count_canonical = $data->wagers_count_canonical;
        $article->wagers_count_total = $data->wagers_count_total;
        $article->wagers = null;
        $article->volume_play_money = $data->volume_play_money;
        $article->volume_real_money = $data->volume_real_money;

        $article->save();

        if ($data->thumbnail_2x !== null) {
            $article->addMediaFromUrl($data->thumbnail_2x)
                ->toMediaCollection('images');
        }

        foreach ($data->outcomes as $outcome) {
            Assert::isArray($outcome);
            $rating = new Rating();
            $rating->title = (string)($outcome['title'] ?? '');
            $rating->is_disabled = (bool)($outcome['disabled'] ?? false);
            $rating->save();
        }
    }
}
