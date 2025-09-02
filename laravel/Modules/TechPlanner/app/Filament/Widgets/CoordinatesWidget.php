<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Widgets;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

class CoordinatesWidget extends XotBaseWidget
{
    protected static string $view = 'techplanner::filament.widgets.coordinates-widget';

    public float $latitude = 0;

    public float $longitude = 0;

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
        $this->latitude = app(\Modules\Xot\Actions\Cast\SafeFloatCastAction::class)->execute(Session::get('user_latitude', Cookie::get('user_latitude', 0)));
        $this->longitude = app(\Modules\Xot\Actions\Cast\SafeFloatCastAction::class)->execute(Session::get('user_longitude', Cookie::get('user_longitude', 0)));
    }

    public function updateCoordinates(): void
    {
        Session::put('user_latitude', $this->latitude);
        Session::put('user_longitude', $this->longitude);

        Cookie::queue('user_latitude', $this->latitude, 60 * 24 * 30); // 30 days
        Cookie::queue('user_longitude', $this->longitude, 60 * 24 * 30);

        $this->dispatch('coordinates-updated');

        // Ordina la tabella per distanza
        $this->dispatch('sort-by-distance')->to('filament.techplanner::admin.resources.clients.index');

        Notification::make()
            ->success()
            ->title('Coordinate aggiornate')
            ->body('La tabella è stata ordinata in base alla distanza dalle coordinate impostate')
            ->send();
    }

    #[On('coordinates-updated')]
    public function refreshCoordinates(): void
    {
        $this->latitude = app(\Modules\Xot\Actions\Cast\SafeFloatCastAction::class)->execute(Session::get('user_latitude', Cookie::get('user_latitude', 0)));
        $this->longitude = app(\Modules\Xot\Actions\Cast\SafeFloatCastAction::class)->execute(Session::get('user_longitude', Cookie::get('user_longitude', 0)));
    }

}
