<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Modules\Geo\Datas\LocationData;

/**
 * Action per filtrare le coordinate geografiche all'interno di un raggio specificato.
 *
 * Questa action prende un punto centrale (latitudine e longitudine) e un array di coordinate,
 * e restituisce solo le coordinate che si trovano entro il raggio specificato dal punto centrale.
 *
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
 * @param  float  $centerLatitude  La latitudine del punto centrale
 * @param  float  $centerLongitude  La longitudine del punto centrale
 * @param  array<array{latitude: string, longitude: string}>  $coordinates  Array di coordinate da filtrare
 * @param  int  $radius  Raggio in metri entro cui filtrare le coordinate
=======
=======
>>>>>>> 0e7ec50 (.)
 * @param float                                             $centerLatitude  La latitudine del punto centrale
 * @param float                                             $centerLongitude La longitudine del punto centrale
 * @param array<array{latitude: string, longitude: string}> $coordinates     Array di coordinate da filtrare
 * @param int                                               $radius          Raggio in metri entro cui filtrare le coordinate
 *
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
 * @param  float  $centerLatitude  La latitudine del punto centrale
 * @param  float  $centerLongitude  La longitudine del punto centrale
 * @param  array<array{latitude: string, longitude: string}>  $coordinates  Array di coordinate da filtrare
 * @param  int  $radius  Raggio in metri entro cui filtrare le coordinate
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
 * @return array<array{latitude: string, longitude: string}> Le coordinate filtrate
 */
class FilterCoordinatesInRadiusAction
{
    public function __construct(
        private readonly CalculateDistanceAction $calculateDistanceAction,
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ) {}

    /**
     * @param  array<array{latitude: string, longitude: string}>  $coordinates
=======
=======
>>>>>>> 0e7ec50 (.)
    ) {
    }

    /**
     * @param array<array{latitude: string, longitude: string}> $coordinates
     *
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
    ) {}

    /**
     * @param  array<array{latitude: string, longitude: string}>  $coordinates
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
     * @return array<array{latitude: string, longitude: string}>
     */
    public function execute(
        float $centerLatitude,
        float $centerLongitude,
        array $coordinates,
        int $radius,
    ): array {
        $centerLocation = new LocationData(
            latitude: $centerLatitude,
            longitude: $centerLongitude,
            address: null
        );

        return array_filter(
            $coordinates,
            function (array $coordinate) use ($centerLocation, $radius): bool {
                $targetLocation = new LocationData(
                    latitude: (float) $coordinate['latitude'],
                    longitude: (float) $coordinate['longitude'],
                    address: null
                );

                $distance = $this->calculateDistanceAction->execute($centerLocation, $targetLocation)['distance']['value'];

                return $distance <= $radius;
            }
        );
    }
}
