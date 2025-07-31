<?php

declare(strict_types=1);

namespace Modules\Geo\Datas;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

/**
 * DTO per i dati di un percorso ottimizzato.
 */
class RouteData extends Data
{
    /**
     * @param Collection<LocationData> $waypoints         Punti del percorso ottimizzato
     * @param Collection<LocationData> $originalWaypoints Punti del percorso originale
     * @param array<array{
     *     distance: array{value: int, text: string},
     *     duration: array{value: int, text: string},
     *     instructions: string
     * }> $steps
     */
    public function __construct(
        public readonly Collection $waypoints,
        public readonly Collection $originalWaypoints,
        public readonly int $totalDistance,
        public readonly int $totalDuration,
        public readonly array $steps,
    ) {
    }

    /**
     * Formatta la distanza totale in un formato leggibile.
     */
    public function getFormattedDistance(): string
    {
        if ($this->totalDistance < 1000) {
            return sprintf('%d m', $this->totalDistance);
        }

        return sprintf('%.1f km', $this->totalDistance / 1000);
    }

    /**
     * Formatta la durata totale in un formato leggibile.
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->totalDuration / 3600);
        $minutes = floor(($this->totalDuration % 3600) / 60);

        if ($hours > 0) {
            return sprintf('%d ore %d min', $hours, $minutes);
        }

        return sprintf('%d min', $minutes);
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    /*
     * Verifica se il percorso è stato ottimizzato.
     
=======
    /**
     * Verifica se il percorso è stato ottimizzato.
     */
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
    /**
     * Verifica se il percorso è stato ottimizzato.
     */
=======
    /*
     * Verifica se il percorso è stato ottimizzato.
     
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
    /*
     * Verifica se il percorso è stato ottimizzato.
     
>>>>>>> 6f0eea5 (.)
    public function isOptimized(): bool
    {
        return ! $this->waypoints->isEmpty() && ! $this->originalWaypoints->isEmpty()
            && $this->waypoints->count() === $this->originalWaypoints->count()
            && ! $this->waypoints->zip($this->originalWaypoints)->every(
                fn (array $pair): bool => $pair[0]->equals($pair[1])
            );
    }
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    */
=======

>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======

=======
    */
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
    */
>>>>>>> 6f0eea5 (.)
    /**
     * Ottiene un riepilogo del percorso.
     *
     * @return array{
     *     distance: string,
     *     duration: string,
     *     steps: int,
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
     *     waypoints: int
=======
     *     waypoints: int,
     *     optimized: bool
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
     *     waypoints: int,
     *     optimized: bool
=======
     *     waypoints: int
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
     *     waypoints: int
>>>>>>> 6f0eea5 (.)
     * }
     */
    public function getSummary(): array
    {
        return [
            'distance' => $this->getFormattedDistance(),
            'duration' => $this->getFormattedDuration(),
            'steps' => count($this->steps),
            'waypoints' => $this->waypoints->count(),
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            //'optimized' => $this->isOptimized(),
=======
            'optimized' => $this->isOptimized(),
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
            'optimized' => $this->isOptimized(),
=======
            //'optimized' => $this->isOptimized(),
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
            //'optimized' => $this->isOptimized(),
>>>>>>> 6f0eea5 (.)
        ];
    }

    public function validateRouteData(Collection $routeData): bool
    {
        return $routeData->every(fn (array $data): bool => isset($data['key']));
    }
}
