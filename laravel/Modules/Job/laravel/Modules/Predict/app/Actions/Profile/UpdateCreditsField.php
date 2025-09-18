<?php

declare(strict_types=1);

namespace Modules\Predict\Actions\Profile;

use Modules\Predict\Models\Profile;
use Modules\Predict\Models\Transaction;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class UpdateCreditsField
{
    use QueueableAction;

    public function execute(string $user_id): void
    {
        $sum_credit = Transaction::where('user_id', $user_id)->sum('credits');
        Assert::notNull($profile = Profile::where('user_id', $user_id)->first(), '['.__LINE__.']['.__FILE__.']');
        $profile->credits = (float) $sum_credit;
        $profile->update();
    }
}
