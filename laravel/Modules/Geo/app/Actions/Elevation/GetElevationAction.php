<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\Elevation;

use Modules\Geo\Datas\LocationData;
use Modules\Geo\Exceptions\ElevationException;
use Modules\Geo\Services\GoogleMapsService;

/**
 * Classe per ottenere l'elevazione di un punto geografico.
 *
 * Questa classe utilizza il servizio Google Maps Elevation per ottenere:
 * - L'elevazione in metri sul livello del mare
 * - La risoluzione dell'elevazione
 *
 * @see https://developers.google.com/maps/documentation/elevation
 */
class GetElevationAction
{
    /**
     * @param GoogleMapsService $googleMapsService Servizio per le richieste a Google Maps
     */
    public function __construct(
        private readonly GoogleMapsService $googleMapsService,
    ) {
    }

    /**
     * Ottiene l'elevazione per una posizione geografica.
     *
     * @param LocationData $location La posizione di cui ottenere l'elevazione
     *
     * @throws ElevationException        Se il recupero dell'elevazione fallisce
     * @throws \InvalidArgumentException Se le coordinate non sono valide
     *
     * @return float L'elevazione in metri sul livello del mare
     */
    public function execute(LocationData $location): float
    {
        $this->validateCoordinates($location);

        try {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            /** @var array<string, mixed> $response */
=======
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
            /** @var array<string, mixed> $response */
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
            /** @var array<string, mixed> $response */
>>>>>>> 6f0eea5 (.)
            $response = $this->googleMapsService->getElevation(
                $location->latitude,
                $location->longitude
            );

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            if (!isset($response['results']) || !is_array($response['results']) || empty($response['results'])) {
                throw ElevationException::invalidResponse();
            }

            $firstResult = $response['results'][0] ?? null;
            if (!is_array($firstResult) || !isset($firstResult['elevation'])) {
                throw ElevationException::invalidResponse();
            }

            return (float) $firstResult['elevation'];
=======
=======
>>>>>>> 0e7ec50 (.)
            if (empty($response['results']) || ! isset($response['results'][0]['elevation'])) {
                throw ElevationException::invalidResponse();
            }

            return (float) $response['results'][0]['elevation'];
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
            if (!isset($response['results']) || !is_array($response['results']) || empty($response['results'])) {
                throw ElevationException::invalidResponse();
            }

            $firstResult = $response['results'][0] ?? null;
            if (!is_array($firstResult) || !isset($firstResult['elevation'])) {
                throw ElevationException::invalidResponse();
            }

<<<<<<< HEAD
<<<<<<< HEAD
            return (float) $firstResult['elevation'];
>>>>>>> 3c5e1ea (.)
<<<<<<< HEAD
>>>>>>> 0e7ec50 (.)
=======
=======
            $elevation = $firstResult['elevation'];
            return is_numeric($elevation) ? (float) $elevation : 0.0;
>>>>>>> 0119f2f (.)
>>>>>>> c14279a (.)
=======
            $elevation = $firstResult['elevation'];
            return is_numeric($elevation) ? (float) $elevation : 0.0;
>>>>>>> 6f0eea5 (.)
        } catch (\Throwable $e) {
            if ($e instanceof ElevationException) {
                throw $e;
            }

            throw ElevationException::serviceError('Errore nel recupero dell\'elevazione: '.$e->getMessage(), $e);
        }
    }

    /**
     * Formatta l'elevazione in una stringa leggibile.
     *
     * @param float $meters Elevazione in metri
     *
     * @return string Elevazione formattata con unità di misura
     */
    public function formatElevation(float $meters): string
    {
        return sprintf('%.1f m s.l.m.', $meters);
    }

    /**
     * Valida le coordinate di una posizione.
     *
     * @param LocationData $location Posizione da validare
     *
     * @throws \InvalidArgumentException Se le coordinate non sono valide
     */
    private function validateCoordinates(LocationData $location): void
    {
        if ($location->latitude < -90 || $location->latitude > 90) {
            throw new \InvalidArgumentException(sprintf('Latitudine non valida: %f', $location->latitude));
        }

        if ($location->longitude < -180 || $location->longitude > 180) {
            throw new \InvalidArgumentException(sprintf('Longitudine non valida: %f', $location->longitude));
        }
    }
}
