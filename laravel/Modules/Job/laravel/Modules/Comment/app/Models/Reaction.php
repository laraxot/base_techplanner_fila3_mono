<?php

declare(strict_types=1);

namespace Modules\Comment\Models;

use Spatie\Comments\Models\Reaction as BaseReaction;

/**
 * 
 *
 * @property int $id
 * @property string|null $commentator_type
 * @property int|null $commentator_id
 * @property int $comment_id
 * @property string $reaction
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 * @method static \Modules\Comment\Database\Factories\ReactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereCommentatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereCommentatorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereReaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereUpdatedBy($value)
 * @property-read \Spatie\Comments\Models\Comment|null $comment
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentator
 * @method static \Spatie\Comments\Models\Collections\ReactionCollection<int, static> all($columns = ['*'])
 * @method static \Spatie\Comments\Models\Collections\ReactionCollection<int, static> get($columns = ['*'])
 * @mixin \Eloquent
 */
class Reaction extends BaseReaction
{
    /** @var string */
    protected $connection = 'comment';
}
