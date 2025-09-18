<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Article;

use Modules\Predict\Models\Predict;
use Webmozart\Assert\Assert;

class GetPercsOptionsById
{
    public function execute(array $article_array): array
    {
        $result = [];
        Assert::notNull($article = Predict::find($article_array['id']), '['.__LINE__.']['.__FILE__.']');
        Assert::isInstanceOf($article, Predict::class, '['.__LINE__.']['.__FILE__.']');
        $total_volume = $article->getVolumeCredit();
        if (0 == $total_volume) {
            return [];
        }

        foreach ($article_array['ratings'] as $rating) {
            $result[$rating['id']] = 0;
            if (0 != $total_volume) {
                $perc = $article->getVolumeCredit((int) $rating['id']) / $total_volume;
                if (0 != $perc) {
                    // $result[$rating['id']] = round(1 / $perc, 2);
                    $result[$rating['id']] = 1 / $perc;
                }
            }
        }

        return $result;

        // dddx($result);

        // dddx([
        //     $article,
        //     $article->getVolumeCredit(),
        //     $article->getVolumeCredit(171),
        //     $article->getVolumeCredit(170),
        // ]);
    }
}
