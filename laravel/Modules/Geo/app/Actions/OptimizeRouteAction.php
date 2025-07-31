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
<<<<<<< HEAD
<<<<<<< HEAD
            $distanceResult = $this->calculateDistance->execute(
=======
            $distance = $this->calculateDistance->execute(
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
            $distance = $this->calculateDistance->execute(
=======
            $distanceResult = $this->calculateDistance->execute(
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
            $distanceResult = $this->calculateDistance->execute(
>>>>>>> 6f0eea5 (.)
                origin: $currentLocation,
                destination: $location
            );

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            // Estrai il valore numerico della distanza
            $distance = (float) ($distanceResult['distance']['value'] ?? PHP_FLOAT_MAX);

            if ($distance < $shortestDistance) {
=======
            if (is_numeric($distance) && $distance < $shortestDistance) {
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
            if (is_numeric($distance) && $distance < $shortestDistance) {
=======
=======
>>>>>>> 6f0eea5 (.)
            // Estrai il valore numerico della distanza
            $distance = (float) ($distanceResult['distance']['value'] ?? PHP_FLOAT_MAX);

            if ($distance < $shortestDistance) {
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
                $shortestDistance = $distance;
                $nearestLocation = $location;
            }
        }

        return $nearestLocation;
    }
}
