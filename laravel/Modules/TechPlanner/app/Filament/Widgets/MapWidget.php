<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Widgets;

use Filament\Widgets\Widget;

class MapWidget extends Widget
{
    protected static string $view = 'techplanner::filament.widgets.map';

    // Optional: Widget configuration
    protected int|string|array $columnSpan = 'full';

    /**
     * Pass data to the widget view.
     */
    protected function getViewData(): array
    {
        return [
            'locations' => $this->getLocations(),
        ];
    }

    /**
     * Get locations for the map.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function getLocations(): array
    {
        // Implement your location fetching logic here
        return [];
    }
}
