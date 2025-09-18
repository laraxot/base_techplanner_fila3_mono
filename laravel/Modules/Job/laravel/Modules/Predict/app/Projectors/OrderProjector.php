<?php

declare(strict_types=1);

namespace Modules\Predict\Projectors;

use Carbon\Carbon;
use Modules\Predict\Events\RatingArticle;
use Modules\Predict\Models\Order;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class OrderProjector extends Projector
{
    public function onRatingArticle(RatingArticle $event): void
    {
        // Article::class,
        $model_type = 'article';
        Order::firstOrCreate(
            [
                'rating_id' => $event->ratingId,
                'model_type' => $model_type,
                'model_id' => $event->articleId,
                'date' => Carbon::today(),
            ],
            [
                'credits' => 0,
            ]
        )->increment('credits', $event->credit);
    }
}
