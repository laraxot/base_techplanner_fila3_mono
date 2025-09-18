<?php

declare(strict_types=1);

namespace Modules\Comment\Models;

use Spatie\Comments\Models\CommentNotificationSubscription as BaseCommentNotificationSubscription;

/**
 * 
 *
 * @property int $id
 * @property string $commentable_type
 * @property int $commentable_id
 * @property string $subscriber_type
 * @property int $subscriber_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 * @method static \Modules\Comment\Database\Factories\CommentNotificationSubscriptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereSubscriberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereSubscriberType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationSubscription whereUpdatedBy($value)
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subscriber
 * @mixin \Eloquent
 */
class CommentNotificationSubscription extends BaseCommentNotificationSubscription
{
    /** @var string */
    protected $connection = 'comment';
}
