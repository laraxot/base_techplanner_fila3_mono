<?php

declare(strict_types=1);

namespace Modules\Geo\Datas\Photon;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
#[MapOutputName(SnakeCaseMapper::class)]
class PhotonAddressData extends Data
{
    public function __construct(
        public ?string $country,
        public ?string $city,
        public ?string $postcode,
        public ?string $street,
        public ?string $housenumber,
        public array $coordinates,
    ) {
    }

    public static function fromPhotonFeature(array $feature): self
    {
        $properties = $feature['properties'];
        $coordinates = $feature['geometry']['coordinates'];

        return new self(
            country: $properties['country'] ?? null,
            city: $properties['city'] ?? null,
            postcode: $properties['postcode'] ?? null,
            street: $properties['street'] ?? null,
            housenumber: $properties['housenumber'] ?? null,
            coordinates: [
                'latitude' => $coordinates[1],
                'longitude' => $coordinates[0],
            ],
        );
    }
}
