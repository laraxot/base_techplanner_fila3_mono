<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Modules\Geo\Database\Factories\PlaceFactory;
use Modules\Xot\Traits\Updater;

/**
 * Class Place.
 *
 * @property int             $id
 * @property string|null     $post_type
 * @property int|null        $post_id
 * @property string|null     $formatted_address
 * @property string|null     $latitude
 * @property string|null     $longitude
 * @property string|null     $premise
 * @property string|null     $locality
 * @property string|null     $postal_town
 * @property string|null     $administrative_area_level_3
 * @property string|null     $administrative_area_level_2
 * @property string|null     $administrative_area_level_1
 * @property string|null     $country
 * @property string|null     $street_number
 * @property string|null     $route
 * @property string|null     $postal_code
 * @property string|null     $googleplace_url
 * @property string|null     $point_of_interest
 * @property string|null     $political
 * @property string|null     $campground
 * @property string|null     $nearest_street
 * @property string|null     $created_by
 * @property string|null     $updated_by
 * @property string|null     $deleted_by
 * @property Carbon|null     $created_at
 * @property Carbon|null     $updated_at
 * @property string          $value
 * @property Model|\Eloquent $linked
 * @property mixed $address
 * @property mixed $latlng
 *
 * @method static \Modules\Geo\Database\Factories\PlaceFactory factory($count = null, $state = [])
 * @method static Builder|Place newModelQuery()
 * @method static Builder|Place newQuery()
 * @method static Builder|Place query()
 * @method static Builder|Place whereAdministrativeAreaLevel1($value)
 * @method static Builder|Place whereAdministrativeAreaLevel1Short($value)
 * @method static Builder|Place whereAdministrativeAreaLevel2($value)
 * @method static Builder|Place whereAdministrativeAreaLevel2Short($value)
 * @method static Builder|Place whereAdministrativeAreaLevel3($value)
 * @method static Builder|Place whereAdministrativeAreaLevel3Short($value)
 * @method static Builder|Place whereCampground($value)
 * @method static Builder|Place whereCampgroundShort($value)
 * @method static Builder|Place whereCountry($value)
 * @method static Builder|Place whereCountryShort($value)
 * @method static Builder|Place whereCreatedAt($value)
 * @method static Builder|Place whereCreatedBy($value)
 * @method static Builder|Place whereDeletedBy($value)
 * @method static Builder|Place whereFormattedAddress($value)
 * @method static Builder|Place whereGoogleplaceUrl($value)
 * @method static Builder|Place whereGoogleplaceUrlShort($value)
 * @method static Builder|Place whereId($value)
 * @method static Builder|Place whereLatitude($value)
 * @method static Builder|Place whereLocality($value)
 * @method static Builder|Place whereLocalityShort($value)
 * @method static Builder|Place whereLongitude($value)
 * @method static Builder|Place whereNearestStreet($value)
 * @method static Builder|Place wherePointOfInterest($value)
 * @method static Builder|Place wherePointOfInterestShort($value)
 * @method static Builder|Place wherePolitical($value)
 * @method static Builder|Place wherePoliticalShort($value)
 * @method static Builder|Place wherePostId($value)
 * @method static Builder|Place wherePostType($value)
 * @method static Builder|Place wherePostalCode($value)
 * @method static Builder|Place wherePostalCodeShort($value)
 * @method static Builder|Place wherePostalTown($value)
 * @method static Builder|Place wherePostalTownShort($value)
 * @method static Builder|Place wherePremise($value)
 * @method static Builder|Place wherePremiseShort($value)
 * @method static Builder|Place whereRoute($value)
 * @method static Builder|Place whereRouteShort($value)
 * @method static Builder|Place whereStreetNumber($value)
 * @method static Builder|Place whereStreetNumberShort($value)
 * @method static Builder|Place whereUpdatedAt($value)
 * @method static Builder|Place whereUpdatedBy($value)
 *
 * @property string|null $model_type
 * @property int|null $model_id
 *
 * @method static Builder|Place whereAddress($value)
 * @method static Builder|Place whereModelId($value)
 * @method static Builder|Place whereModelType($value)
 *
 * @property \Modules\Fixcity\Models\Profile|null $creator
 * @property \Modules\Fixcity\Models\Profile|null $updater
 *
 * @mixin \Eloquent
 */
class Place extends Model
{
    use HasFactory, Updater;

    /** @var array<string> */
    public static array $address_components = [
        'premise', 'locality', 'postal_town',
        'administrative_area_level_3', 'administrative_area_level_2', 'administrative_area_level_1',
        'country', 'street_number', 'route', 'postal_code',
        'googleplace_url', 'point_of_interest', 'political', 'campground',
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
        'nearest_street', 'address',
    ];

    /** @var list<string> */
    protected $appends = ['value'];

    /**
     * Accessor for the "value" attribute.
     */
    public function getValueAttribute(): string
    {
        return implode(', ', array_filter([
            $this->route,
            $this->street_number,
            $this->locality,
            $this->administrative_area_level_2,
            $this->country,
        ]));
    }

    /**
     * Morph relationship to the linked model.
     */
    public function linked(): MorphTo
    {
        return $this->morphTo('post');
    }

    // Add type declaration for $value parameter
    public function setLatlngAttribute(array $value): void
    {
        if (isset($value['lat'], $value['lng'])) {
            $this->attributes['latitude'] = (string) $value['lat'];
            $this->attributes['longitude'] = (string) $value['lng'];
        }
    }

    public function setAddressAttribute(string|array $value): void
    {
        if (is_string($value) && isJson($value)) {
            try {
                $json = json_decode($value, true, 512, JSON_THROW_ON_ERROR);

                if (is_array($json)) {
                    if (isset($json['latlng']) && is_array($json['latlng'])) {
                        if (isset($json['latlng']['lat'], $json['latlng']['lng'])) {
                            $json['latitude'] = $json['latlng']['lat'];
                            $json['longitude'] = $json['latlng']['lng'];
                            unset($json['latlng'], $json['value']);
                        }
                    }

                    // Ensure we're merging arrays
                    $this->attributes = array_merge(
                        is_array($this->attributes) ? $this->attributes : [],
                        $json
                    );
                }
            } catch (\JsonException $e) {
                // Handle JSON decode error if needed
            }
        } elseif (is_array($value)) {
            $this->attributes['address'] = json_encode($value, JSON_THROW_ON_ERROR);
        } else {
            $this->attributes['address'] = $value;
        }
    }

    /**
     * Scope a query to filter by country.
     */
    public function scopeWhereCountry(Builder $query, string $country): Builder
    {
        return $query->where('country', $country);
    }

    /**
     * Scope a query to filter by locality.
     */
    public function scopeWhereLocality(Builder $query, string $locality): Builder
    {
        return $query->where('locality', $locality);
    }

    /**
     * Accessor for the "formatted_address" attribute.
     */
    public function getFormattedAddressAttribute(): string
    {
        return $this->attributes['formatted_address'] ?? $this->getValueAttribute();
    }

    /**
     * Mutator for the "formatted_address" attribute.
     */
    public function setFormattedAddressAttribute(string $value): void
    {
        $this->attributes['formatted_address'] = $value;
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return PlaceFactory::new();
    }

    /**
     * Check if the given coordinates match the Place.
     */
    public function matchesCoordinates(string $latitude, string $longitude): bool
    {
        return $this->latitude === $latitude && $this->longitude === $longitude;
    }

    /**
     * Determine if the Place is located within a specific country.
     */
    public function isInCountry(string $country): bool
    {
        return $this->country === $country;
    }

    /**
     * Determine if the Place has complete address information.
     */
    public function hasCompleteAddress(): bool
    {
        return ! empty($this->route) && ! empty($this->street_number) && ! empty($this->locality);
    }

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}
