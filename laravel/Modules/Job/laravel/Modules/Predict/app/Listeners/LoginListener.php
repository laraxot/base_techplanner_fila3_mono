<?php

declare(strict_types=1);

namespace Modules\Predict\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Modules\Predict\Actions\Rating\ConsecutiveRatings;
use Modules\Predict\Models\Profile;
use Modules\Predict\Models\Transaction;
use Modules\Xot\Datas\XotData;
use Webmozart\Assert\Assert;

class LoginListener
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user_class = XotData::make()->getUserClass();
        Assert::notNull($user = $event->user, '['.__LINE__.']['.__FILE__.']');
        Assert::isInstanceOf($user, $user_class, '['.__LINE__.']['.__FILE__.']');

        $welcome_login = Transaction::where('user_id', $user->id)
            ->where('note', 'welcome')
            ->first();

        if (null === $welcome_login) {
            $user->profile()->firstOrcreate([
                'email' => $user->email,
                'credits' => 1000,
            ]);

            Transaction::create([
                'model_type' => 'profile',
                'model_id' => $user->profile?->id,
                'user_id' => $user->id,
                'date' => Carbon::now(),
                'credits' => 1000,
                'note' => 'welcome',
            ]);
        }

        // $user->profile()->firstOrcreate([
        //     'email' => $user->email,
        //     'credits' => 1000,
        // ]);

        // dddx(app(ConsecutiveRatings::class)->execute($user->id));
        // if($user->consecutiveDaysLogin() >= 7){
        //     dddx('a');
        // }else{
        //     dddx('a');
        // }
    }
}
