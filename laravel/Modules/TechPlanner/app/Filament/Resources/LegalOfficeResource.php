<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Filament\Tables;
use Filament\Tables\Table;
use Modules\TechPlanner\Filament\Resources\LegalOfficeResource\Pages;
use Modules\TechPlanner\Models\LegalOffice;
use Modules\Xot\Filament\Resources\XotBaseResource;

class LegalOfficeResource extends XotBaseResource
{
    protected static ?string $model = LegalOffice::class;

    public static function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('address')
                ->required()
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('city')
                ->required()
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('postal_code')
                ->required()
                ->maxLength(10),
            \Filament\Forms\Components\TextInput::make('province')
                ->required()
                ->maxLength(2),
            \Filament\Forms\Components\TextInput::make('country')
                ->required()
                ->default('IT')
                ->maxLength(2),
            \Filament\Forms\Components\TextInput::make('phone')
                ->tel()
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('email')
                ->email()
                ->maxLength(255),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLegalOffices::route('/'),
            'create' => Pages\CreateLegalOffice::route('/create'),
            'edit' => Pages\EditLegalOffice::route('/{record}/edit'),
        ];
    }
}
