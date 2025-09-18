<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource;

class LegalRepresentativesRelationManager extends RelationManager
{
    protected static string $relationship = 'legalRepresentatives';

    protected static null|string $recordTitleAttribute = 'full_name';

    protected static string $resource = LegalRepresentativeResource::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('first_name')->required()->maxLength(100),
            Forms\Components\TextInput::make('last_name')->required()->maxLength(100),
            Forms\Components\TextInput::make('fiscal_code')->maxLength(16),
            Forms\Components\TextInput::make('phone')->tel()->maxLength(20),
            Forms\Components\TextInput::make('mobile')->tel()->maxLength(20),
            Forms\Components\TextInput::make('email')->email()->maxLength(255),
            Forms\Components\Toggle::make('is_inactive')->default(false),
            Forms\Components\Textarea::make('notes')->maxLength(65535),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->searchable(['first_name', 'last_name']),
                Tables\Columns\IconColumn::make('is_inactive')->boolean(),
                Tables\Columns\TextColumn::make('fiscal_code')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_inactive'),
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
