<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Modules\Xot\Contracts\ProfileContract;

/**
 * Class Location.
 *
 * @property int                  $id
 * @property string|null          $model_type
 * @property string|null          $model_id
 * @property string|null          $name
 * @property float|null           $lat
 * @property float|null           $lng
 * @property string|null          $street
 * @property string|null          $city
 * @property string|null          $state
 * @property string|null          $zip
 * @property string|null          $formatted_address
 * @property string|null          $description
 * @property bool|null            $processed
 * @property Carbon|null          $created_at
 * @property Carbon|null          $updated_at
 * @property string|null          $updated_by
 * @property string|null          $created_by
 * @property string|null          $deleted_at
 * @property string|null          $deleted_by
 * @property array                $location
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCity(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLat(float $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLng(float $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereProcessed(bool $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereState(string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereZip(string $value)
 * @method static Builder<static>|Location newModelQuery()
 * @method static Builder<static>|Location newQuery()
 * @method static Builder<static>|Location withinDistance(float $latitude, float $longitude, float $distanceInKm)
 * @method static Builder<static>|Location whereCreatedAt($value)
 * @method static Builder<static>|Location whereCreatedBy($value)
 * @method static Builder<static>|Location whereDeletedAt($value)
 * @method static Builder<static>|Location whereDeletedBy($value)
 * @method static Builder<static>|Location whereDescription($value)
 * @method static Builder<static>|Location whereFormattedAddress($value)
 * @method static Builder<static>|Location whereId($value)
 * @method static Builder<static>|Location whereModelId($value)
 * @method static Builder<static>|Location whereModelType($value)
 * @method static Builder<static>|Location whereName($value)
 * @method static Builder<static>|Location whereStreet($value)
 * @method static Builder<static>|Location whereUpdatedAt($value)
 * @method static Builder<static>|Location whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Location extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'model_type',
        'model_id',
        'name',
        'lat',
        'lng',
        'street',
        'city',
        'state',
        'zip',
        'formatted_address',
        'description',
        'processed',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'lat' => 'float',
            'lng' => 'float',
            'processed' => 'boolean',
            'location' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the location attribute.
     *
     * @return Attribute
     */
    protected function location(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (is_string($value)) {
                    return json_decode($value, true);
                }

                return $value;
            },
            set: function ($value) {
                if (is_array($value)) {
                    return json_encode($value);
                }

                return $value;
            }
        );
    }

    /**
     * Get the latitude and longitude attributes.
     *
     * @return array<string, string>
     */
    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'latitude',
            'lng' => 'longitude',
        ];
    }

    /**
     * Get the computed location.
     *
     * @return string
     */
    public static function getComputedLocation(): string
    {
        return 'location';
    }

    /**
     * Scope for locations within a certain distance.
     *
     * @param Builder<static> $query
     * @param float $latitude
     * @param float $longitude
     * @param float $distanceInKm
     * @return Builder<static>
     */
    public function scopeWithinDistance(Builder $query, float $latitude, float $longitude, float $distanceInKm): Builder
    {
        return $query->whereRaw(
            'ST_Distance_Sphere(POINT(lng, lat), POINT(?, ?)) <= ?',
            [$longitude, $latitude, $distanceInKm * 1000]
        );
    }
}
