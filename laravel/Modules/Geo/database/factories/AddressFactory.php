<?php

declare(strict_types=1);

namespace Modules\Geo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Geo\Enums\AddressTypeEnum;
use Modules\Geo\Models\Address;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Actions\Cast\SafeFloatCastAction;

/**
 * Class AddressFactory.
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(AddressTypeEnum::cases()),
            'route' => $this->faker->streetName,
            'street_number' => $this->faker->buildingNumber,
            'postal_code' => $this->faker->postcode,
            'locality' => $this->faker->city,
            //'administrative_area_level_3' => $this->faker->state,
          //  'administrative_area_level_2' => $this->faker->state,
            //'administrative_area_level_2_short' => $this->faker->stateAbbr,
            'country' => $this->faker->country,
            'country_short' => $this->faker->countryCode,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'formatted_address' => $this->faker->address,
            'is_primary' => $this->faker->boolean(20), // 20% di probabilità di essere primario
            'addressable_type' => null,
            'addressable_id' => null,
        ];
    }

    /**
     * Generate a primary address.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function primary(): Factory
    {
        return $this->state([
            'is_primary' => true,
        ]);
    }

    /**
     * Generate an address of a specific type.
     *
     * @param AddressTypeEnum $type
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ofType(AddressTypeEnum $type): Factory
    {
        return $this->state([
            'type' => $type,
        ]);
    }

    /**
     * Generate a home address.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function home(): Factory
    {
        return $this->ofType(AddressTypeEnum::HOME)->state([
            'name' => 'Casa',
            'is_primary' => true,
        ]);
    }

    /**
     * Generate a work address.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function work(): Factory
    {
        return $this->ofType(AddressTypeEnum::WORK)->state([
            'name' => 'Ufficio',
        ]);
    }

    /**
     * Generate a billing address.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function billing(): Factory
    {
        return $this->ofType(AddressTypeEnum::BILLING)->state([
            'name' => 'Indirizzo di Fatturazione',
        ]);
    }

    /**
     * Generate a shipping address.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function shipping(): Factory
    {
        return $this->ofType(AddressTypeEnum::SHIPPING)->state([
            'name' => 'Indirizzo di Spedizione',
        ]);
    }

    /**
     * Generate an address in a specific city.
     *
     * @param string $city
     * @param array<string, mixed> $cityData
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inCity(string $city, array $cityData = []): Factory
    {
        $defaultCityData = [
            'lat' => 45.4642,
            'lng' => 9.1900,
            'province' => $city,
            'region' => 'Lombardia',
            'postal' => '20100',
        ];

        $cityInfo = array_merge($defaultCityData, $cityData);

        return $this->state(function (array $attributes) use ($city, $cityInfo) {
            /** @var float $baseLat */
            $baseLat = app(\Modules\Xot\Actions\Cast\SafeFloatCastAction::class)->execute($cityInfo['lat'] ?? 45.4642);
            /** @var float $baseLng */
            $baseLng = app(\Modules\Xot\Actions\Cast\SafeFloatCastAction::class)->execute($cityInfo['lng'] ?? 9.1900);
            
            $latitude = $baseLat + $this->faker->randomFloat(4, -0.05, 0.05);
            $longitude = $baseLng + $this->faker->randomFloat(4, -0.05, 0.05);
            $streetName = $this->faker->streetName();
            $streetNumber = $this->faker->buildingNumber();
            $route = "Via {$streetName}";

            /** @var string $postal */
            $postal = app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($cityInfo['postal'] ?? '20100');
            /** @var string $province */
            $province = app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($cityInfo['province'] ?? $city);
            /** @var string $region */
            $region = app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($cityInfo['region'] ?? 'Lombardia');

            return [
                'locality' => $city,
                'administrative_area_level_3' => $province,
                'administrative_area_level_2' => $region,
                'postal_code' => $postal,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'route' => $route,
                'street_number' => $streetNumber,
                'formatted_address' => "{$route} {$streetNumber}, {$postal} {$city} ({$province}), Italia",
            ];
        });
    }

} 