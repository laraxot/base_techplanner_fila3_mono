<?php

declare(strict_types=1);

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

abstract class BaseUser extends Authenticatable
{
    use Notifiable;

    /**
     * Get the entity's notifications.
     */
    public function notifications(): MorphMany
    {
        /** @var class-string<\Illuminate\Database\Eloquent\Model> $notificationModel */
        $notificationModel = config('notifications.notification_model', \Illuminate\Notifications\DatabaseNotification::class);
        return $this->morphMany($notificationModel, 'notifiable');
    }
}
