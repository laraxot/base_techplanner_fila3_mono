<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Geo\Contracts\HasGeolocation;
use Modules\Geo\Database\Factories\PlaceFactory;

use function Safe\json_encode;

/**
 * Place model for geographical locations.
 *
 * @property-read \Modules\Geo\Models\Address|null $address
 * @property-read \Modules\User\Models\Profile|null $creator
 * @property-read string $formatted_address
 * @property-read float|null $latitude
 * @property-read float|null $longitude
 * @property-read \Illuminate\Database\Eloquent\Model $linked
 * @property-read \Modules\Geo\Models\PlaceType|null $placeType
 * @property-read \Modules\User\Models\Profile|null $updater
 * @method static \Modules\Geo\Database\Factories\PlaceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place query()
 * @property int $id
 * @property string|null $model_type
 * @property int|null $model_id
 * @property string|null $nearest_street
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $post_type
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereFormattedAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereNearestStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Place whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Place extends BaseModel implements HasGeolocation
{
    use HasFactory;

    /**
     * List of address components used in the application.
     *
     * @var array<string>
     */
    public static array $address_components = [
        'premise',
        'locality',
        'postal_town',
        'administrative_area_level_3',
        'administrative_area_level_2',
        'administrative_area_level_1',
        'country',
        'street_number',
        'route',
        'postal_code',
        'point_of_interest',
        'political'
    ];

    /** @var list<string> */
    protected $fillable = [
        'id', 'post_id', 'post_type', 'model_id', 'model_type',
        'premise', 'locality', 'postal_town', 'administrative_area_level_3',
        'administrative_area_level_2', 'administrative_area_level_1', 'country',
        'street_number', 'route', 'postal_code', 'googleplace_url',
        'point_of_interest', 'political', 'campground', 'locality_short',
        'administrative_area_level_2_short', 'administrative_area_level_1_short',
        'country_short', 'latlng', 'latitude', 'longitude', 'formatted_address',
        'nearest_street', 'extra_data',
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
            'extra_data' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the linked model.
     *
     * @return MorphTo<Model, self>
     */
    public function linked(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the place type.
     *
     * @return BelongsTo<PlaceType, self>
     */
    public function placeType(): BelongsTo
    {
        return $this->belongsTo(PlaceType::class, 'type_id');
    }

    /**
     * Get the address.
     *
     * @return BelongsTo<Address, self>
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
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
        return (string) ($this->formatted_address ?? $this->address->formatted_address ?? '');
    }

    /**
     * Get the latitude attribute.
     *
     * @return float|null
     */
    public function getLatitudeAttribute(): ?float
    {
        if (isset($this->attributes['latlng'])) {
            $latlng = json_decode($this->attributes['latlng'], true);

            return $latlng['lat'] ?? null;
        }

        return $this->attributes['latitude'] ?? null;
    }

    /**
     * Get the longitude attribute.
     *
     * @return float|null
     */
    public function getLongitudeAttribute(): ?float
    {
        if (isset($this->attributes['latlng'])) {
            $latlng = json_decode($this->attributes['latlng'], true);

            return $latlng['lng'] ?? null;
        }

        return $this->attributes['longitude'] ?? null;
    }

    /**
     * Get the formatted address attribute.
     *
     * @return string
     */
    public function getFormattedAddressAttribute(): string
    {
        return $this->getFormattedAddress();
    }

    /**
     * Check if the place has valid coordinates.
     *
     * @return bool
     */
    public function hasValidCoordinates(): bool
    {
        return $this->latitude !== null && $this->longitude !== null;
    }

    /**
     * Get the map icon.
     *
     * @return string|null
     */
    public function getMapIcon(): ?string
    {
        if ($this->placeType) {
            return $this->placeType->icon;
        }

        return null;
    }

    /**
     * Get the location type.
     *
     * @return string|null
     */
    public function getLocationType(): ?string
    {
        if ($this->placeType) {
            return $this->placeType->name;
        }

        return null;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return PlaceFactory
     */
    protected static function newFactory(): PlaceFactory
    {
        return PlaceFactory::new();
    }
}
