<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Modules\Geo\Datas\LocationData;
use Modules\Geo\Exceptions\InvalidLocationException;

class ClusterLocationsAction
{
    public function __construct(
        private readonly CalculateDistanceAction $distanceCalculator,
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    ) {}
=======
    ) {
    }
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
    ) {
    }
=======
    ) {}
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
    ) {}
>>>>>>> 6f0eea5 (.)

    /**
     * Raggruppa le posizioni in cluster basati sulla distanza.
     *
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  array<LocationData>  $locations  Lista delle posizioni da raggruppare
     * @param  float  $maxDistance  Distanza massima in km tra i punti di un cluster
     * @return array<array{center: LocationData, points: array<LocationData>}>
     *
     * @throws InvalidLocationException Se i dati della posizione non sono validi
=======
=======
>>>>>>> 0e7ec50 (.)
     * @param array<LocationData> $locations   Lista delle posizioni da raggruppare
     * @param float               $maxDistance Distanza massima in km tra i punti di un cluster
     *
     * @throws InvalidLocationException Se i dati della posizione non sono validi
     *
     * @return array<array{center: LocationData, points: array<LocationData>}>
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
     * @param  array<LocationData>  $locations  Lista delle posizioni da raggruppare
     * @param  float  $maxDistance  Distanza massima in km tra i punti di un cluster
     * @return array<array{center: LocationData, points: array<LocationData>}>
     *
     * @throws InvalidLocationException Se i dati della posizione non sono validi
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
     */
    public function execute(array $locations, float $maxDistance = 1.0): array
    {
        $clusters = [];

        foreach ($locations as $location) {
            if (! $location instanceof LocationData) {
                throw InvalidLocationException::invalidData();
            }

            $assigned = false;

            foreach ($clusters as &$cluster) {
                $distance = $this->distanceCalculator->execute($cluster['center'], $location);
                $distanceKm = (float) $distance['distance']['value'] / 1000;

                if ($distanceKm <= $maxDistance) {
                    $cluster['points'][] = $location;
                    $this->updateClusterCenter($cluster);
                    $assigned = true;
                    break;
                }
            }

            if (! $assigned) {
                $clusters[] = [
                    'center' => $location,
                    'points' => [$location],
                ];
            }
        }

        return $clusters;
    }

    /**
     * Aggiorna il centro del cluster calcolando la media delle coordinate.
     *
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  array{center: LocationData, points: array<LocationData>}  $cluster
=======
     * @param array{center: LocationData, points: array<LocationData>} $cluster
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
     * @param array{center: LocationData, points: array<LocationData>} $cluster
=======
     * @param  array{center: LocationData, points: array<LocationData>}  $cluster
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
     * @param  array{center: LocationData, points: array<LocationData>}  $cluster
>>>>>>> 6f0eea5 (.)
     */
    private function updateClusterCenter(array &$cluster): void
    {
        $latSum = array_sum(array_map(
            fn (LocationData $point) => $point->latitude,
            $cluster['points']
        ));

        $lonSum = array_sum(array_map(
            fn (LocationData $point) => $point->longitude,
            $cluster['points']
        ));

        $count = count($cluster['points']);

        $cluster['center'] = new LocationData(
            latitude: $latSum / $count,
            longitude: $lonSum / $count
        );
    }
}
