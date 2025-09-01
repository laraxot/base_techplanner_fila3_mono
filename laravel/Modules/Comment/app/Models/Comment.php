<?php

declare(strict_types=1);

namespace Modules\Comment\Models;

use Spatie\Comments\Models\Comment as BaseComment;

/**
 * @property int $id
 * @property string $comment
 * @property int $post_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $parent_id
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property string|null $commentable_type
 * @property string|null $commentable_id
 * @property string|null $commentator_type
 * @property string|null $commentator_id
 * @property string $text
 * @property string|null $extra
 * @property string|null $approved_at
 * @property string $original_text
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
 * @method static \Modules\Comment\Database\Factories\CommentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentatorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereOriginalText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 *
 * @property \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property \Illuminate\Database\Eloquent\Model|\Eloquent $commentator
 * @property \Illuminate\Database\Eloquent\Collection<int, BaseComment> $comments
 * @property int|null $comments_count
 * @property \Illuminate\Database\Eloquent\Collection<int, BaseComment> $nestedComments
 * @property int|null $nested_comments_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Comments\Models\CommentNotificationSubscription> $notificationSubscriptions
 * @property int|null $notification_subscriptions_count
 * @property BaseComment|null $parentComment
 * @property \Spatie\Comments\Models\Collections\ReactionCollection<int, \Spatie\Comments\Models\Reaction> $reactions
 * @property int|null $reactions_count
 * @property \Spatie\Comments\Models\Collections\ReactionCollection<int, \Spatie\Comments\Models\Reaction> $unsortedReactionCounts
 * @property int|null $unsorted_reaction_counts_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment approved()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment topLevel()
 *
 * @mixin \Eloquent
 */
class Comment extends BaseComment
{
    /** @var string */
    protected $connection = 'comment';
}
