<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View as ViewFacade;
use Modules\Geo\Models\Place;
use Webbingbrasil\FilamentMaps\Widgets\MapWidget;

/**
 * Widget per visualizzare una mappa con una posizione.
 *
 * Questo widget estende MapWidget per mostrare una mappa interattiva
 * che può visualizzare una posizione specifica con un marker.
 * La mappa può essere configurata per mostrare diversi tipi di vista
 * (strada, satellite, ibrida) e può essere personalizzata con controlli
 * e stili specifici.
 */
class LocationMapWidget extends MapWidget
{
    protected static string $view = 'geo::filament.widgets.location-map-widget';

    protected int|string|array $columnSpan = 'full';

    public Htmlable|string|null $heading = 'Mappa';

    protected const CACHE_TTL = 3600;

    protected function getView(): string
    {
        return static::$view;
    }

    protected function getViewData(): array
    {
        return [
            'heading' => $this->heading,
            'maxHeight' => $this->getMaxHeight(),
            'options' => $this->getOptions(),
            'markers' => $this->getMarkers(),
        ];
    }

    /**
     * Restituisce l'altezza massima del widget.
     */
    protected function getMaxHeight(): ?string
    {
        return $this->maxHeight ?? '50vh';
    }

    /**
     * Restituisce le opzioni di configurazione della mappa.
     *
     * @return array<string, mixed>
     */
    protected function getOptions(): array
    {
        /** @var array<string, mixed> $config */
        $config = Config::get('maps', []);

        return [
            'zoom' => is_numeric($config['zoom'] ?? null) ? (int) $config['zoom'] : 12,
            'center' => $this->getMapCenter(),
            'mapTypeId' => is_string($config['type'] ?? null) ? $config['type'] : 'roadmap',
            'scrollwheel' => $config['scrollwheel'] ?? true,
            'streetViewControl' => $config['streetViewControl'] ?? true,
            'mapTypeControl' => $config['mapTypeControl'] ?? true,
            'fullscreenControl' => $config['fullscreenControl'] ?? true,
        ];
    }

    /**
     * Restituisce la collezione di luoghi da visualizzare sulla mappa.
     */
    public function getPlaces(): Collection
    {
        return Place::with(['address', 'placeType'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();
    }

    /**
     * Restituisce i marker da visualizzare sulla mappa.
     *
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
        $places = $this->getPlaces();

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

    /**
     * Restituisce il centro della mappa.
     *
     * @return array{lat: float, lng: float}
     */
    protected function getMapCenter(): array
    {
        $places = $this->getPlaces();

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
}
