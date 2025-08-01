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
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Webmozart\Assert\Assert;

/**
 * @property ClientResource $resource
 */
class ListClients extends XotBaseListRecords
{
    protected static string $resource = ClientResource::class;

    public ?int $selectedClientId = null;
    protected ?\Illuminate\Database\Eloquent\Builder $tableQuery = null;

    /**
     * Configura i widget dell'header della pagina.
     */
    protected function getHeaderWidgets(): array
    {
        return [
            // \Modules\TechPlanner\Filament\Widgets\ClientMapWidget::class, //WIP 
        ];
    }

    /**
     * Summary of getListTableColumns.
     */
    public function getTableColumns(): array
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

        return $columns;
    }

    public function getTableFilters(): array
    {
        $activities = static::getModel()::query()
            ->whereNotNull('activity')
            ->distinct()
            ->pluck('activity', 'activity')
            ->map(function ($value) {
                return app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($value);
            })
            ->toArray();

        /** @var array<string, string> $activities */

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

    public function getTableBulkActions(): array
    {
        return [
            'updateCoordinates' => BulkAction::make('updateCoordinates')
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
                            ->execute($client->full_address ?? '');

                        if ($addressData) {
                            $client->update($addressData->toArray());
                            ++$totalSuccess;
                        }
                    } catch (\Throwable $e) {
                        $clientName = $client->company_name ?? $client->name ?? 'Unknown';
                        $errors[] = "Error updating {$clientName}: {$e->getMessage()}";
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

    /**
     * @return array<int|string, \Filament\Tables\Actions\Action|\Filament\Tables\Actions\ActionGroup>
     */
    public function getTableActions(): array
    {
        /** @var array<int|string, \Filament\Tables\Actions\Action|\Filament\Tables\Actions\ActionGroup> $actions */
        $actions = [
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
        
        return $actions;
    }

    public function applySort(mixed $field): void
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
        if($query==null){
            throw new \Exception('Query is null');
        }
        $latitude = Session::get('user_latitude');
        $longitude = Session::get('user_longitude');

        return $query
            ->when($latitude && $longitude,
                function (Builder $query) use ($latitude, $longitude) {
                    /** @phpstan-ignore-next-line */
                    $query->withDistance($latitude, $longitude)
                      ->orderByDistance($latitude, $longitude);
                }
            );
    }

}
