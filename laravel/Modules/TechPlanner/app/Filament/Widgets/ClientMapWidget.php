<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Widgets;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Reactive;
use Modules\TechPlanner\Filament\Resources\ClientResource;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

#[Reactive]
class ClientMapWidget extends XotBaseWidget
{
    protected static string $view = 'techplanner::filament.widgets.map';

    protected int|string|array $columnSpan = 'full';

    /**
     * Get the form schema for the widget.
     *
     * @return array<int|string, \Filament\Forms\Components\Component>
     */
    #[\Override]
    public function getFormSchema(): array
    {
        return [];
    }

    /**
     * Ottiene i dati dei clienti per la mappa.
     */
    protected function getData(): array
    {
        return [
            'clients' => $this->getClientsQuery()->get(['latitude', 'longitude', 'name'])->toArray(),
        ];
    }

    /**
     * Ottiene la query per i clienti.
     */
    protected function getClientsQuery(): Builder
    {
        return ClientResource::getEloquentQuery();
    }

    public function render(): View
    {
        return view(static::$view, $this->getData());
    }
}
