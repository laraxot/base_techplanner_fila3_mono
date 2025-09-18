<?php

declare(strict_types=1);

namespace Modules\Predict\Projectors;

use Carbon\Carbon;
use Modules\Predict\Events\Profile\CreditsAdded;
use Modules\Predict\Events\Profile\CreditsRemoved;
use Modules\Predict\Events\RatingArticle;
use Modules\Predict\Models\Profile;
use Modules\Predict\Models\Transaction;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ProfileProjector extends Projector
{
    public function onRatingArticle(RatingArticle $event): void
    {
        // forse meglio all'inizio di tutto, come primo controllo?
        $profile = Profile::firstOrCreate(['user_id' => $event->userId], ['credits' => 1000]);

        // if ($profile->credits - $event->credit < 0) {
        //     throw new \Exception('there are not enough credits Your credits ['.$profile->credits.']');
        // }
        $profile->decrement('credits', $event->credit);
    }

    public function onCreditsAdded(CreditsAdded $event): void
    {
        Transaction::create(
            [
                'model_type' => 'profile',
                'model_id' => $event->profileId,
                'user_id' => $event->userId,
                'date' => Carbon::now(),
                'credits' => $event->credit,
                'note' => 'admin_add_credit_to_profile',
            ]
        );

        // dddx(Transaction::where('user_id', $event->userId)->sum('credits'));
    }

    public function onCreditsRemoved(CreditsRemoved $event): void
    {
        Transaction::create(
            [
                'model_type' => 'profile',
                'model_id' => $event->profileId,
                'user_id' => $event->userId,
                'date' => Carbon::now(),
                'credits' => $event->credit * -1,
                'note' => 'admin_remove_credit_to_profile',
            ]
        );
    }
}
