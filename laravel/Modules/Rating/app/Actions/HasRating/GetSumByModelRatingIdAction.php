<?php

declare(strict_types=1);

namespace Modules\Rating\Actions\HasRating;

use Modules\Rating\Models\Contracts\HasRatingContract;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GetSumByModelRatingIdAction
{
    use QueueableAction;

    /**
     * Undocumented function.
     */
    public function execute(HasRatingContract $model, ?string $rating_id = null): float
    {
        $opts = $model->ratings()
            ->wherePivot('user_id', '!=', null);
        if ($rating_id !== null) {
            $opts = $opts->wherePivot('rating_id', $rating_id);
        }
        $opts = (float) $opts->sum('rating_morph.value');
        Assert::float($opts, '['.__LINE__.']['.__FILE__.']');

        return $opts;
    }
}
