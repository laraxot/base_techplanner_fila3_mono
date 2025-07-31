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
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 0e7ec50 (.)
    protected static string $view = 'geo::filament.widgets.location-map-widget';

    protected function getView(): string
    {
        return static::$view;
    }

<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var array<string, mixed> $config */
        $config = Config::get('maps', []);

        return [
            'zoom' => is_numeric($config['zoom'] ?? null) ? (int) $config['zoom'] : 12,
            'center' => $this->getMapCenter(),
            'mapTypeId' => is_string($config['type'] ?? null) ? $config['type'] : 'roadmap',
=======
=======
>>>>>>> 0e7ec50 (.)
        $config = Config::get('maps', []);

        return [
            'zoom' => (int) ($config['zoom'] ?? 12),
            'center' => $this->getMapCenter(),
            'mapTypeId' => (string) ($config['type'] ?? 'roadmap'),
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
        /** @var array<string, mixed> $config */
        $config = Config::get('maps', []);

        return [
            'zoom' => is_numeric($config['zoom'] ?? null) ? (int) $config['zoom'] : 12,
            'center' => $this->getMapCenter(),
            'mapTypeId' => is_string($config['type'] ?? null) ? $config['type'] : 'roadmap',
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
        return Place::with(['placeType'])->get();
=======
        return Place::with(['placeType', 'type'])->get();
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        return Place::with(['placeType', 'type'])->get();
=======
        return Place::with(['placeType'])->get();
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
        return Place::with(['placeType'])->get();
>>>>>>> 6f0eea5 (.)
    }

    /**
     * Restituisce i marker da visualizzare sulla mappa.
     *
     * @return array<int, array{
     *     position: array{lat: float, lng: float},
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 0e7ec50 (.)
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
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
     *     title: string,
     *     icon?: array{url: string, scaledSize: array{width: int, height: int}}
     * }>
     */
    public function getMarkers(): array
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
=======
>>>>>>> 0e7ec50 (.)
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
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
    }

    /**
     * Restituisce il centro della mappa.
     *
     * @return array{lat: float, lng: float}
     */
    protected function getMapCenter(): array
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var array<string, mixed> $config */
=======
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
        /** @var array<string, mixed> $config */
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
        /** @var array<string, mixed> $config */
>>>>>>> 6f0eea5 (.)
        $config = Config::get('maps', []);
        $defaultLat = 45.4642;
        $defaultLng = 9.1900;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var array<string, mixed>|null $centerConfig */
        $centerConfig = $config['center'] ?? null;

        return [
            'lat' => is_array($centerConfig) && is_numeric($centerConfig['lat'] ?? null) 
                ? (float) $centerConfig['lat'] 
                : $defaultLat,
            'lng' => is_array($centerConfig) && is_numeric($centerConfig['lng'] ?? null) 
                ? (float) $centerConfig['lng'] 
                : $defaultLng,
=======
        return [
            'lat' => (float) ($config['center']['lat'] ?? $defaultLat),
            'lng' => (float) ($config['center']['lng'] ?? $defaultLng),
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        return [
            'lat' => (float) ($config['center']['lat'] ?? $defaultLat),
            'lng' => (float) ($config['center']['lng'] ?? $defaultLng),
=======
=======
>>>>>>> 6f0eea5 (.)
        /** @var array<string, mixed>|null $centerConfig */
        $centerConfig = $config['center'] ?? null;

        return [
            'lat' => is_array($centerConfig) && is_numeric($centerConfig['lat'] ?? null) 
                ? (float) $centerConfig['lat'] 
                : $defaultLat,
            'lng' => is_array($centerConfig) && is_numeric($centerConfig['lng'] ?? null) 
                ? (float) $centerConfig['lng'] 
                : $defaultLng,
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
        ];
    }

    /**
     * Restituisce l'icona per un marker.
     *
     * @return array{url: string, scaledSize: array{width: int, height: int}}|null
     */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
    /**
     * @return array{url: string, scaledSize: array{width: int, height: int}}|null
     */
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
    /**
     * @return array{url: string, scaledSize: array{width: int, height: int}}|null
     */
=======
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
=======
>>>>>>> 0e7ec50 (.)
        if (! $placeType) {
            return null;
        }

        /** @var string $slug */
        $slug = $placeType->slug;

        if (! isset($config['icons'][$slug])) {
<<<<<<< HEAD
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
=======
=======
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
            return null;
        }

        /** @var array{url: string, size: array{int, int}} $icon */
        $icon = $config['icons'][$slug];

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        if (!isset($icon['url']) || !is_string($icon['url'])) {
=======
        if (! isset($icon['url']) || ! is_string($icon['url'])) {
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        if (! isset($icon['url']) || ! is_string($icon['url'])) {
=======
        if (!isset($icon['url']) || !is_string($icon['url'])) {
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
        if (!isset($icon['url']) || !is_string($icon['url'])) {
>>>>>>> 6f0eea5 (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
        /** @var view-string $viewName */
        $viewName = 'geo::filament.widgets.location-map-widget';
        
        return ViewFacade::make($viewName, $this->getViewData());
=======
        return ViewFacade::make($this->getView(), $this->getViewData());
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
        return ViewFacade::make($this->getView(), $this->getViewData());
=======
=======
>>>>>>> 6f0eea5 (.)
        /** @var view-string $viewName */
        $viewName = 'geo::filament.widgets.location-map-widget';
        
        return ViewFacade::make($viewName, $this->getViewData());
<<<<<<< HEAD
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
    }
}
