<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Rating;

use Modules\Predict\Actions\Article\GetPercsOptionsById;
use Modules\Predict\Datas\RatingInfoData;
use Modules\Rating\Models\RatingMorph;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GetUserRatings
{
    use QueueableAction;

    public function execute(string $user_id, array $article_data): array
    {
        $result = [];

        $user_ratings = RatingMorph::where('user_id', $user_id)
            ->where('model_id', $article_data['id'])
            ->get()->toArray();

        Assert::isArray($article_data['ratings'], '['.__LINE__.']['.__FILE__.']');
        $ratings_options = collect($article_data['ratings']);

        $percs = $this->getPercs($article_data);

        foreach ($user_ratings as $rating) {
            Assert::isArray($rating, '['.__LINE__.']['.__FILE__.']');
            $tmp = $ratings_options->where('id', $rating['rating_id'])->first();
            if (null !== $tmp) {
                $result[] = RatingInfoData::from([
                    'ratingId' => $rating['rating_id'],
                    'title' => $tmp['title'],
                    'credit' => $rating['value'],
                    'image' => $tmp['image'],
                    'predict_victory' => $rating['value'] * $percs[$rating['rating_id']],
                ])->toArray();
            } else {
                $result[] = RatingInfoData::from([
                    'ratingId' => $rating['rating_id'],
                    'title' => 'not defined',
                    'credit' => $rating['value'],
                    'image' => '#',
                    'predict_victory' => 0,
                ])->toArray();
            }
        }
        $key_values = array_column($result, 'credit');
        array_multisort($key_values, SORT_DESC, $result);

        return $result;
    }

    public function getPercs(array $article_data): array
    {
        return app(GetPercsOptionsById::class)->execute($article_data);
    }

    // // utilizzando Order
    // public function getUserRatings_test(): array
    // {
    //     $result = [];

    //     $user_ratings = Order::where('created_by', $this->user['id'])
    //         ->where('model_id', $this->article_data['id'])
    //         ->get()->toArray();

    //     Assert::isArray($this->article_data['ratings']);
    //     $ratings_options = collect($this->article_data['ratings']);

    //     $percs = $this->getPercs();

    //     foreach ($user_ratings as $rating) {
    //         Assert::isArray($rating, '['.__LINE__.']['.__FILE__.']');
    //         $tmp = $ratings_options->where('id', $rating['rating_id'])->first();
    //         if (null !== $tmp) {
    //             $result[] = RatingInfoData::from([
    //                 'ratingId' => $rating['rating_id'],
    //                 'title' => $tmp['title'],
    //                 'credit' => $rating['credits'],
    //                 'image' => $tmp['image'],
    //                 'predict_victory' => $rating['credits'] * $percs[$rating['rating_id']],
    //             ])->toArray();
    //         } else {
    //             $result[] = RatingInfoData::from([
    //                 'ratingId' => $rating['rating_id'],
    //                 'title' => 'not defined',
    //                 'credit' => $rating['credits'],
    //                 'image' => '#',
    //                 'predict_victory' => 0,
    //             ])->toArray();
    //         }
    //     }
    //     $key_values = array_column($result, 'credit');
    //     array_multisort($key_values, SORT_DESC, $result);

    //     return $result;
    // }
}
