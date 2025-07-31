<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\Xot\Contracts\ProfileContract;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Traits\Updater;

/**
 * @property array $location
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 *
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
 * @property bool|null $processed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereFormattedAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereZip($value)
 *
 * @property \Modules\Fixcity\Models\Profile|null $creator
 * @property \Modules\Fixcity\Models\Profile|null $updater
 *
 * @mixin \Eloquent
 */
class Location extends Model
{
    use Updater;

    protected $fillable = [
        'id',
        'name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'type',
    ];

    /** @var list<string> */
    protected $appends = ['value'];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'processed' => 'bool',
    ];

    /**
     * Accessor for the "location" attribute.
     */
    protected function location(): Attribute
    {
        return Attribute::make(
            get: fn (): array => [
                'lat' => (float) $this->lat,
                'lng' => (float) $this->lng,
            ],
            set: function (?array $value): void {
                if (is_array($value)) {
                    $this->attributes['lat'] = $value['lat'] ?? null;
                    $this->attributes['lng'] = $value['lng'] ?? null;
                }
            }
        );
    }

    /**
     * Get the latitude and longitude attributes.
     */
    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'lat',
            'lng' => 'lng',
        ];
    }

    /**
     * Get the computed location attribute name.
     */
    public static function getComputedLocation(): string
    {
        return 'location';
    }

    /**
     * Scope to filter by a specific distance from a given point.
     */
    public function scopeWithinDistance(Builder $query, float $latitude, float $longitude, float $distanceInKm): Builder
    {
        $haversine = "(6371 * acos(cos(radians($latitude)) * cos(radians(lat)) * cos(radians(lng) - radians($longitude)) + sin(radians($latitude)) * sin(radians(lat))))";

        return $query->whereRaw("$haversine <= ?", [$distanceInKm]);
    }
}
