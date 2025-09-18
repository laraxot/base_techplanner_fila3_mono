<?php

declare(strict_types=1);

namespace Modules\Predict\Models;

use Modules\Blog\Models\Profile as BaseProfile;

/**
 * @property string                                                                                                        $id
 * @property string                                                                                                        $user_id
 * @property string|null                                                                                                   $first_name
 * @property string|null                                                                                                   $last_name
 * @property string|null                                                                                                   $email
 * @property string                                                                                                        $credits
 * @property string|null                                                                                                   $slug
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes|null                                                        $extra
 * @property \Illuminate\Support\Carbon|null                                                                               $created_at
 * @property \Illuminate\Support\Carbon|null                                                                               $updated_at
 * @property string|null                                                                                                   $updated_by
 * @property string|null                                                                                                   $created_by
 * @property \Illuminate\Support\Carbon|null                                                                               $deleted_at
 * @property string|null                                                                                                   $deleted_by
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Article>                                   $articles
 * @property int|null                                                                                                      $articles_count
 * @property string                                                                                                        $avatar
 * @property BaseProfile|null                                                                                              $creator
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser>                                $deviceUsers
 * @property int|null                                                                                                      $device_users_count
 * @property string|null                                                                                                   $full_name
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media>    $media
 * @property int|null                                                                                                      $media_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser>                                $mobileDeviceUsers
 * @property int|null                                                                                                      $mobile_device_users_count
 * @property \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property int|null                                                                                                      $notifications_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Permission>                                $permissions
 * @property int|null                                                                                                      $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Rating\Models\RatingMorph>                             $ratingMorphs
 * @property int|null                                                                                                      $rating_morphs_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Rating\Models\Rating>                                  $ratings
 * @property int|null                                                                                                      $ratings_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Role>                                      $roles
 * @property int|null                                                                                                      $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Transaction>                               $transanctions
 * @property int|null                                                                                                      $transanctions_count
 * @property BaseProfile|null                                                                                              $updater
 * @property \Modules\User\Models\User|null                                                                                $user
 * @property string|null                                                                                                   $user_name
 *
 * @method static \Modules\Predict\Database\Factories\ProfileFactory    factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newQuery()
 * @method static Builder<static>|Profile                               permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile query()
 * @method static Builder<static>|Profile                               role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUserId($value)
 * @method static Builder<static>|Profile                               withExtraAttributes()
 * @method static Builder<static>|Profile                               withoutPermission($permissions)
 * @method static Builder<static>|Profile                               withoutRole($roles, $guard = null)
 *
 * @property \Modules\User\Models\ProfileTeam|\Modules\User\Models\DeviceProfile|null   $pivot
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device> $devices
 * @property int|null                                                                   $devices_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device> $mobileDevices
 * @property int|null                                                                   $mobile_devices_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Team>   $teams
 * @property int|null                                                                   $teams_count
 *
 * @mixin \Eloquent
 */
class Profile extends BaseProfile
{
    /** @var string */
    protected $connection = 'predict'; // this will use the specified database connection
}
