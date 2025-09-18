<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

class LegalOfficesRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'legalOffices';

    protected static null|string $recordTitleAttribute = 'name';

    protected static string $resource = LegalOfficeResource::class;

    #[\Override]
    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->required()->maxLength(100),
            Forms\Components\TextInput::make('street_address')->maxLength(100),
            Forms\Components\TextInput::make('street_number')->maxLength(10),
            Forms\Components\TextInput::make('city')->maxLength(100),
            Forms\Components\TextInput::make('province')->maxLength(2),
            Forms\Components\TextInput::make('postal_code')->maxLength(5),
            Forms\Components\TextInput::make('phone')->tel()->maxLength(20),
            Forms\Components\TextInput::make('fax')->maxLength(20),
            Forms\Components\TextInput::make('email')->email()->maxLength(255),
            Forms\Components\Textarea::make('notes')->maxLength(65535),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('city')->searchable(),
                Tables\Columns\TextColumn::make('province')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
            ])
            ->filters([])
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
