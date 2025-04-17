<?php

namespace Modules\TechPlanner\Filament\Resources\DeviceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DeviceVerificationsRelationManager extends RelationManager
{
    protected static string $relationship = 'deviceVerifications';

    protected static ?string $recordTitleAttribute = 'verification_date';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('verification_date')
                    ->required(),
                Forms\Components\DatePicker::make('next_verification_date')
                    ->required(),
                Forms\Components\TextInput::make('verification_type')
                    ->maxLength(100),
                Forms\Components\TextInput::make('verification_result')
                    ->maxLength(100),
                Forms\Components\TextInput::make('verifier_name')
                    ->maxLength(100),
                Forms\Components\TextInput::make('verifier_company')
                    ->maxLength(100),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('verification_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_verification_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('verification_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('verification_result')
                    ->searchable(),
                Tables\Columns\TextColumn::make('verifier_name')
                    ->searchable(),
            ])
            ->filters([
                //
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
