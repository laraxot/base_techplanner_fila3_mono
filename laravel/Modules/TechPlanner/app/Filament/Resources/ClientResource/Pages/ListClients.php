<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Modules\Geo\Actions\GetAddressDataFromFullAddressAction;
use Modules\TechPlanner\Filament\Imports\ClientImporter;
use Modules\TechPlanner\Filament\Resources\ClientResource;
use Modules\TechPlanner\Models\Client;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Webmozart\Assert\Assert;

/**
 * @property ClientResource $resource
 */
class ListClients extends XotBaseListRecords
{
    protected static string $resource = ClientResource::class;

    public ?int $selectedClientId = null;
    protected $tableQuery;

    /**
     * Configura i widget dell'header della pagina.
     */
    protected function getHeaderWidgets(): array
    {
        return [
            // \Modules\TechPlanner\Filament\Widgets\ClientMapWidget::class,
        ];
    }

    /**
     * Summary of getListTableColumns.
     */
    public function getListTableColumns(): array
    {
        $columns = [
            'distance' => TextColumn::make('distance')
                ->formatStateUsing(fn ($state) => number_format($state, 2).' km'),

            //...parent::getListTableColumns(),

            'longitude' => TextColumn::make('longitude')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            'latitude' => TextColumn::make('latitude')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            'business_closed' => TextColumn::make('business_closed')
                ->toggleable(isToggledHiddenByDefault: true),

            'activity' => TextColumn::make('activity')
                ->searchable()
                ->sortable()
                ->wrap(),

            'company_name' => TextColumn::make('company_name')
                ->searchable()
                ->sortable()
                ->wrap(),

            'fiscal_code' => TextColumn::make('fiscal_code')
                ->toggleable(isToggledHiddenByDefault: true),

            'full_address' => TextColumn::make('full_address')
                ->searchable(['city', 'company_office', 'postal_code', 'province', 'country', 'address'])
                ->sortable()
                ->wrap(),

            'city' => TextColumn::make('city')
                ->toggleable(isToggledHiddenByDefault: true),

            'province' => TextColumn::make('province')
                ->toggleable(isToggledHiddenByDefault: true),

            'country' => TextColumn::make('country')
                ->toggleable(isToggledHiddenByDefault: true),

            'phone' => TextColumn::make('phone')
                ->searchable()
                ->sortable(),

            'email' => TextColumn::make('email')
                ->searchable()
                ->sortable(),
        ];

        return array_filter($columns);
    }

<<<<<<< HEAD
    protected function getTableFilters(): array
=======
    public function getTableFilters(): array
>>>>>>> b32e314 (.)
    {
        $activities = static::getModel()::query()
            ->whereNotNull('activity')
            ->distinct()
            ->pluck('activity', 'activity')
            ->map(fn ($value) => (string) $value)
            ->toArray();

        return [
            ...parent::getTableFilters(),
            TernaryFilter::make('business_closed')
                ->default(false)
                ->label('Attività chiusa'),
            SelectFilter::make('activity')
                ->label('Tipo attività')
                ->multiple()
                ->preload()
                ->options($activities),
        ];
    }

    public function getHeaderActions(): array
    {
        return [
            ...parent::getHeaderActions(),
            Actions\ImportAction::make('importClient')
                ->importer(ClientImporter::class),
            Actions\Action::make('populateCoordinates')
                ->icon('heroicon-o-globe-alt')
                ->action(function () {
                    $this->populateAllCoordinates();
                })
                ->requiresConfirmation()
                ->modalHeading('Populate Coordinates')
                ->modalDescription('This will update coordinates for all clients based on their addresses. Continue?')
                ->modalSubmitActionLabel('Yes, Update All'),
        ];
    }

<<<<<<< HEAD
    protected function getTableBulkActions(): array
=======
    public function getTableBulkActions(): array
>>>>>>> b32e314 (.)
    {
        return [
            BulkAction::make('updateCoordinates')
                ->icon('heroicon-o-map-pin')
                ->action(function (Collection $records) {
                    $action = app(GetAddressDataFromFullAddressAction::class);
                    $successCount = 0;
                    $errorMessages = collect();

                    foreach ($records as $client) {
                        Assert::isInstanceOf($client, Client::class);
                        $addressData = $action->execute($client->full_address);

                        if ($addressData) {
                            $up = Arr::only($addressData->toArray(), ['latitude', 'longitude']);

                            $client->update($up);
                            ++$successCount;
                        } else {
                            $errorMessages->push("Errore per {$client->name}: ".$action->getErrors()->join(', '));
                        }
                    }

                    if ($successCount > 0) {
                        Notification::make()
                            ->success()
                            ->title('Indirizzi aggiornati')
                            ->body("Aggiornati i dati di {$successCount} clienti")
                            ->send();
                    }

                    if ($errorMessages->isNotEmpty()) {
                        Notification::make()
                            ->warning()
                            ->title('Alcuni aggiornamenti non sono riusciti')
                            ->body($errorMessages->join("\n"))
                            ->persistent()
                            ->send();
                    }
                })
                ->deselectRecordsAfterCompletion()
                ->label('Aggiorna indirizzi'),
        ];
    }

    private function populateAllCoordinates(): void
    {
        $batchSize = 50;
        $totalProcessed = 0;
        $totalSuccess = 0;
        $errors = [];

        static::getModel()::whereNull('latitude')
            ->orWhereNull('longitude')
            ->chunk($batchSize, function ($clients) use (&$totalProcessed, &$totalSuccess, &$errors) {
                foreach ($clients as $client) {
                    try {
                        $addressData = app(GetAddressDataFromFullAddressAction::class)
                            ->execute($client->full_address);

                        if ($addressData) {
                            $client->update($addressData->toArray());
                            ++$totalSuccess;
                        }
                    } catch (\Throwable $e) {
                        $errors[] = "Error updating {$client->company_name}: {$e->getMessage()}";
                    }
                    ++$totalProcessed;
                }
            });

        $message = "Processed {$totalProcessed} clients. Successfully updated {$totalSuccess} coordinates.";

        if (! empty($errors)) {
            Notification::make()
                ->warning()
                ->title('Coordinate Update Completed with Errors')
                ->body($message."\n\n".implode("\n", array_slice($errors, 0, 5)))
                ->persistent()
                ->send();
        } else {
            Notification::make()
                ->success()
                ->title('Coordinates Updated Successfully')
                ->body($message)
                ->send();
        }
    }

    // private function updateClientCoordinates($client): void
    // {
    //     // This method is now only used for single updates
    //     $addressData = app(GetAddressDataFromFullAddressAction::class)
    //         ->execute($client->full_address);

    //     if ($addressData) {
    //         $client->update($addressData->toArray());
    //     }
    // }

    public function getTableActions(): array
    {
        return [
            ...parent::getTableActions(),
            Action::make('sortByDistance')
                ->icon('heroicon-o-map')
                ->action(function ($record) {
                    if (! $record->latitude || ! $record->longitude) {
                        Notification::make()
                            ->warning()
                            ->title('Attenzione')
                            ->body('Il cliente selezionato non ha coordinate valide')
                            ->send();

                        return;
                    }

                    Session::put('user_latitude', $record->latitude);
                    Session::put('user_longitude', $record->longitude);

                    // Aggiorna i cookie per persistenza
                    Cookie::queue('user_latitude', $record->latitude, 60 * 24 * 30); // 30 giorni
                    Cookie::queue('user_longitude', $record->longitude, 60 * 24 * 30);

                    // Aggiorna il widget delle coordinate
                    $this->dispatch('coordinates-updated');

                    // Applica l'ordinamento per distanza
                    $this->applySort('distance');

                    Notification::make()
                        ->success()
                        ->title('Coordinate aggiornate')
                        ->body('La tabella è stata ordinata in base alla distanza dal cliente selezionato')
                        ->send();
                })
                ->label('Ordina per distanza'),
        ];
    }

    public function applySort($field): void
    {
        if ('distance' === $field) {
            $this->resetTable();
        }
    }

    #[On('sort-by-distance')]
    public function handleSortByDistance(): void
    {
        $this->applySort('distance');
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();
        $latitude = Session::get('user_latitude');
        $longitude = Session::get('user_longitude');

        return $query
            ->when($latitude && $longitude,
                function (Builder $query) use ($latitude, $longitude) {
                    $query->withDistance($latitude, $longitude)
                      ->orderByDistance($latitude, $longitude);
                }
            );
    }
}
