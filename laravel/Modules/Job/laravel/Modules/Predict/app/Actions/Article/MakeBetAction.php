<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Article;

use Filament\Facades\Filament;
use Modules\Predict\Aggregates\ArticleAggregate;
use Modules\Predict\Datas\RatingArticleData;

class MakeBetAction
{
    public function execute(string $article_id, int $import, int $rating_id, int $stocks_count, float $stocks_value): void
    {
        $article_aggregate = ArticleAggregate::retrieve($article_id);
        if (0 != $import && 0 != $rating_id) {
            $command = RatingArticleData::from([
                'userId' => (string) Filament::auth()->id(),
                'articleId' => $article_id,
                'ratingId' => $rating_id,
                'credit' => $import,
                'stocks_count' => $stocks_count,
                'stocks_value' => $stocks_value,
            ]);

            $article_aggregate->rating($command);
        }
    }
}
