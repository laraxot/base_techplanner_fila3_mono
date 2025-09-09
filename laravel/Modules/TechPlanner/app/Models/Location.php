<?php

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\TechPlanner\Database\Factories\LocationFactoryFactory;

/**
 * @property int $id
 * @property string|null $model_type
 * @property string|null $model_id
 * @property string|null $name
 * @property string|null $lat
 * @property string|null $lng
 * @property string|null $street
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property string|null $formatted_address
 * @property string|null $description
 * @property int|null $processed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @method static \Modules\TechPlanner\Database\Factories\LocationFactoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereFormattedAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereZip($value)
 * @mixin \Eloquent
 */
class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'address',
        'city',
        'postal_code',
        'country',
    ];

    protected static function newFactory(): LocationFactoryFactory
    {
        return LocationFactoryFactory::new();
    }
}
