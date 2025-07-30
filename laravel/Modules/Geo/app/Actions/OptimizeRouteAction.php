<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Illuminate\Support\Collection;
use Modules\Geo\Datas\LocationData;

/**
 * Action per ottimizzare l'ordine di un percorso minimizzando la distanza totale.
 */
class OptimizeRouteAction
{
    public function __construct(
        private readonly CalculateDistanceAction $calculateDistance,
    ) {
    }

    /**
     * Ottimizza l'ordine dei punti minimizzando la distanza totale.
     *
     * @param Collection<int, LocationData> $locations
     *
     * @return Collection<int, LocationData>
     */
    public function execute(Collection $locations): Collection
    {
        if ($locations->count() <= 2) {
            return $locations;
        }

        /** @var LocationData $firstLocation */
        $firstLocation = $locations->first();
        $optimizedLocations = collect([$firstLocation]);
        $remainingLocations = $locations->slice(1);

        while ($remainingLocations->isNotEmpty()) {
            /** @var LocationData $currentLocation */
            $currentLocation = $optimizedLocations->last();
            $nearestLocation = $this->findNearestLocation($currentLocation, $remainingLocations);

            if (null === $nearestLocation) {
                break;
            }

            $optimizedLocations->push($nearestLocation);
            $remainingLocations = $remainingLocations->reject(fn (LocationData $location) => $location === $nearestLocation);
        }

        return $optimizedLocations;
    }

    /**
     * Trova il punto più vicino a quello corrente.
     *
     * @param Collection<int, LocationData> $locations
     */
    private function findNearestLocation(LocationData $currentLocation, Collection $locations): ?LocationData
    {
        $nearestLocation = null;
        $shortestDistance = PHP_FLOAT_MAX;

        foreach ($locations as $location) {
<<<<<<< HEAD
            $distance = $this->calculateDistance->execute(
=======
            $distanceResult = $this->calculateDistance->execute(
>>>>>>> 3c5e1ea (.)
                origin: $currentLocation,
                destination: $location
            );

<<<<<<< HEAD
            if (is_numeric($distance) && $distance < $shortestDistance) {
=======
            // Estrai il valore numerico della distanza
            $distance = (float) ($distanceResult['distance']['value'] ?? PHP_FLOAT_MAX);

            if ($distance < $shortestDistance) {
>>>>>>> 3c5e1ea (.)
                $shortestDistance = $distance;
                $nearestLocation = $location;
            }
        }

        return $nearestLocation;
    }
}
