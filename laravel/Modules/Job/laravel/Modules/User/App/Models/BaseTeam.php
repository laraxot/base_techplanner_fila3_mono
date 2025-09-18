<?php

declare(strict_types=1);

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Modules\User\Contracts\TeamContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Models\Traits\HasExtraTrait;

/**
 * Modules\User\Models\Team.
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $personal_team
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property EloquentCollection<int, Model&UserContract> $members
 * @property int|null $members_count
 * @property UserContract|null $owner
 * @property EloquentCollection<int, TeamInvitation> $teamInvitations
 * @property int|null $team_invitations_count
 * @property EloquentCollection<int, Model&UserContract> $users
 * @property int|null $users_count
 *
 * @method static \Modules\User\Database\Factories\TeamFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
 *
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedBy($value)
 *
 * @property Membership $membership
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 * @property string $uuid
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUuid($value)
 *
 * @mixin \Eloquent
 */
abstract class BaseTeam extends BaseModel implements TeamContract
{
    // Se ho bisogno di extra in customer aggiungo extra in customer
    // use HasExtraTrait;

    /** @var list<string> */
    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'personal_team',
    ];

    /** @var list<string> */
    protected $with = [
        // 'extra',
    ];

    /**
     * Get the owner of the team.
     */
    public function owner(): BelongsTo
    {
        $xotData = XotData::make();
        /** @var class-string<Model> */
        $user_class = $xotData->getUserClass();

        return $this->belongsTo($user_class, 'user_id');
    }

    /**
     * Get all of the team's users including its owner.
     */
    public function allUsers(): Collection
    {
        if (! $this->owner instanceof User) {
            return $this->users;
        }

        return $this->users->merge([$this->owner]);
    }

    /**
     * Get all of the users that belong to the team.
     */
    public function users(): BelongsToMany
    {
        $xotData = XotData::make();
        /** @var class-string<Model> */
        $userClass = $xotData->getUserClass();

        return $this->belongsToManyX($userClass);
    }

    public function members(): BelongsToMany
    {
        return $this->users();
    }

    /**
     * Determine if the given user belongs to the team.
     */
    public function hasUser(UserContract $user): bool
    {
        // Parameter #1 $key of method Illuminate\Database\Eloquent\Collection<int,Modules\User\Models\User>::contains() expects (callable(Modules\User\Models\User, int):
        // bool)|int|Modules\User\Models\User|string, Modules\User\Contracts\UserContract given.
        // ✏️  User\Models\Team.php
        if ($this->users->contains($user::class)) {
            return true;
        }

        return $user->ownsTeam($this);
    }

    /**
     * Determine if the given email address belongs to a user on the team.
     */
    public function hasUserWithEmail(string $email): bool
    {
        return $this->allUsers()->contains(static fn ($user): bool => $user->email === $email);
    }

    /**
     * Determine if the given user has the given permission on the team.
     */
    public function userHasPermission(UserContract $userContract, string $permission): bool
    {
        return $userContract->hasTeamPermission($this, $permission);
    }

    /**
     * Get all of the pending user invitations for the team.
     */
    public function teamInvitations(): HasMany
    {
        return $this->hasMany(TeamInvitation::class);
    }

    /**
     * Remove the given user from the team.
     */
    public function removeUser(UserContract $userContract): void
    {
        if ($userContract->current_team_id === $this->id) {
            $userContract->forceFill(
                [
                    'current_team_id' => null,
                ]
            )->save();
        }

        $this->users()->detach($userContract);
    }

    /**
     * Purge all of the team's resources.
     */
    public function purge(): void
    {
        $this->owner()->where('current_team_id', $this->id)
            ->update(['current_team_id' => null]);

        $this->users()->where('current_team_id', $this->id)
            ->update(['current_team_id' => null]);

        $this->users()->detach();

        $this->delete();
    }
}
