<?php

declare(strict_types=1);

namespace Modules\Predict\Models;

use Modules\User\Models\BaseUser;
use Spatie\Comments\Models\Concerns\InteractsWithComments;
use Spatie\Comments\Models\Concerns\Interfaces\CanComment;

/**
 * @property string                                                                                                        $id
 * @property string|null                                                                                                   $name
 * @property string|null                                                                                                   $first_name
 * @property string|null                                                                                                   $last_name
 * @property string                                                                                                        $email
 * @property \Illuminate\Support\Carbon|null                                                                               $email_verified_at
 * @property string                                                                                                        $password
 * @property string|null                                                                                                   $remember_token
 * @property int|null                                                                                                      $current_team_id
 * @property string|null                                                                                                   $profile_photo_path
 * @property \Illuminate\Support\Carbon|null                                                                               $created_at
 * @property \Illuminate\Support\Carbon|null                                                                               $updated_at
 * @property \Illuminate\Support\Carbon|null                                                                               $deleted_at
 * @property string|null                                                                                                   $lang
 * @property bool                                                                                                          $is_active
 * @property string|null                                                                                                   $facebook_id
 * @property string|null                                                                                                   $updated_by
 * @property string|null                                                                                                   $created_by
 * @property string|null                                                                                                   $deleted_by
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\OauthClient>                               $clients
 * @property int|null                                                                                                      $clients_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Comments\Models\Comment>                                $commentatorComments
 * @property int|null                                                                                                      $commentator_comments_count
 * @property \Modules\User\Models\Team|null                                                                                $currentTeam
 * @property \Modules\User\Models\TenantUser                                                                               $pivot
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device>                                    $devices
 * @property int|null                                                                                                      $devices_count
 * @property string|null                                                                                                   $full_name
 * @property \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property int|null                                                                                                      $notifications_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Team>                                      $ownedTeams
 * @property int|null                                                                                                      $owned_teams_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Permission>                                $permissions
 * @property int|null                                                                                                      $permissions_count
 * @property \Modules\Xot\Contracts\ProfileContract|null                                                                   $profile
 * @property \Spatie\Comments\Models\Collections\ReactionCollection<int, \Spatie\Comments\Models\Reaction>                 $reactions
 * @property int|null                                                                                                      $reactions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Role>                                      $roles
 * @property int|null                                                                                                      $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Comments\Models\CommentNotificationSubscription>        $subscriberNotificationSubscriptions
 * @property int|null                                                                                                      $subscriber_notification_subscriptions_count
 * @property \Modules\User\Models\Membership                                                                               $membership
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Team>                                      $teams
 * @property int|null                                                                                                      $teams_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Tenant>                                    $tenants
 * @property int|null                                                                                                      $tenants_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\OauthAccessToken>                          $tokens
 * @property int|null                                                                                                      $tokens_count
 *
 * @method static \Modules\User\Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User   permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User   query()
 * @method static \Illuminate\Database\Eloquent\Builder|User   role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User   withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User   withoutRole($roles, $guard = null)
 *
 * @property bool                                                                                  $is_otp
 * @property \Illuminate\Support\Carbon|null                                                       $password_expires_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\AuthenticationLog> $authentications
 * @property int|null                                                                              $authentications_count
 * @property \Modules\User\Models\AuthenticationLog|null                                           $latestAuthentication
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\SocialiteUser>     $socialiteUsers
 * @property int|null                                                                              $socialite_users_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePasswordExpiresAt($value)
 *
 * @mixin \Eloquent
 */
class User extends BaseUser implements CanComment
{
    use InteractsWithComments;
}
