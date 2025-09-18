<?php

declare(strict_types=1);

namespace Modules\User\Models;

use Modules\Xot\Contracts\ProfileContract;

/**
 * ProfileTeam Model
 *
 * Represents the relationship between a profile and a team, including the user's role.
 *
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @property string $id
 * @property int $team_id
 * @property string|null $user_id
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileTeam whereUserId($value)
 * @mixin IdeHelperProfileTeam
 * @mixin \Eloquent
 */
class ProfileTeam extends TeamUser
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile_team';
}
