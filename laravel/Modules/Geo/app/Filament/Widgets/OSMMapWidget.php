<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Modules\Geo\Models\Place;
use Webbingbrasil\FilamentMaps\Widgets\MapWidget;

/**
 * Widget per visualizzare una mappa OpenStreetMap con le posizioni.
 */
class OSMMapWidget extends MapWidget
{
    protected static string $view = 'geo::filament.widgets.osm-map-widget';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        /** @var Collection<int, Place> $places */
        $places = Place::with(['address', 'placeType'])->get();

        return [
            'markers' => $this->getMarkers(),
            'center' => $this->getMapCenter($places),
            'zoom' => $this->getMapZoom($places),
        ];
    }

    /**
     * @return array<int, array{
     *     position: array{lat: float, lng: float},
     *     title: string,
     *     content: string,
     *     icon?: array{url: string, scaledSize: array{width: int, height: int}}
     * }>
     */
    public function getMarkers(): array
    {
        /** @var Collection<int, Place> $places */
        $places = Place::with(['address', 'placeType'])->get();

        return $places
            ->filter(fn(Place $place) => $place->latitude !== null && $place->longitude !== null)
            ->map(function (Place $place): array {
                $marker = [
                    'position' => [
                        'lat' => (float) $place->latitude,
                        'lng' => (float) $place->longitude,
                    ],
                    'title' => (string) ($place->name ?? 'Unnamed Place'),
                    'content' => $this->getInfoWindowContent($place),
                ];

                $icon = $this->getMarkerIcon($place);
                if ($icon !== null) {
                    $marker['icon'] = $icon;
                }

                return $marker;
            })->all();
    }

    /**
     * @param  Collection<int, Place>  $places
     */
    protected function getMapCenter(Collection $places): array
    {
        if ($places->isEmpty()) {
            return [
                'lat' => 41.9028,
                'lng' => 12.4964,
            ];
        }

        $avgLat = $places->avg('latitude');
        $avgLng = $places->avg('longitude');

        return [
            'lat' => (float) $avgLat,
            'lng' => (float) $avgLng,
        ];
    }

    /**
     * @param  Collection<int, Place>  $places
     */
    protected function getMapZoom(Collection $places): int
    {
        if ($places->count() <= 1) {
            return 10;
        }

        return 8;
    }

    /**
     * Genera il contenuto della finestra informativa per un luogo.
     */
    protected function getInfoWindowContent(Place $place): string
    {
        $content = "<div class='marker-info'>";
        $content .= "<h3>{$place->name}</h3>";

        if ($place->address) {
            $content .= "<p><strong>Indirizzo:</strong> {$place->address->formatted_address}</p>";
        }

        if ($place->placeType) {
            $content .= "<p><strong>Tipo:</strong> {$place->placeType->name}</p>";
        }

        $content .= "</div>";

        return $content;
    }

    /**
     * Ottiene l'icona del marker per un luogo.
     */
    protected function getMarkerIcon(Place $place): ?array
    {
        $type = $place->placeType->slug ?? 'default';
        $markerConfig = config("geo.markers.types.{$type}");

        if (!is_array($markerConfig)) {
            $markerConfig = config('geo.markers.types.default');
        }

        if (!is_array($markerConfig)) {
            return null;
        }

        return $markerConfig['icon'] ?? null;
    }
}
