<?php

declare(strict_types=1);

namespace Modules\Comment\Models;

use Spatie\Comments\Models\Comment as BaseComment;

/**
 * 
 *
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
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, BaseComment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, BaseComment> $nestedComments
 * @property-read int|null $nested_comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Comments\Models\CommentNotificationSubscription> $notificationSubscriptions
 * @property-read int|null $notification_subscriptions_count
 * @property-read BaseComment|null $parentComment
 * @property-read \Spatie\Comments\Models\Collections\ReactionCollection<int, \Spatie\Comments\Models\Reaction> $reactions
 * @property-read int|null $reactions_count
 * @property-read \Spatie\Comments\Models\Collections\ReactionCollection<int, \Spatie\Comments\Models\Reaction> $unsortedReactionCounts
 * @property-read int|null $unsorted_reaction_counts_count
 * @method static Builder<static>|Comment approved()
 * @method static Builder<static>|Comment pending()
 * @method static Builder<static>|Comment topLevel()
 * @mixin \Eloquent
 */
class Comment extends BaseComment
{
    /** @var string */
    protected $connection = 'comment';
}
