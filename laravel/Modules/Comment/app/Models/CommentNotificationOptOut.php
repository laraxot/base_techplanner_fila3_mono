<?php

declare(strict_types=1);

namespace Modules\Comment\Models;

use Spatie\Comments\Models\CommentNotificationOptOut as BaseCommentNotificationOptOut;

/**
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
 * @method static \Modules\Comment\Database\Factories\CommentNotificationOptOutFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationOptOut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationOptOut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentNotificationOptOut query()
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentator
 *
 * @mixin \Eloquent
 */
class CommentNotificationOptOut extends BaseCommentNotificationOptOut
{
    /** @var string */
    protected $connection = 'comment';
}
