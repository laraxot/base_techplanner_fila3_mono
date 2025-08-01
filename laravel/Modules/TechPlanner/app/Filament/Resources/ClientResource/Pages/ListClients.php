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

            'contacts' => TextColumn::make('contacts')
                ->label('Contatti')
                ->formatStateUsing(function ($record) {
                    return '!!'.$this->formatContacts($record);
                    
                })
                ->html()
                ->wrap()
                ->searchable(['phone', 'email', 'pec', 'whatsapp', 'mobile', 'fax'])
                ->sortable(false),

            'contacts1' => $this->getContactsColumn(),
        ];

        return $columns;
    }

    /**
     * Colonna contatti con icone per phone, email, pec, whatsapp.
     *
     * @return TextColumn
     */
    private function getContactsColumn(): TextColumn
    {
        return TextColumn::make('contatti')
            ->label('Contatti')
            ->html()
            ->formatStateUsing(function (Client $record): string {
                $contacts = [];
                
                // Telefono
                if ($record->phone) {
                    $contacts[] = '<a href="tel:' . $record->phone . '" class="inline-flex items-center text-blue-600 hover:text-blue-800 mr-2 mb-1" title="Telefono: ' . $record->phone . '">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        <span class="text-xs hidden sm:inline">' . $record->phone . '</span>
                    </a>';
                }
                
                // Email
                if ($record->email) {
                    $contacts[] = '<a href="mailto:' . $record->email . '" class="inline-flex items-center text-green-600 hover:text-green-800 mr-2 mb-1" title="Email: ' . $record->email . '">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <span class="text-xs hidden sm:inline">' . $record->email . '</span>
                    </a>';
                }
                
                // PEC
                if ($record->pec) {
                    $contacts[] = '<a href="mailto:' . $record->pec . '" class="inline-flex items-center text-purple-600 hover:text-purple-800 mr-2 mb-1" title="PEC: ' . $record->pec . '">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-xs hidden sm:inline">PEC</span>
                    </a>';
                }
                
                // WhatsApp
                if ($record->whatsapp) {
                    $cleanWhatsapp = preg_replace('/[^0-9]/', '', $record->whatsapp);
                    $contacts[] = '<a href="https://wa.me/' . $cleanWhatsapp . '" target="_blank" class="inline-flex items-center text-green-500 hover:text-green-700 mr-2 mb-1" title="WhatsApp: ' . $record->whatsapp . '">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                        <span class="text-xs hidden sm:inline">WA</span>
                    </a>';
                }
                
                if (empty($contacts)) {
                    return '<span class="text-gray-400 text-xs">Nessun contatto</span>';
                }
                
                return '<div class="flex flex-wrap">' . implode('', $contacts) . '</div>!';
            })
            ->searchable(['phone', 'email', 'pec', 'whatsapp'])
            ->sortable(false);
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

    

    /**
     * Formatta i contatti del cliente con icone appropriate.
     *
     * @param \Modules\TechPlanner\Models\Client $record
     * @return string
     */
    private function formatContacts(Client $record): string
    {
        $contacts = [];
        
        // Telefono
        if ($record->phone) {
            $contacts[] = '<i class="heroicon-o-phone text-blue-500 w-4 h-4 inline mr-1" title="Telefono"></i> ' . $record->phone;
        }
        
        // Cellulare
        if ($record->mobile) {
            $contacts[] = '<i class="heroicon-o-device-phone-mobile text-purple-500 w-4 h-4 inline mr-1" title="Cellulare"></i> ' . $record->mobile;
        }
        
        // Email
        if ($record->email) {
            $contacts[] = '<i class="heroicon-o-envelope text-green-500 w-4 h-4 inline mr-1" title="Email"></i> ' . $record->email;
        }
        
        // PEC
        if ($record->pec) {
            $contacts[] = '<i class="heroicon-o-shield-check text-orange-500 w-4 h-4 inline mr-1" title="PEC"></i> ' . $record->pec;
        }
        
        // WhatsApp
        if ($record->whatsapp) {
            $contacts[] = '<i class="fab fa-whatsapp text-green-600 w-4 h-4 inline mr-1" title="WhatsApp"></i> ' . $record->whatsapp;
        }
        
        // Fax
        if ($record->fax) {
            $contacts[] = '<i class="heroicon-o-printer text-gray-500 w-4 h-4 inline mr-1" title="Fax"></i> ' . $record->fax;
        }
        return 'OOOOOOOOOOOOOOOOOOOOOOOOOOOOO';
        return empty($contacts) 
            ? '<span class="text-gray-400">Nessun contatto</span>' 
            : implode('<br class="my-1">', $contacts);
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
