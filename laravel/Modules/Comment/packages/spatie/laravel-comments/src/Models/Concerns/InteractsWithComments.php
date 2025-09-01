<?php

namespace Spatie\Comments\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Spatie\Comments\Enums\NotificationSubscriptionType;
use Spatie\Comments\Support\CommentatorProperties;
use Spatie\Comments\Support\Config;

trait InteractsWithComments
{
    use Notifiable;

    public function commentatorComments(): MorphMany
    {
        return $this->morphMany(Config::commentModelClass(), 'commentator');
    }

    public function subscriberNotificationSubscriptions(): MorphMany
    {
        return $this->morphMany(Config::commentNotificationSubscriptionModelClass(), 'subscriber');
    }

    public function reactions(): MorphMany
    {
        return $this->morphMany(Config::reactionModelClass(), 'commentator');
    }

    public function commentatorProperties(): CommentatorProperties
    {
        $segment = md5(strtolower($this->email));

        $defaultImage = Config::gravatarDefaultImage();

        return CommentatorProperties::email($this->email)
            ->name($this->{Config::commentatorModelNameField()})
            ->avatar($this->{Config::commentatorModelAvatarField()} ?? "https://www.gravatar.com/avatar/{$segment}?d={$defaultImage}");
    }

    public function subscribeToCommentNotifications(
        Model                        $hasComment,
        NotificationSubscriptionType $subscriptionType
    ): self {
        $this->subscriberNotificationSubscriptions()->updateOrCreate([
            'commentable_type' => $hasComment->getMorphClass(),
            'commentable_id' => $hasComment->getKey(),
        ], [
            'type' => $subscriptionType->value,
        ]);

        return $this;
    }

    public function unsubscribeFromCommentNotifications(Model $hasComments): self
    {
        $this
            ->subscribeToCommentNotifications($hasComments, NotificationSubscriptionType::None);

        return $this;
    }

    public function unsubscribeFromCommentNotificationsUrl(Model $hasComments): ?string
    {
        $notificationSubscription = $this->subscriberNotificationSubscriptions()
            ->where('commentable_type', $hasComments->getMorphClass())
            ->where('commentable_id', $hasComments->getKey())
            ->first();

        if (! $notificationSubscription) {
            return null;
        }

        return URL::signedRoute(
            'comments::notifications.unsubscribe',
            [$notificationSubscription],
            now()->addWeek(),
        );
    }

    public function unsubscribeFromAllCommentNotifications(): self
    {
        $this
            ->subscriberNotificationSubscriptions()
            ->delete();

        return $this;
    }

    public function unsubscribeFromAllCommentNotificationsUrl(): string
    {
        return URL::signedRoute(
            'comments::notifications.unsubscribeAll',
            [get_class($this), $this->getKey()],
            now()->addWeek(),
        );
    }

    public function notificationSubscriptionType(Model $hasComments): ?NotificationSubscriptionType
    {
        return $this
            ->subscriberNotificationSubscriptions()
            ->where('commentable_type', $hasComments->getMorphClass())
            ->where('commentable_id', $hasComments->getKey())
            ->first()?->type;
    }
}
