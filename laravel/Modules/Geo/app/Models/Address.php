<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Geo\Contracts\HasGeolocation;
use Modules\Geo\Database\Factories\AddressFactory;
use Modules\Geo\Enums\AddressTypeEnum;

/**
 * Class Address
 * 
 * Implementazione di Schema.org PostalAddress
 *
 * @property int $id
 * @property string|null $model_type
 * @property int|null $model_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $route
 * @property string|null $street_number
 * @property string|null $locality
 * @property string|null $administrative_area_level_3
 * @property string|null $administrative_area_level_2
 * @property string|null $administrative_area_level_1
 * @property string|null $country
 * @property string|null $postal_code
 * @property string|null $formatted_address
 * @property string|null $place_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $type
 * @property bool $is_primary
 * @property array|null $extra_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $addressable
 * @property-read \Modules\User\Models\Profile|null $creator
 * @property-read string $full_address
 * @property-read string $street_address
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent|null $model
 * @property-read \Modules\User\Models\Profile|null $updater
 * @method static \Modules\Geo\Database\Factories\AddressFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address nearby(float $latitude, float $longitude, float $radiusKm = '10')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address ofType($type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address primary()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereAdministrativeAreaLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereAdministrativeAreaLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereAdministrativeAreaLevel3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereExtraData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereFormattedAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereLocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Address extends BaseModel implements HasGeolocation
{
    use HasFactory;
    use SoftDeletes;
        
    /** @var list<string> */
    protected $fillable = [
        'model_type',
        'model_id',
        'name',
        'description',
        'route',
        'street_number',
        'locality',
        'administrative_area_level_3',
        'administrative_area_level_2',
        'administrative_area_level_1',
        'country',
        'postal_code',
        'formatted_address',
        'place_id',
        'latitude',
        'longitude',
        'type',
        'is_primary',
        'extra_data',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'is_primary' => 'boolean',
            'extra_data' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Get the model that owns this address.
     *
     * @return MorphTo<Model, self>
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the addressable model.
     *
     * @return MorphTo<Model, self>
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the region information.
     *
     * @return array<string, mixed>|null
     */
    public function getRegione(): ?array
    {
        if (!$this->administrative_area_level_1) {
            return null;
        }

        return [
            'name' => $this->administrative_area_level_1,
            'short_name' => $this->administrative_area_level_1,
        ];
    }

    /**
     * Get the province information.
     *
     * @return array<string, mixed>|null
     */
    public function getProvincia(): ?array
    {
        if (!$this->administrative_area_level_2) {
            return null;
        }

        return [
            'name' => $this->administrative_area_level_2,
            'short_name' => $this->administrative_area_level_2,
        ];
    }

    /**
     * Get the locality information.
     *
     * @return array<string, mixed>|null
     */
    public function getLocality(): ?array
    {
        if (!$this->locality) {
            return null;
        }

        return [
            'name' => $this->locality,
            'short_name' => $this->locality,
        ];
    }

    /**
     * Get the full address attribute.
     *
     * @return string
     */
    public function getFullAddressAttribute(): string
    {
        return $this->getFullAddress() ?? '';
    }

    /**
     * Get the full address.
     *
     * @return string|null
     */
    public function getFullAddress(): ?string
    {
        $parts = [];

        if ($this->street_number && $this->route) {
            $parts[] = $this->street_number . ' ' . $this->route;
        } elseif ($this->route) {
            $parts[] = $this->route;
        }

        if ($this->locality) {
            $parts[] = $this->locality;
        }

        if ($this->postal_code) {
            $parts[] = $this->postal_code;
        }

        return !empty($parts) ? implode(', ', $parts) : null;
    }

    /**
     * Get the street address attribute.
     *
     * @return string
     */
    public function getStreetAddressAttribute(): string
    {
        $parts = [];

        if ($this->street_number && $this->route) {
            $parts[] = $this->street_number . ' ' . $this->route;
        } elseif ($this->route) {
            $parts[] = $this->route;
        }

        return implode(', ', $parts);
    }

    /**
     * Get the formatted address attribute.
     *
     * @param string|null $value
     * @return string|null
     */
    public function getFormattedAddressAttribute(?string $value): ?string
    {
        if ($value) {
            return $value;
        }

        $parts = [];

        if ($this->name) {
            $parts[] = $this->name;
        }

        if ($this->street_number && $this->route) {
            $parts[] = $this->street_number . ' ' . $this->route;
        } elseif ($this->route) {
            $parts[] = $this->route;
        }

        if ($this->locality) {
            $parts[] = $this->locality;
        }

        if ($this->administrative_area_level_2) {
            $parts[] = $this->administrative_area_level_2;
        }

        if ($this->administrative_area_level_1) {
            $parts[] = $this->administrative_area_level_1;
        }

        if ($this->postal_code) {
            $parts[] = $this->postal_code;
        }

        if ($this->country) {
            $parts[] = $this->country;
        }

        return !empty($parts) ? implode(', ', $parts) : null;
    }

    /**
     * Get the latitude.
     *
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * Get the longitude.
     *
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * Get the formatted address.
     *
     * @return string
     */
    public function getFormattedAddress(): string
    {
        return (string) ($this->formatted_address ?? $this->getFormattedAddressAttribute(null) ?? '');
    }

    /**
     * Convert to Schema.org format.
     *
     * @return array<string, mixed>
     */
    public function toSchemaOrg(): array
    {
        return [
            '@type' => 'PostalAddress',
            'streetAddress' => $this->getStreetAddressAttribute(),
            'addressLocality' => $this->locality,
            'addressRegion' => $this->administrative_area_level_1,
            'addressCountry' => $this->country,
            'postalCode' => $this->postal_code,
        ];
    }

    /**
     * Scope for nearby addresses.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param float $latitude
     * @param float $longitude
     * @param float $radiusKm
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeNearby($query, float $latitude, float $longitude, float $radiusKm = 10)
    {
        return $query->whereRaw(
            'ST_Distance_Sphere(POINT(longitude, latitude), POINT(?, ?)) <= ?',
            [$longitude, $latitude, $radiusKm * 1000]
        );
    }

    /**
     * Scope for primary addresses.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Scope for addresses of specific type.
     *
     * @param \Illuminate\Database\Eloquent\Builder<static> $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return AddressFactory
     */
    protected static function newFactory(): AddressFactory
    {
        return AddressFactory::new();
    }
}
