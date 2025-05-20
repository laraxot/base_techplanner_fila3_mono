<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;

trait HasTableFunctionsTrait
{
    /**
     * Get the table columns for the list view.
     *
     * @return array<string, \Filament\Tables\Columns\Column>
     */
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id'),
            'name' => TextColumn::make('name'),
            'created_at' => TextColumn::make('created_at')
                ->dateTime(),
            'updated_at' => TextColumn::make('updated_at')
                ->dateTime(),
        ];
    }

    /**
     * Get the table actions.
     *
     * @return array<string, \Filament\Tables\Actions\Action>
     */
    public function getTableActions(): array
    {
        return [
            'edit' => Action::make('edit')
                ->label('Modifica')
                ->url(fn ($record): string => route('filament.resources.' . $this->getResourceSlug() . '.edit', ['record' => $record])),
            'delete' => Action::make('delete')
                ->label('Elimina')
                ->action(fn ($record) => $record->delete())
                ->requiresConfirmation(),
        ];
    }

    /**
     * Get the table bulk actions.
     *
     * @return array<string, \Filament\Tables\Actions\BulkAction>
     */
    public function getTableBulkActions(): array
    {
        return [
            'delete' => BulkAction::make('delete')
                ->label('Elimina selezionati')
                ->action(fn ($records) => $records->each->delete())
                ->requiresConfirmation(),
        ];
    }

    /**
     * Get the resource slug.
     *
     * @return string
     */
    protected function getResourceSlug(): string
    {
        // Questa funzione dovrebbe essere sovrascritta nelle classi che utilizzano il trait
        return 'default';
    }
}
