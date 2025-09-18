<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\TechPlanner\Filament\Resources\MedicalDirectorResource;

class MedicalDirectorsRelationManager extends RelationManager
{
    protected static string $relationship = 'medicalDirectors';

    protected static null|string $recordTitleAttribute = 'name';

    protected static string $resource = MedicalDirectorResource::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\TextInput::make('fiscal_code')->required()->maxLength(255),
            Forms\Components\TextInput::make('phone')
                ->tel()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\DatePicker::make('appointment_date')->required(),
            Forms\Components\DatePicker::make('expiry_date')->required(),
            Forms\Components\Toggle::make('is_active')->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('fiscal_code'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('appointment_date')->date(),
                Tables\Columns\TextColumn::make('expiry_date')->date(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
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
