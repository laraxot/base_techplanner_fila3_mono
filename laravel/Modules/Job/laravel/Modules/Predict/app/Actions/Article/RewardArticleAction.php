<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Article;

use Modules\Predict\Models\Predict;

class RewardArticleAction
{
    public function execute(Predict $article): void
    {
        if (now() < $article->closed_at) {
            return;
        }
        if (null !== $article->rewarded_at) {
            return;
        }

        dddx('a');
    }
}
