<?php

declare(strict_types=1);

namespace Modules\Predict\Datas;

use Spatie\LaravelData\Data;

class RatingArticleData extends Data
{
    public string $userId;

    public string $articleId;

    public string $ratingId;

    public int $credit;

    public int $stocks_count;

    public float $stocks_value;
}
