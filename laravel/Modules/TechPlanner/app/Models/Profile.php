<?php

declare(strict_types=1);


namespace Modules\TechPlanner\Models;

use Modules\User\Models\BaseProfile;

/**
 * @property string $id
 * @property string $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $fiscal_code
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $deleted_by
 * @property string $credits
 * @property string|null $slug
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes|null $extra
 * @property-read string $avatar
 * @property-read Profile|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser> $deviceUsers
 * @property-read int|null $device_users_count
 * @property-read \Modules\User\Models\DeviceProfile|null $pivot
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device> $devices
 * @property-read int|null $devices_count
 * @property-read string|null $full_name
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser> $mobileDeviceUsers
 * @property-read int|null $mobile_device_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device> $mobileDevices
 * @property-read int|null $mobile_devices_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read Profile|null $updater
 * @property-read \Modules\User\Models\User|null $user
 * @property-read string|null $user_name
 * @method static \Modules\TechPlanner\Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder<static>|Profile permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile query()
 * @method   static \Illuminate\Database\Eloquent\Builder<static>|Profile role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereFiscalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUserId($value)
 * @method   static \Illuminate\Database\Eloquent\Builder<static>|Profile withExtraAttributes()
 * @method   static \Illuminate\Database\Eloquent\Builder<static>|Profile withoutPermission($permissions)
 * @method   static \Illuminate\Database\Eloquent\Builder<static>|Profile withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
class Profile extends BaseProfile
{
}
