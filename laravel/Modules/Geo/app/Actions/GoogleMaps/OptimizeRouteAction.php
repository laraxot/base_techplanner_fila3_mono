<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\GoogleMaps;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Modules\Geo\Datas\LocationData;
use Modules\Geo\Datas\RouteData;

/**
 * Action per ottimizzare un percorso utilizzando l'API di Google Maps.
 *
 * Questa action prende una lista di punti di partenza e destinazione e
 * restituisce il percorso ottimizzato che minimizza la distanza totale
 * o il tempo di percorrenza.
 */
class OptimizeRouteAction
{
    /**
     * Ottimizza il percorso tra i punti specificati.
     *
     * @param LocationData[] $locations   Lista di punti da visitare
     * @param LocationData   $origin      Punto di partenza
     * @param LocationData   $destination Punto di arrivo
     * @param string         $mode        Modalità di trasporto (driving, walking, bicycling, transit)
     * @param string         $optimize    Criterio di ottimizzazione (distance, time)
     *
     * @return RouteData[] Lista di percorsi ottimizzati
     */
    public function execute(
        array $locations,
        LocationData $origin,
        LocationData $destination,
        string $mode = 'driving',
        string $optimize = 'distance',
    ): array {
        if (empty($locations)) {
            return [];
        }

        $apiKey = config('services.google.maps.key');
        if (!$apiKey) {
            throw new \RuntimeException('Google Maps API key not found');
        }

        $waypoints = $this->formatWaypoints($locations);
        $response = Http::get('https://maps.googleapis.com/maps/api/directions/json', [
            'origin' => $this->formatLocation($origin),
            'destination' => $this->formatLocation($destination),
            'waypoints' => 'optimize:true|'.implode('|', $waypoints),
            'mode' => $mode,
            'optimize' => $optimize,
            'key' => $apiKey,
        ]);

        if (!$response->successful()) {
            throw new \RuntimeException('Failed to get directions from Google Maps API');
        }

        /** @var array{routes?: array<int, array{legs: array<int, array{distance: array{text: string, value: int}, duration: array{text: string, value: int}, start_location: array{lat: float, lng: float}, end_location: array{lat: float, lng: float}, steps: array<int, array{distance: array{text: string, value: int}, duration: array{text: string, value: int}, start_location: array{lat: float, lng: float}, end_location: array{lat: float, lng: float}, html_instructions: string, travel_mode: string}>}>, overview_polyline: array{points: string}, summary: string, warnings: array<int, string>, waypoint_order: array<int, int>}>} $data */
        $data = $response->json();
        if (!isset($data['routes'][0])) {
            return [];
        }

        return $this->parseRoutes($data['routes'], collect($locations));
    }

    /**
     * Formatta una lista di punti nel formato richiesto dall'API.
     *
     * @param LocationData[] $locations
     *
     * @return string[]
     */
    private function formatWaypoints(array $locations): array
    {
        return collect($locations)
            ->map(
                function (LocationData $location): string {
                    return $this->formatLocation($location);
                }
            )
            ->all();
    }

    /**
     * Formatta una singola posizione nel formato richiesto dall'API.
     */
    private function formatLocation(LocationData $location): string
    {
        return sprintf('%f,%f', $location->latitude, $location->longitude);
    }

    /**
     * Analizza la risposta dell'API e restituisce i percorsi ottimizzati.
     *
     * @param array<int, array{
     *     legs: array<int, array{
     *         distance: array{text: string, value: int},
     *         duration: array{text: string, value: int},
     *         start_location: array{lat: float, lng: float},
     *         end_location: array{lat: float, lng: float},
     *         steps: array<int, array{
     *             distance: array{text: string, value: int},
     *             duration: array{text: string, value: int},
     *             start_location: array{lat: float, lng: float},
     *             end_location: array{lat: float, lng: float},
     *             html_instructions: string,
     *             travel_mode: string
     *         }>
     *     }>,
     *     overview_polyline: array{points: string},
     *     summary: string,
     *     warnings: array<int, string>,
     *     waypoint_order: array<int, int>
     * }> $routes
     * @param Collection<int, LocationData> $originalLocations
     *
     * @return RouteData[]
     */
    private function parseRoutes(array $routes, Collection $originalLocations): array
    {
        return collect($routes)->map(function (array $route) use ($originalLocations): RouteData {
            $legs = $route['legs'] ?? [];
            $waypointOrder = $route['waypoint_order'] ?? [];

            // Riorganizza le location secondo l'ordine ottimizzato
            $optimizedLocations = $this->reorderLocations($originalLocations, $waypointOrder);

            // Calcola le statistiche totali
            $totalDistance = collect($legs)->sum(fn (array $leg) => $leg['distance']['value'] ?? 0);
            $totalDuration = collect($legs)->sum(fn (array $leg) => $leg['duration']['value'] ?? 0);

            // Estrae i passi del percorso
            $steps = collect($legs)->flatMap(function (array $leg): array {
                return $leg['steps'] ?? [];
            })->all();

            return new RouteData(
                waypoints: $optimizedLocations,
                originalWaypoints: $originalLocations,
                totalDistance: $totalDistance,
                totalDuration: $totalDuration,
                steps: $steps,
            );
        })->all();
    }

    /**
     * Riorganizza le location secondo l'ordine ottimizzato.
     *
     * @param Collection<int, LocationData> $locations
     * @param array<int, int> $waypointOrder
     *
     * @return Collection<int, LocationData>
     */
    private function reorderLocations(Collection $locations, array $waypointOrder): Collection
    {
        if (empty($waypointOrder)) {
            return $locations;
        }

        $reordered = collect();
        foreach ($waypointOrder as $index) {
            if ($locations->has($index)) {
                $reordered->push($locations->get($index));
            }
        }

        return $reordered;
    }
}
