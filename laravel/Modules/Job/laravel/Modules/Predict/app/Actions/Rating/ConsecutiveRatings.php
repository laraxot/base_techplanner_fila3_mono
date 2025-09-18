<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Rating;

use Carbon\Carbon;
use Modules\Rating\Models\RatingMorph;
use Spatie\QueueableAction\QueueableAction;

class ConsecutiveRatings
{
    use QueueableAction;

    public function execute(string $user_id): int
    {
        return once(function () use ($user_id) {
            $ratings = RatingMorph::where('user_id', $user_id);

            $date = Carbon::now();
            $days = 0;
            $c = $ratings->whereDate('created_at', $date)->count();
            while ($c > 0) {
                $date = $date->subDay();
                $c = $ratings->whereDate('created_at', $date)->count();
                ++$days;
            }

            return $days;
        });
    }
}
