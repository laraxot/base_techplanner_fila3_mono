<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Widgets;

use Modules\Xot\Filament\Widgets\XotBaseWidget;

class LatLngWidget extends XotBaseWidget
{
    protected static string $view = 'geo::filament.widgets.lat-lng';

    public float $lat = 0;

    public float $lng = 0;

    public ?string $err_message = null;

    /**
     * Get the form schema for the widget.
     *
     * @return array<int|string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [];
    }

    public function mount(): void
    {
        $err_message = null;
    }
}
