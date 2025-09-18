<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Article;

use Modules\Rating\Models\RatingMorph;

class GetOutstanding
{
    public function execute(array $rating_opts): array
    {
        $ratings_morph = RatingMorph::where('model_type', 'article')->get();
        $result = [];
        foreach ($rating_opts as $index) {
            // $result[$index] = 0.0;
            // $tmp = RatingMorph::where('model_type', 'article')
            $tmp = $ratings_morph
                    ->where('rating_id', $index)
                    ->sum('value');
            $result[$index] = $tmp;
        }

        return $result;
    }
}
