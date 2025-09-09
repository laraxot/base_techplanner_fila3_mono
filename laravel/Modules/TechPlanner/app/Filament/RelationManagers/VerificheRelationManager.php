<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\RelationManagers;

use Filament\Tables;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

class VerificheRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'verifiche';

    protected static ?string $recordTitleAttribute = 'data_verifica';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('data_verifica')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('esito'),
                Tables\Columns\TextColumn::make('note'),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
