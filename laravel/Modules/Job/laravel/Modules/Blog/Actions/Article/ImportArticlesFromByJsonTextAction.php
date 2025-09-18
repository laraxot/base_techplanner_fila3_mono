<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;

use function Safe\json_decode;

use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class ImportArticlesFromByJsonTextAction
{
    use QueueableAction;

    public function execute(string $json_text): void
    {
        Assert::isArray($json = json_decode($json_text, true), '['.__LINE__.']['.__FILE__.']');

        foreach ($json as $j) {
            $bet_end_date = $j['bet_end_date'] ?? '';
            if (\is_string($bet_end_date) && mb_strlen($bet_end_date) > 3) {
                $bet_end_date = Carbon::parse($bet_end_date);
            }
            $event_start_date = $j['event_start_date'] ?? '';
            if (\is_string($event_start_date) && mb_strlen($event_start_date) > 3) {
                $event_start_date = Carbon::parse($event_start_date);
            }
            $event_end_date = $j['event_end_date'] ?? '';
            if (\is_string($event_end_date) && mb_strlen($event_end_date) > 3) {
                $event_end_date = Carbon::parse($event_end_date);
            }

            $parent_category_id = null;
            foreach ($j['category'] as $cat) {
                // dddx($category);
                $cd = $cat ?? [];
                $category_data = [
                    'title' => $cd['title'] ?? '',
                    'slug' => $cd['slug'] ?? '',
                    'parent_id' => $parent_category_id,
                ];
                $category_where = ['slug' => $category_data['slug']];
                $category = Category::firstOrCreate($category_where, $category_data);
                $parent_category_id = $category->id;
                // dddx($parent_category_id);
            }

            $article_where = [
                'slug' => $j['slug'],
            ];

            $article_data = [
                'uuid' => Str::uuid(),
                'title' => $j['title'],
                'slug' => $j['slug'],
                'status' => $j['status'],
                'status_display' => 'open' === $j['status_display'],
                'bet_end_date' => $bet_end_date,
                'event_start_date' => $event_start_date,
                'event_end_date' => $event_end_date,
                'is_wagerable' => $j['is_wagerable'],
                'brier_score' => $j['brier_score'],
                'brier_score_play_money' => $j['brier_score_play_money'],
                'brier_score_real_money' => $j['brier_score_real_money'],
                'wagers_count' => $j['wagers_count'],
                'wagers_count_canonical' => $j['wagers_count_canonical'],
                'wagers_count_total' => $j['wagers_count_total'],
                'wagers' => $j['wagers'],
                'volume_play_money' => $j['volume_play_money'],
                'volume_real_money' => $j['volume_real_money'],
                'is_following' => $j['volume_real_money'],
                'category_id' => $parent_category_id,
                'published_at' => Carbon::today()->toDateString(),
            ];

            // dddx($article_data);

            $article = Article::firstOrCreate($article_where, $article_data);

            foreach ($j['outcomes'] as $rating) {
                $rating_where = [
                    'title' => $rating['title'],
                ];
                $rating_data = [
                    'title' => $rating['title'],
                    'is_disabled' => $rating['disabled'],
                ];

                $article->ratings()->firstOrCreate($rating_where, $rating_data)
                    ->addMediaFromUrl($rating['thumbnail_2x'])
                    ->toMediaCollection('rating');
            }

            // dddx($j['outcomes']);
        }
    }
}
