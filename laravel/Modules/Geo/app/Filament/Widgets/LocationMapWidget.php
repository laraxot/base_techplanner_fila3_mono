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
<<<<<<< HEAD
    protected static string $view = 'geo::filament.widgets.location-map-widget';

    protected function getView(): string
    {
        return static::$view;
    }

=======
>>>>>>> 3c5e1ea (.)
    protected int|string|array $columnSpan = 'full';

    public Htmlable|string|null $heading = 'Mappa';

    protected const CACHE_TTL = 3600;

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
<<<<<<< HEAD
        $config = Config::get('maps', []);

        return [
            'zoom' => (int) ($config['zoom'] ?? 12),
            'center' => $this->getMapCenter(),
            'mapTypeId' => (string) ($config['type'] ?? 'roadmap'),
=======
        /** @var array<string, mixed> $config */
        $config = Config::get('maps', []);

        return [
            'zoom' => is_numeric($config['zoom'] ?? null) ? (int) $config['zoom'] : 12,
            'center' => $this->getMapCenter(),
            'mapTypeId' => is_string($config['type'] ?? null) ? $config['type'] : 'roadmap',
>>>>>>> 3c5e1ea (.)
            'mapTypeControl' => true,
            'streetViewControl' => true,
            'fullscreenControl' => true,
            'zoomControl' => true,
            'styles' => [],
        ];
    }

    /**
     * Restituisce i luoghi da visualizzare sulla mappa.
     *
     * @return Collection<int, Place>
     */
    /** @return Collection<int, Place> */
    /**
     * @return Collection<int, Place>
     */
    public function getPlaces(): Collection
    {
        /* @var Collection<int, Place> */
<<<<<<< HEAD
        return Place::with(['placeType', 'type'])->get();
=======
        return Place::with(['placeType'])->get();
>>>>>>> 3c5e1ea (.)
    }

    /**
     * Restituisce i marker da visualizzare sulla mappa.
     *
     * @return array<int, array{
     *     position: array{lat: float, lng: float},
<<<<<<< HEAD
     *     title?: string,
     *     icon?: array{
     *         url: string,
     *         scaledSize: array{width: int, height: int}
     *     }
     * }>
     */
    /**
     * @return array<int, array{
     *     position: array{lat: float, lng: float},
=======
>>>>>>> 3c5e1ea (.)
     *     title: string,
     *     icon?: array{url: string, scaledSize: array{width: int, height: int}}
     * }>
     */
    public function getMarkers(): array
    {
<<<<<<< HEAD
        /* @var array<int, array{
         *     position: array{lat: float, lng: float},
         *     title: string,
         *     icon?: array{url: string, scaledSize: array{width: int, height: int}}
         * }> */
        return $this->getPlaces()->map(function (Place $place): array {
            return [
                'position' => [
                    'lat' => (float) $place->latitude,
                    'lng' => (float) $place->longitude,
                ],
                'title' => (string) ($place->name ?? 'Unnamed Place'),
                'icon' => $this->getMarkerIcon($place),
            ];
        })->all();
=======
        return $this->getPlaces()
            ->filter(fn(Place $place) => $place->latitude !== null && $place->longitude !== null)
            ->map(function (Place $place): array {
                $marker = [
                    'position' => [
                        'lat' => (float) $place->latitude,
                        'lng' => (float) $place->longitude,
                    ],
                    'title' => (string) ($place->name ?? 'Unnamed Place'),
                ];

                $icon = $this->getMarkerIcon($place);
                if ($icon !== null) {
                    $marker['icon'] = $icon;
                }

                return $marker;
            })->all();
>>>>>>> 3c5e1ea (.)
    }

    /**
     * Restituisce il centro della mappa.
     *
     * @return array{lat: float, lng: float}
     */
    protected function getMapCenter(): array
    {
<<<<<<< HEAD
=======
        /** @var array<string, mixed> $config */
>>>>>>> 3c5e1ea (.)
        $config = Config::get('maps', []);
        $defaultLat = 45.4642;
        $defaultLng = 9.1900;

<<<<<<< HEAD
        return [
            'lat' => (float) ($config['center']['lat'] ?? $defaultLat),
            'lng' => (float) ($config['center']['lng'] ?? $defaultLng),
=======
        /** @var array<string, mixed>|null $centerConfig */
        $centerConfig = $config['center'] ?? null;

        return [
            'lat' => is_array($centerConfig) && is_numeric($centerConfig['lat'] ?? null) 
                ? (float) $centerConfig['lat'] 
                : $defaultLat,
            'lng' => is_array($centerConfig) && is_numeric($centerConfig['lng'] ?? null) 
                ? (float) $centerConfig['lng'] 
                : $defaultLng,
>>>>>>> 3c5e1ea (.)
        ];
    }

    /**
     * Restituisce l'icona per un marker.
     *
     * @return array{url: string, scaledSize: array{width: int, height: int}}|null
     */
<<<<<<< HEAD
    /**
     * @return array{url: string, scaledSize: array{width: int, height: int}}|null
     */
=======
>>>>>>> 3c5e1ea (.)
    protected function getMarkerIcon(Place $place): ?array
    {
        /** @var array{
         *     icons?: array<string, array{
         *         url: string,
         *         size: array{int, int}
         *     }>
         * } $config */
        $config = Config::get('maps.markers', []);

        $placeType = $place->placeType;
<<<<<<< HEAD
        if (! $placeType) {
            return null;
        }

        /** @var string $slug */
        $slug = $placeType->slug;

        if (! isset($config['icons'][$slug])) {
=======
        if (!$placeType) {
            return null;
        }

        // Verifico che la proprietà slug esista sul placeType
        if (!property_exists($placeType, 'slug')) {
            return null;
        }

        /** @var string|null $slug */
        $slug = $placeType->slug;

        if (!is_string($slug) || !isset($config['icons'][$slug])) {
>>>>>>> 3c5e1ea (.)
            return null;
        }

        /** @var array{url: string, size: array{int, int}} $icon */
        $icon = $config['icons'][$slug];

<<<<<<< HEAD
        if (! isset($icon['url']) || ! is_string($icon['url'])) {
=======
        if (!isset($icon['url']) || !is_string($icon['url'])) {
>>>>>>> 3c5e1ea (.)
            return null;
        }

        return [
            'url' => asset($icon['url']),
            'scaledSize' => [
                'width' => (int) ($icon['size'][0] ?? 32),
                'height' => (int) ($icon['size'][1] ?? 32),
            ],
        ];
    }

    public function render(): View
    {
<<<<<<< HEAD
        return ViewFacade::make($this->getView(), $this->getViewData());
=======
        /** @var view-string $viewName */
        $viewName = 'geo::filament.widgets.location-map-widget';
        
        return ViewFacade::make($viewName, $this->getViewData());
>>>>>>> 3c5e1ea (.)
    }
}
