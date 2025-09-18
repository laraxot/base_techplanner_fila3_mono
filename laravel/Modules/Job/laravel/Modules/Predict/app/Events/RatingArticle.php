<?php

declare(strict_types=1);

/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Events/ProductPurchased.php
 */

namespace Modules\Predict\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class RatingArticle extends ShouldBeStored
{
    public function __construct(
        readonly public string $userId,
        readonly public string $articleId,
        readonly public string $ratingId,
        readonly public int $credit,
        readonly public int $stocks_count,
        readonly public float $stocks_value,
    ) {
    }
}
